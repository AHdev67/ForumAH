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
                    "password" => password_hash($password, PASSWORD_DEFAULT),
                    "role" => "role_user"
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
        $topicManager = new TopicManager();
        $topics = $topicManager->findLatestTopics(["creationDate", "DESC"]);
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
                            "meta_description" => "Page d'accueil du forum",
                            "data" => [
                                "topics" => $topics
                            ]
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
        $topicManager = new TopicManager();
        $topics = $topicManager->findLatestTopics(["creationDate", "DESC"]);
        
        unset($_SESSION["user"]);
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "topics" => $topics
            ]
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

    public function displayModProfileForm($id){
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR."security/modifyProfile.php",
            "meta_description" => "Topic modification",
            "data" => [
                "user" => $user
            ]
        ];
    }

    public function submitProfileUpdate($id) {
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        if (isset($_POST["submit"])) {
            $username = filter_input(INPUT_POST,"inputUsername", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"inputEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($username && $email) {
                $userUpdateData =
                    "username = '".$username."', 
                    email = '".$email."'";

                $userManager->updateUser($userUpdateData, $id);

                $this->redirectTo("security", "profile", $id);
            }
        }
    }

    public function displayModPassword($id){
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        return [
            "view" => VIEW_DIR."security/modifyPassword.php",
            "meta_description" => "Password Change form",
            "data" => [
                "user" => $user
            ]
        ];
    }

    public function submitPasswordUpdate($id){
        $userManager = new UserManager();
        $user = $userManager->findOneById($id);

        if (isset($_POST["submit"])) {
            $currentPassword = filter_input(INPUT_POST,"inputPassword1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $newPassword = filter_input(INPUT_POST,"inputPassword2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($currentPassword && $newPassword) {
                $hash = $user->getPassword();
                    // var_dump($hash);die;
                if(password_verify($currentPassword, $hash)){
                    $PasswordUpdateData =
                    "password = '".password_hash($newPassword, PASSWORD_DEFAULT)."'";

                    $userManager->updateUser($PasswordUpdateData, $id);

                    $this->redirectTo("security", "profile", $id);
                }
                else{
                    Session::addFlash("error", "Passwords don't match.");
                    return [
                        "view" => VIEW_DIR."security/modifyPassword.php",
                        "meta_description" => "Topic modification",
                        "data" => [
                            "user" => $user
                        ]
                    ];
                }
            }
        }
    }

    public function users(){
        $this->restrictTo("role_admin");

        $manager = new UserManager();
        $users = $manager->findAll();

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [
                "users" => $users 
            ]
        ];
    }
}