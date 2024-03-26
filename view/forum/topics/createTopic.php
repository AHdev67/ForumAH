<?php
    $categories = $result["data"]['categories']; 
?>

<form action="index.php?ctrl=topic&action=createTopic" method="post">

    <div>
        <span>Category : </span><br>
        <?php
        foreach($categories as $category) { ?>
            <p>
                <input type="radio" value="<?= $category->getId() ?>" name="inputCategory" id="<?= $category->getID() ?>">
                <label for="<?= $category->getID() ?>"><?= $category->getName() ?></label>
            </p>
        <?php } ?>
    </div>

    <div>
        <label for="titleInput">Title : </label>
        <input type="text" name="inputTitle" id="titleInput" placeholder="Title of your topic">
    </div>

    <div>
        <label for="contentInput">Object : </label>
        <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Object of your topic"></textarea>
    </div>

    <input type="submit" name="submit" id="topicSubmit" value="Post">

</form>