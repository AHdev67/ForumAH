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

    <div>
        <a href="index.php?ctrl=topic&action=displayModTopicForm&id=<?= $topic->getID() ?>">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
        
    </div>

    <div>
        <a href="index.php?ctrl=topic&action=deleteTopic&id=<?= $topic->getID() ?>">
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
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

                <div>
                    <a href="index.php?ctrl=topic&action=displayModPostForm&id=<?= $post->getID() ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    
                </div>

                <div>
                    <a href="index.php?ctrl=topic&action=deletePost&id=<?= $post->getID() ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
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

<div>  
    <form action="index.php?ctrl=topic&action=addPost&id=<?= $topic->getID() ?>" method="post">

        <div>
            <label for="contentInput">Your reply : </label>
            <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Enter text here"></textarea>
        </div>

        <input type="submit" name="submit" id="postSubmit" value="Post">

    </form>
</div>

