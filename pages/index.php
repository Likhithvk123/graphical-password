<?php
session_start();
include '../resources/sessions.php';
$ses = new Sessions();

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
if ($uid == "" || $role == "") {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="">
    <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
    <head>
        <title><?php echo $ses->APP_NAME2 ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    </head>
    <body id="top">
        <!-- Top Background Image Wrapper -->
        <div class="bgded overlay" style="background-image:url('../images/bg.jpg');"> 
            <?php include '../resources/header.php'; ?>
            <div id="pageintro" class="hoc clear"> 
                <article class="center">
                    <h3 class="heading underline"><?php echo $ses->APP_NAME1 ?></h3>
                    <!--<p>
                    Using a graphical password lets you secure your information in our system. Hence, you have little to worry about eaves droping, brute-force, etc. cyber attacks.    
                    </p>-->
                    <!--<footer><a class="btn" href="#">Just Like Button</a></footer>-->
                </article>
            </div>
        </div>
        <?php include '../resources/footer.php'; ?>
        <a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
        <!-- JAVASCRIPTS -->
        <script src="../layout/scripts/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.backtotop.js"></script>
        <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    </body>
</html>