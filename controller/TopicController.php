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

class TopicController extends AbstractController implements ControllerInterface{


//------------------------------------------------------------------TOPIC MAIN METHODS------------------------------------------------------------------

    // DISPLAY TOPIC PAGE
    public function displayTopic($id) {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/topics/displayTopic.php",
            "meta_description" => "Topic page with all answers by other users : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    // DISPLAY TOPIC CREATION FORM
    public function displayTopicForm() {

        $this->forbidTo("role_banned");

        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/topics/createTopic.php",
            "meta_description" => "Topic creation",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    // ADD NEW TOPIC TO DB
    public function addTopic() {

        $this->forbidTo("role_banned");

        $topicManager = new TopicManager();

        if (isset($_POST["submit"])) {
            $title = filter_input(INPUT_POST,"inputTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST,"inputContent", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category = filter_input(INPUT_POST,"inputCategory", FILTER_VALIDATE_INT);
            $user = $_SESSION["user"]->getID();
            $closed = 0;
            if($category && $title && $content) {
                $topicData = [
                    "title" => $title,
                    "content" => $content,
                    "category_id" => $category,
                    "user_id" => $user,
                    "closed" => $closed
                ];

                $topicManager->add($topicData);

                $this->redirectTo("forum", "listTopicsByCategory", $category);
            }
        }
    }

    //DELETE TOPIC
    public function deleteTopic($id){
        
        $topicManager = new TopicManager;
        $topic = $topicManager->findOneById($id);
        $categoryID = $topic->getCategory()->getId();
        $user = $_SESSION["user"];

        if($user == $topic->getUser()){

            $topicManager->delete($id);

            $this->redirectTo("forum", "listTopicsByCategory", $categoryID);
        }
        else{

            $_SESSION::addFlash("error", "This topic is not yours to delete");

            $this->redirectTo("topic", "displayTopic", $id);
        }

        
    }

    // DISPLAY TOPIC MODIFICATION FORM
    public function displayModTopicForm($id){

        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll(["name", "DESC"]);

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/topics/modifyTopic.php",
            "meta_description" => "Topic modification",
            "data" => [
                "categories" => $categories,
                "topic" => $topic
            ]
        ];
    }

    // SUBMIT TOPIC UPDATE
    public function submitTopicUpdate($id) {

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $user = $_SESSION["user"];

        if($user == $topic->getUser()){

            if (isset($_POST["submit"])) {
                $title = filter_input(INPUT_POST,"inputTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $content = filter_input(INPUT_POST,"inputContent", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $category = filter_input(INPUT_POST,"inputCategory", FILTER_VALIDATE_INT);
                
                if($title && $content && $category) {
                    $topicUpdateData =
                        "title = '".$title."', 
                        content = '".$content."', 
                        category_id = '".$category."'";

                    $topicManager->updateTopic($topicUpdateData, $id);

                    $this->redirectTo("topic", "displayTopic", $id);
                }
            }
        }
    }

    public function closeTopic($id){
        $topicManager = new TopicManager;

        $closeTopicData = "closed = 1";
        $topicManager->updateTopic($closeTopicData, $id);

        $this->redirectTo("topic", "displayTopic", $id);
    }

//------------------------------------------------------------------TOPIC POSTS METHODS------------------------------------------------------------------

    public function addPost($id){

        $this->forbidTo("role_banned");

        $postManager = new PostManager();

        if(isset($_POST['submit'])) {
            $content= filter_input(INPUT_POST,"inputContent", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user = $_SESSION["user"]->getID();

            if($content) {
                $postData = [
                    "content" => $content,
                    "topic_id" => $id,
                    "user_id" => $user,
                ];

                $postManager->add($postData);

                $this->redirectTo("topic", "displayTopic", $id);
            }
        }
    }

    public function deletePost($id){
        $postManager = new PostManager;
        $post = $postManager->findOneById($id);
        $topicID = $postManager->findOneById($id)->getTopic()->getID();
        $user = $_SESSION["user"];

        if($user == $post->getUser()){

            $postManager->delete($id);

            $this->redirectTo("topic", "displayTopic", $topicID);
        }
    }

    //DISPLAY POST MODIFICATION FORM
    public function displayModPostForm($id){

        $postManager = new postManager();
        $post = $postManager->findOneById($id);
        $user = $_SESSION["user"];

        if($user == $post->getUser()){

            return [
                "view" => VIEW_DIR."forum/topics/modifyPost.php",
                "meta_description" => "Post modification",
                "data" => [
                    "post" => $post
                ]
            ];
        }
    }

    //SUBMIT POST UPDATE
    public function submitPostUpdate($id) {

        $this->forbidTo("role_banned");

        $postManager = new postManager();
        $post = $postManager->findOneById($id);
        $topicID = $postManager->findOneById($id)->getTopic()->getID();
        $user = $_SESSION["user"];

        if($user == $post->getUser()){

            if (isset($_POST["submit"])) {
                $content = filter_input(INPUT_POST,"inputContent", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($content) {
                    $postUpdateData =
                        "content = '".$content."'";

                    $postManager->updatePost($postUpdateData, $id);

                    $this->redirectTo("topic", "displayTopic", $topicID);
                }
            }
        }
    }
}