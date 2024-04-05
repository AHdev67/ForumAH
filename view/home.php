<?php
    $topics = $result["data"]['topics']; 
?>

<h1>The home of PC hardware enthusiasts.</h1>
<h2>Need advice ? Got advice to give ? You're in the right place.</h2>

<p>
    <a href="index.php?ctrl=topic&action=displayTopicForm">Start a new topic</a>
</p>

<h3>Most recent topics</h3>

<?php
foreach($topics as $topic){ ?>
    <div>
        <p>
            <a href="index.php?ctrl=topic&action=displayTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle() ?> </a>
            by : <?= $topic->getUser() ?> (<?= $topic->getCreationDate() ?>) 
            Category : <?= $topic->getCategory() ?>
        </p>
    </div>
<?php } ?>