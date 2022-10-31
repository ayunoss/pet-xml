<html lang="ru">
<head>
    <title>Sign In</title>
</head>
<body>
<form id="sign-in-form" enctype="multipart/form-data">
    <h1>Sign up</h1>
    <p>
        <label for="login" class="u">Your username</label>
        <input type="text" name="login" id="login" placeholder="myname99" required="required"
               minlength="2" maxlength="90">
    </p>
    <p>
        <label for="password" class="u">Your password</label>
        <input type="password" id="password" name="password" placeholder="mypassword99"
               required="required" maxlength="50">
    </p>
    <p>
        <b><input type="button" onclick="post()" value="Sign in"></b>

    </p>
    <p> Not a member yet?
        <a href="\sign-up">Join us!</a>
    </p>
</form>
<script>
    function post() {
        var form     = document.getElementById('sign-in-form');
        var formData = new FormData(form);
        var xhr      = new XMLHttpRequest();
        xhr.open('POST', '/exec-sign-in');
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    window.location.href = '/';
                }
            }
        }
    }
</script>
</body>
</html>