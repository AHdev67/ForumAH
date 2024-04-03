<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        $categoryManager = new CategoryManager();
        $topicManager = new TopicManager();

        $categories = $categoryManager->findAll(["name", "DESC"]);
        $topics = $topicManager->findAll(["creationDate", "DESC"]);

        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "categories" => $categories,
                "topics" => $topics
            ]
        ];
    }
}
