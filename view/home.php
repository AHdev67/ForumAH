<?php
    $categories = $result["data"]['categories']; 
    $topics = $result["data"]['topics']; 
?>

<h1>The home of PC hardware enthusiasts.</h1>
<p>Need advice ? Got advice to give ? You're in the right place.</p>

<p>
    <a href="index.php?ctrl=topic&action=displayTopicForm">Start a new topic</a>
</p>

<h2>Most recent topics</h2>

<?php
foreach($categories as $category){
    
}