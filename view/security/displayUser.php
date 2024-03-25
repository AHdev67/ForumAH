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
                "<?= $topic->getTitle() ?>", posted in <?= $topic->getCategory() ?>
            </p>
        </div>

   <?php } ?>
</div>

<div id="userPosts">
    <p>
        Answers by this user :
    </p>
    <?php
    foreach($posts as $post) { ?>

        <div>
            "<?= $post->getContent() ?>", posted in <?= $post->getTopic() ?>
        </div>

    <?php } ?>
</div>