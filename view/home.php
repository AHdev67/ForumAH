<?php
    $topics = $result["data"]['topics']; 
?>

<div class="px-4 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">The home of PC hardware enthusiasts.</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Need advice ? Got advice to give ? You're in the right place.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-4">
            <a href="index.php?ctrl=topic&action=displayTopicForm">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Start a new topic</button>
            </a>
        </div>
    </div>
</div>

<div class="lead mb-4">
            <h3 class="mb-5">Most recent topics</h3>

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
        </div>