<?php
    $users = $result["data"]['users']; 
?>

<h1>User list</h1>

<?php
foreach($users as $user ){ ?>
    <p>
        <a href="index.php?ctrl=security&action=profileAdminView&id=<?= $user->getId() ?>"><?= $user->getUsername() ?></a> 
        role : 
        <?php
        if($user->getRole() == "role_admin"){ ?>
            administrator
        <?php }
        else if($user->getRole() == "role_user") { ?>
            user
        <?php }
        else{ ?>
            user (banned)
        <?php } ?>
    </p>
<?php }