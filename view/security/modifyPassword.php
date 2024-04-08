<?php
    $user = $result["data"]['user'];
?>

    <a href="index.php?ctrl=security&action=displayModProfileForm"><i class="fa-solid fa-arrow-left"></i> Cancel</a>

    <form action="index.php?ctrl=security&action=submitPasswordUpdate" method="post">

    
    <div>
        <label for="passwordInput1">Current password : </label>
        <input type="password" name="inputPassword1" id="passwordInput1" required>
    </div>

    <div>
        <label for="passwordInput2">New password : </label>
        <input type="password" name="inputPassword2" id="passwordInput2" required>
    </div>

       <a href="index.php?ctrl=security&action=displayModPassword">Change your password</a>

        <input type="submit" name="submit" id="submitPasswordUpdate" value="Update password">

    </form>