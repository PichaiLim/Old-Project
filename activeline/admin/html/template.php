<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title_1 ?> - <?php echo $title_2 ?></title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/metisMenu.min.css" rel="stylesheet">
    <link href="assets/sb-admin-2.css" rel="stylesheet">
    <link href="assets/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
if (isset($_POST['username']) AND isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $userlogin = $lnwphp->table_array('lp_user', "`staus` = 'admin' AND `username` = '$user' AND `password` = '$pass'");
    $_SESSION['userlogin'] = $userlogin;
} else {
    if (isset($_SESSION['userlogin']) AND $_SESSION['userlogin'] != '') {

    } else {
        $_SESSION['userlogin'] = '';
    }
}


if (isset($_SESSION['userlogin']) AND $_SESSION['userlogin'] != '') {
    ?>
    <div id="wrapper">
        <?php include(dirname(__FILE__) . '/menu.php') ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="clr">&nbsp;</div>
                        <h1 class="page-header"><?php echo $menu_name ?> <span class="pull-right"
                                                                               style="font-size:8px"><?php echo $title_2 ?></span>
                        </h1>
                        <p><?php echo $title_1 . ': ' . $description ?></p>
                        <?php include($file) ?>
                        <div class="clr">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="text-center"><img
                                src="data:image/png;base64,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"
                                class="img-responsive" alt="CRUD X Systems By lnwPHP.in.th"/></div>
                    <div class="panel-body">
                        <form action="./" role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text"
                                           autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password"
                                           value="">
                                </div>
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                    <div class="text-center">lnwPHP X CRUD System By <a
                                href="https://www.lnwphp.in.th">www.lnwphp.in.th</a></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<script src="assets/bootstrap.min.js"></script>
<script src="assets/metisMenu.min.js"></script>
<script src="assets/sb-admin-2.js"></script>

</body>
</html>