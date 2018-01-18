<?php
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (strlen(strstr($agent, 'Firefox')) > 0) {
        header("Location: http://www.google.com");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beaver CMS | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown" style="position:relative;margin-top:15%">
        <div>
            <div>

                <img class="img-responsive" style=";position:relative;top:15%" src="logo.png">

            </div>
            <h3></h3>
            <form class="m-t" role="form" method="POST" action="includes/login.php">
                <div class="form-group">
                    <input type="text" name="u_name" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="pwd" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small></small> </p>
        </div>
    </div>

</body>
</html>
