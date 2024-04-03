<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1><?= $category->getName() ?></h1>

<h2>List of topics :</h2>

<?php
if($topics){
    foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> by 

    <?php if($topic->getUser()){ ?>
        <a href=""><?= $topic->getUser() ?></a>
    <?php }
    else{ ?>
        <span>
            (Deleted user)
        </span>
    <?php } ?>
    </p>
<?php }
}
else{ ?>
    <p>
        No topics in this category yet.
    </p>
<?php } ?>

    
