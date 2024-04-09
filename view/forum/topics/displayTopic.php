<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts'];
?>

<div id="topicHeader">
    <h1>
        <?= $topic->getTitle() ?> 
        <?php
        if($topic->getClosed() == 1){ ?>
            (CLOSED)
        <?php } ?>
    </h1>

    <p>
        <?= $topic->getContent() ?>
    </p>

    <p>
        By : 
        <?php
        if($topic->getUser()){ ?>
            <?= $topic->getUser() ?> 
        <?php }
        else{ ?>
            (Deleted user)
        <?php } ?>
        (<?= $topic->getCreationDate() ?>)
    </p>

    <?php
    if(App\Session::getUser() && App\Session::getUser() == $topic->getUser()){ ?>
        <div>
            <a href="index.php?ctrl=topic&action=displayModTopicForm&id=<?= $topic->getID() ?>">
                <i class="fa-solid fa-pen-to-square"></i> Edit topic
            </a>
        </div>

        <div>
            <a href="index.php?ctrl=topic&action=closeTopic&id=<?= $topic->getID() ?>">
                <i class="fa-solid fa-square-xmark"></i> Close topic
            </a>
        </div>

        <div>
            <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getID() ?>">
                <i class="fa-solid fa-trash"></i> Delete topic (forever)
            </a>
        </div>
    <?php } ?>
    
</div>

<div id="topicReplies">
    <h2>Replies :</h2>
    <?php
    if($posts){
        foreach($posts as $post){ ?>

            <div>
                <p>
                    <?= $post->getContent() ?> 
                </p>

                <p>
                    By : 
                    <?php
                    if($post->getUser()){ ?>
                        <?= $post->getUser() ?> 
                    <?php }
                    else{ ?>
                        (Deleted user)
                    <?php } ?>
                    (<?= $post->getCreationDate() ?>)
                </p>

                <?php
                if(App\Session::getUser() && App\Session::getUser() == $post->getUser()){ ?>

                <div>
                    <a href="index.php?ctrl=topic&action=displayModPostForm&id=<?= $post->getID() ?>">
                        <i class="fa-solid fa-pen-to-square"></i> Edit reply
                    </a>
                </div>

                <div>
                    <a href="index.php?ctrl=topic&action=deletePost&id=<?= $post->getID() ?>">
                        <i class="fa-solid fa-trash"></i> Delete reply (forever)
                    </a>
                </div>

                <?php } ?>
            </div>

    <?php }
    }
    else{ ?>
        <div>
            <p>
                No replies in this topic yet.
            </p>
        </div>
    <?php } ?>
</div>

<?php
if($topic->getClosed() == 1){ ?>
    TOPIC CLOSED, YOU CAN NO LONGER REPLY TO IT.
<?php }
else { ?>

    <?php
    if(App\Session::getUser()){ ?>
    <div>  
        <form action="index.php?ctrl=topic&action=addPost&id=<?= $topic->getID() ?>" method="post">

            <div>
                <label for="contentInput">Your reply : </label>
                <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Enter text here"></textarea>
            </div>

            <input type="submit" name="submit" id="postSubmit" value="Post">

        </form>
    </div>
    <?php } ?>

<?php } ?>