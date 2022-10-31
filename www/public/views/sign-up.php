<html lang="ru">
<head>
    <title>Sign Up</title>
</head>
<body>
<form id="sign-up-form" enctype="multipart/form-data">
    <h1>Sign up</h1>
    <p>
        <label for="login" class="u">Your username</label>
        <input type="text" name="login" id="login" placeholder="nickname" required="required"
               minlength="4" maxlength="90">
    </p>
    <p>
        <label for="phone" class="u">Your phone number</label>
        <input type="text" name="phone" id="phone" placeholder="7900000000" required="required"
               minlength="5" maxlength="90"/>
    </p>
    <span class="emailError">
        <p>
        <label for="email" class="u">Your email</label>
        <input type="text" name="email" id="email" placeholder="myemail@mail.com"
               minlength="10"/>
        </p>
    </span>
    <p>
        <label for="password" class="u">Your password</label>
        <input type="password" id="password" name="password" placeholder="password99"
                   required="required" maxlength="50">
    </p>
    <p>
        <label for="password_confirm" class="u">Please confirm your password</label>
        <input type="password" id="password_confirm" name="password_confirm"
               placeholder="password99" required="required" maxlength="50"/>
        <span id="error" style="color:red"></span>
    </p>
    <p>
        <b><input type="button" onclick="post()" value="Sign up"></b>
    </p>
    <p> Already a member ?
        <a href="\sign-in">Sign in !</a>
    </p>
</form>
<script>
    function isValidPassword() {
        var password        = document.getElementById('password').value;
        var passwordConfirm = document.getElementById('password_confirm').value;
        if (password !== passwordConfirm) {
            document.getElementById('error').innerHTML = 'Password confirmation failed. Please Try again.';
            return false;
        }
        return true;
    }

    function post() {
        if (isValidPassword()) {
            var form     = document.getElementById('sign-up-form');
            var formData = new FormData(form);
            var xhr      = new XMLHttpRequest();
            xhr.open('POST', '/exec-sign-up');
            xhr.send(formData);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        window.location.href = '/sign-in';
                    }
                }
            }
        }
    }
</script>
</body>
</html>