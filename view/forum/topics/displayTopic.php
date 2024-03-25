<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<div id="topicHeader">
    <h1>
        <?= $topic["title"] ?>
    </h1>

    <p>
        <?= $topic["content"] ?>
    </p>

    <p>
        Par : <?= $topic->getUser() ?>
    </p>
</div>

<div id="topicAnswers">
    <?php
    foreach($posts as $post){ ?>

        <div>
            <p>
                <?= $post["content"] ?>
            </p>
            <p>
                By : <?= $post->getUser() ?>
            </p>
        </div>

    <?php } ?>
</div>

