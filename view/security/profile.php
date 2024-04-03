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
    if($topics){
        foreach($topics as $topic){ ?>

            <div>
                <p>
                    <a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?></a>, 
                    posted in <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $topic->getCategory() ?>"><?= $topic->getCategory() ?></a> 
                    (<?= $topic->getCreationDate() ?>)
                </p>
            </div>
    <?php } 
    }
    else{ ?>
        <p>
            This user has no topics as of right now.
        </p>
    <?php } ?>
   
</div>

<div id="userPosts">
    <p>
        Replies by this user :
    </p>
    <?php
    if($posts){
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
            (<?= $post->getCreationDate() ?>)
        </div>

    <?php } 
    }
    else{ ?>
        <p>
            This user has made no replies as of right now.
        </p>
    <?php } ?>
    
</div>