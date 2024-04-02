<h1>
    Register as new user :
</h1>

<form action="index.php?ctrl=security&action=addUser" method="post">

    <div>
        <label for="usernameInput">Username : </label>
        <input type="text" name="inputUsername" id="usernameInput" placeholder="Your username" required>
    </div>

    <div>
        <label for="emailInput">E-mail : </label>
        <input type="email" name="inputEmail" id="emailInput" placeholder="something.else@thing.domain" required>
    </div>

    <div>
        <label for="passwordInput1">Password : </label>
        <input type="password" name="inputPassword1" id="passwordInput1" required>
    </div>

    <div>
        <label for="passwordInput2">Confirm password : </label>
        <input type="password" name="inputPassword2" id="passwordInput2" required>
    </div>


    <input type="submit" name="submit" id="registerSubmit" value="Register">

</form>