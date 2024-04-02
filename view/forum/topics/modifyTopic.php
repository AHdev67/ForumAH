<?php
    $categories = $result["data"]['categories'];
    $categoriesComp = $result["data"]['categories'];
    $topic = $result["data"]['topic'];
?>

<a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getID() ?>">< cancel</a>

<form action="index.php?ctrl=topic&action=submitTopicUpdate&id=<?= $topic->getID() ?>" method="post">

    <div>
        <span>Category : </span><br>
        <?php
        $thisTopicCategory = $topic->getCategory()->getID();

        foreach($categories as $category) {

            $isChecked = ($category->getId() === $thisTopicCategory) ? "checked" : "";
            ?>
            <p>
                <input <?= $isChecked ?> type="radio" value="<?= $category->getId() ?>" name="inputCategory" id="<?= $category->getID() ?>">
                <label for="<?= $category->getID() ?>"><?= $category->getName() ?></label>
            </p>
        <?php } ?>
    </div>

    <div>
        <label for="titleInput">Title : </label>
        <input type="text" name="inputTitle" id="titleInput" placeholder="Title of your topic" value="<?= $topic->getTitle() ?>">
    </div>

    <div>
        <label for="contentInput">Object : </label>
        <textarea name="inputContent" id="contentInput" cols="30" rows="10" placeholder="Object of your topic" ><?= $topic->getContent() ?></textarea>
    </div>

    <input type="submit" name="submit" id="topicSubmit" value="Update">

</form>