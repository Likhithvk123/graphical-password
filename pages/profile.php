<?php
session_start();
include '../resources/sessions.php';
$ses = new Sessions();

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
if ($uid == "" || $role == "") {
    header("location:../index.php");
}

$user = $ses->getSingleUser($uid);
?>
<!DOCTYPE html>
<html lang="">
    <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
    <head>
        <title><?php echo $ses->APP_NAME2 ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

        <style type="text/css">
            #upload:hover{
                background-color: #00ACEE !important;
                color: #fff !important;
                font-weight: bold;
            }
        </style>
    </head>
    <body id="top">
        <!-- Top Background Image Wrapper -->
        <div class="bgded overlay" style="background-image:url('../images/bg.jpg');"> 
            <?php include '../resources/header.php'; ?>
        </div>
        <div style="min-height:490px;" class="wrapper row3">
            <main class="hoc container clear"> 
                <!-- main body -->
                <div class="content"> 
                    <div id="comments">
                        <h2><u>User Profile Details</u></h2>
                        <p><strong>Full Name: </strong> <?php echo $user['fullname'] ?></p>
                        <p><strong>Email Address: </strong> <?php echo $user['email'] ?></p>
                        <p><strong>Mobile Number: </strong> <?php echo $user['mobile'] ?></p>
                    </div>
                </div>
                <!-- / main body -->
                <div class="clear"></div>
            </main>
        </div>
        <?php include '../resources/footer.php'; ?>
        <a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
        <!-- JAVASCRIPTS -->
        <script src="../layout/scripts/jquery.min.js"></script>
        <script src="../layout/scripts/jquery.backtotop.js"></script>
        <script src="../layout/scripts/jquery.mobilemenu.js"></script>
    </body>
</html>