<?php
    $users = $result["data"]['users']; 
?>

<h1>User list</h1>

<?php
foreach($users as $user ){ ?>
    <p><a href="index.php?ctrl=security&action=profile&id=<?= $user->getId() ?>"><?= $user->getUsername() ?></a></p>
<?php }