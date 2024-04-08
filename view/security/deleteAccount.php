<?php
    $user = $result["data"]['user'];
?>

<h1>
    Account deletion :
</h1>

<a href="index.php?ctrl=security&action=profile"><i class="fa-solid fa-arrow-left"></i> Back to profile</a>

<h3>
    Are you certain you wish to delete your account ?
</h3>

<h4>
    Please enter your login info to proceed
</h4>

<form action="index.php?ctrl=security&action=deleteAccount" method="post">

    <div>
        <label for="emailInput">E-mail : </label>
        <input type="email" name="inputEmail" id="emailInput" placeholder="something.else@thing.domain" required>
    </div>

    <div>
        <label for="passwordInput1">Password : </label>
        <input type="password" name="inputPassword" id="passwordInput" required>
    </div>

    <input type="submit" name="submit" id="deleteAccountSubmit" value="Delete this account">

</form>