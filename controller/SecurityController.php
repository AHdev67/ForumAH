<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {
        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "User registration form"
        ];
    }

    public function addUser() {
        $userManager = new UserManager();

        if (isset($_POST["submit"])) {
            $username = filter_input(INPUT_POST,"inputUsername", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"inputEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"inputPassword1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordCheck = filter_input(INPUT_POST,"inputPassword2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if($username && $email && $password) {
                

                $userData = [
                    "username" => $username,
                    "email" => $email,
                    "password" => $password,
                ];

                $userManager->add($userData);

                return [
                    "view" => VIEW_DIR."home.php",
                    "meta_description" => "Page d'accueil du forum"
                ];
            }
        }
    }

    public function login() {}
    public function logout() {}
}