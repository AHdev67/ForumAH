<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/categories/listCategories.php",
            "meta_description" => "List of categories",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/topics/listTopics.php",
            "meta_description" => "List of topics per category : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function displayUser($id) {
        $userManager = new UserManager();
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $user = $userManager->findOneById($id);
        $topics = $topicManager->findTopicsByUser($id);
        $posts = $postManager->findPostByUser($id);

        return [
            "view" => VIEW_DIR."security/displayUser.php",
            "meta_description" => "List of topics and posts by a user : ".$user,
            "data" => [
                "user" => $user,
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }
}