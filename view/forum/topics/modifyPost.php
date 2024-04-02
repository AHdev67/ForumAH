<?php
    $post = $result["data"]['post'];
?>


<form action="index.php?ctrl=topic&action=submitPostUpdate&id=<?= $post->getID() ?>" method="post">

        <div>
            <label for="contentInput">Your reply : </label>
            <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Enter text here"><?= $post->getContent() ?></textarea>
        </div>

        <input type="submit" name="submit" id="postSubmit" value="Update">

    </form>