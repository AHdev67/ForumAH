<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Topics list :</h1>

<?php
if($topics){
    foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getId() ?>"><?= $topic ?></a> par <?= $topic->getUser() ?></p>
<?php }
}
else{ ?>
    <p>
        No topics in this category yet.
    </p>
<?php } ?>

    
