<?php
    $user = $result["data"]['user'];
?>

    <a href="index.php?ctrl=security&action=profile&id=<?= $user->getID() ?>"><i class="fa-solid fa-arrow-left"></i> Back to profile</a>

    <form action="index.php?ctrl=security&action=submitProfileUpdate&id=<?= $user->getID() ?>" method="post">

    
        <div>
            <label for="usernameInput">Your username : </label>
            <input type="text" name="inputUsername" id="usernameInput" 
            placeholder="Your username"  value="<?= $user->getUsername() ?>" required>
        </div>

        <div>
            <label for="emailInput">Your e-mail : </label>
            <input type="email" name="inputEmail" id="emailInput" 
            placeholder="something.else@thing.domain" value="<?= $user->getEmail() ?>" required>
        </div>

       <a href="index.php?ctrl=security&action=displayModPassword&id=<?= $user->getId() ?>">Change your password</a>

        <input type="submit" name="submit" id="submitProfileUpdate" value="Update profile">

    </form>