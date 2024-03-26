<?php
    $user = $result["data"]['user'];
    $topics = $result["data"]['topics']??[];
    $posts = $result["data"]['posts']; 
?>

<div id="UserHeader">
    <h1>
        <?= $user->getUsername() ?>
    </h1>
    <p>
        Registerd on : <?= $user->getRegisterDate() ?>
    </p>
</div>

<div id="userTopics">
    <p>
        Topics by this user :
    </p>
    <?php
    foreach($topics as $topic){ ?>

        <div>
            <p>
                <a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>, 
                posted in <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getCategory() ?>"><?= $topic->getCategory() ?></a>
            </p>
        </div>

   <?php } ?>
</div>

<div id="userPosts">
    <p>
        Replies by this user :
    </p>
    <?php
    foreach($posts as $post) { ?>

        <div>
            "<?= $post->getContent() ?>", posted in 
            <?php
            if($post->getTopic()){ ?>
                <a href="index.php?ctrl=topic&action=displayTopic&id=<?= $post->getTopic()->getId() ?>"><?= $post->getTopic() ?></a>
            <?php }
            else { ?>
                <span>(topic deleted)</span>
            <?php } ?>
                
        </div>

    <?php } ?>
</div>