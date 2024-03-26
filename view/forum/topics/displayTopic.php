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
        Par : <?= $topic->getUser() ?> (<?= $topic->getCreationDate() ?>)
    </p>

    <div>
        <i class="fa-solid fa-pen-to-square"></i>
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
                    By : <?= $post->getUser() ?> (<?= $post->getCreationDate() ?>)
                </p>

                <div>
                    <i class="fa-solid fa-pen-to-square"></i>
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
    <form action="index.php?ctrl=topic&action=createPost&id=<?= $topic->getID() ?>" method="post">

        <div>
            <label for="contentInput">Your reply : </label>
            <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Enter text here"></textarea>
        </div>

        <input type="submit" name="submit" id="postSubmit">

    </form>
</div>

