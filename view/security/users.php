<?php
    $users = $result["data"]['users']; 
?>

<h1>User list</h1>

<?php
foreach($users as $user ){ ?>
    <p><a href=""><?= $user->getUsername() ?></a></p>
<?php }