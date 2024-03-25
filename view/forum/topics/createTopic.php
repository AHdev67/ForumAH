<?php
    $categories = $result["data"]['categories']; 
?>

<form action="" method="post">

    <div>
        <label for="titleInput">Title : </label>
        <input type="text" name="inputTitle" id="titleInput" placeholder="Title of your topic">
    </div>

    <div>
        <label for=""></label>
        <select name="inputCategory" id="categoryInput">
            <option value="" disabled selected>Select category</option>
            <?php
            foreach($categories as $category){ ?>
                <option value="<?= $category["id_category"] ?>"><?= $category["name"] ?></option>
            <?php } ?>
        </select>
    </div>

</form>