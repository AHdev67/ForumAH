<h1>
    Log in :
</h1>

<form action="index.php?ctrl=security&action=login" method="post">

    <div>
        <label for="emailInput">E-mail : </label>
        <input type="email" name="inputEmail" id="emailInput" placeholder="something.else@thing.domain" required>
    </div>

    <div>
        <label for="passwordInput1">Password : </label>
        <input type="password" name="inputPassword" id="passwordInput" required>
    </div>

    <input type="submit" name="submit" id="registerSubmit" value="Log in">

</form>