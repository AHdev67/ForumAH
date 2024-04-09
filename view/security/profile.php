<?php
    $user = $result["data"]['user'];
    $topics = $result["data"]['topics']??[];
    $posts = $result["data"]['posts']; 
?>

<div id="UserHeader">
    <h1>
        <?= $user->getUsername() ?> 
        <?php 
        if($user->getRole() == "role_banned"){ ?>
            (BANNED)
        <?php } ?>
    </h1>

    <p>
        Registerd on : <?= $user->getRegisterDate() ?>
    </p>

    <?php 
    if(App\Session::getUser() && App\Session::getUser() == $user){ ?>
    <p>
        <a href="index.php?ctrl=security&action=displayModProfileForm"><i class="fa-solid fa-pen-to-square"></i> Modify profile</a>
    </p>

    <p>
        <a href="index.php?ctrl=security&action=displayAccDelForm">Delete account</a>
    </p>
    <?php } ?>

    <?php
    if(App\Session::isAdmin() && App\Session::getUser() != $user){ 
        if($user->getRole() == "role_banned"){ ?>
            <a href="index.php?ctrl=security&action=unbanUser&id=<?= $user->getId() ?>">Unban user</a>
        <?php }
        else { ?>
        <p>
            <a href="index.php?ctrl=security&action=banUser&id=<?= $user->getId() ?>">Ban user</a>
        </p>
        <?php } ?>
        
    <?php } ?>
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