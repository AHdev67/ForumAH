<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function displayRegister() {
        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "User registration form"
        ];
    }

    public function register() {
        $userManager = new UserManager();

        if (isset($_POST["submit"])) {
            $username = filter_input(INPUT_POST,"inputUsername", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"inputEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"inputPassword1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordCheck = filter_input(INPUT_POST,"inputPassword2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if($username && $email && $password) {
                if($userManager->findUserByEmail($email) != null){
                    Session::addFlash("error", "E-mail adress already in use.");
                    return [
                        "view" => VIEW_DIR."security/register.php",
                        "meta_description" => "User registration form"
                    ];
                }
                else if ($userManager->findUserByUsername($username) != null){
                    Session::addFlash("error", "Username already in use.");
                    return [
                        "view" => VIEW_DIR."security/register.php",
                        "meta_description" => "User registration form"
                    ];
                }
                else if($password != $passwordCheck){
                    Session::addFlash("error", "Passwords don't match.");
                    return [
                        "view" => VIEW_DIR."security/register.php",
                        "meta_description" => "User registration form"
                    ];
                }
                else if(strlen($password) < 8){
                    Session::addFlash("error", "Passwords is too short.");
                    return [
                        "view" => VIEW_DIR."security/register.php",
                        "meta_description" => "User registration form"
                    ];
                }
                else {
                    $userData = [
                    "username" => $username,
                    "email" => $email,
                    "password" => password_hash($password, PASSWORD_DEFAULT)
                    ];

                    $userManager->add($userData);

                    return [
                        "view" => VIEW_DIR."home.php",
                        "meta_description" => "Page d'accueil du forum"
                    ];
                }
            }
        }
    }

    public function displayLogin() {
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "User login form"
        ];
    }

    public function login() {
        $userManager = new UserManager();

        if (isset($_POST["submit"])) {
            $email = filter_input(INPUT_POST,"inputEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"inputPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($email && $password){
                
                $checkEmail = $userManager->findUserByEmail($email) ? true : false;
                
                if($checkEmail){
                    // var_dump("test"); die;
                    $user = $userManager->findUserByEmail($email);
                    
                    $hash = $user->getPassword();
                    // var_dump($hash);die;
                    if(password_verify($password, $hash)){
                        $_SESSION["user"] = $user;
                        return [
                            "view" => VIEW_DIR."home.php",
                            "meta_description" => "Forum home page"
                        ];
                    }
                    else{
                        Session::addFlash("error", "Incorrect password");
                        return [
                            "view" => VIEW_DIR."security/login.php",
                            "meta_description" => "User login form"
                        ];
                    }
                }
                else{
                    Session::addFlash("error", "Incorrect e-mail");
                    // $this->redirectTo("security", "displayLogin");
                    return [
                        "view" => VIEW_DIR."security/login.php",
                        "meta_description" => "User login form"
                    ];
                }
            }
        }
    }

    public function logout() {
        unset($_SESSION["user"]);
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Forum home page"
        ];
    }

    public function profile($id) {
        $userManager = new UserManager();
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $user = $userManager->findOneById($id);
        $topics = $topicManager->findTopicsByUser($id);
        $posts = $postManager->findPostByUser($id);

        return [
            "view" => VIEW_DIR."security/profile.php",
            "meta_description" => "List of topics and posts by a user : ".$user,
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }
}