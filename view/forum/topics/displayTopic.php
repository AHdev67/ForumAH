<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<div id="topicHeader">
    <h1>
        <?= $topic->getTitle() ?>
    </h1>

    <p>
        <?= $topic->getContent() ?>
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
                <?= $post->getContent() ?>
            </p>
            <p>
                By : <?= $post->getUser() ?>
            </p>
        </div>

    <?php } ?>
</div>

