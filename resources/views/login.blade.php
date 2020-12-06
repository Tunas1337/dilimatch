<?php
// We need to use sessions, so you should always start sessions using the below code.
#session_start();
// If the user is not logged in redirect to the login page...
/*if (!isset($_SESSION['loggedin'])) {
header('Location: login.php');
exit();
}*/
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body style="background-image:url('assets/img/bg-masthead.jpg');">
    <div class="main">
        <p class="sign" align="center">Sign in</p>
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form method="post" action="{{ url('/auth') }}">
            {{ csrf_field() }}
            <input name="email" class="user" type="text" align="center" placeholder="Username">
            <input name="password" class="pass" type="password" align="center" placeholder="Password">
            <input class="submit" type=submit value="Log in">


        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
