<? include "core/init.php"; ?>
<? if (!Session::check()){ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Register </title>
    <!-- CSS Files -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="/resources/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="form-container login-register">

    </div>
</div>
<script src="/resources/js/jquery.min.js"></script>
<script src="/resources/js/custom.js"></script>
</body>

<?
} else {
    header("location:/dashboard.php");
}
?>