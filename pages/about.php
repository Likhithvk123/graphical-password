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
        <div class="wrapper row3">
            <main class="hoc container clear"> 
                <!-- main body -->
                <div class="content"> 
                    <div id="gallery">
                        <figure>
                            <header class="heading txt-center"><u>ABSTRACT</u></header>
                            <p>
                                Users’ authentication is one of the most important operations 
                                carried out in different software. The need for user authentication on 
                                systems is to disallow unauthorized access to users’ data. The most common 
                                and popular method through which users are authenticated is via their 
                                username and a text-based password. Although passwords tend to be more 
                                secured when lengthy. However, users tend to forget lengthy passwords, 
                                thereby forcing them to use shorter passwords. Shorter passwords are easy 
                                to guess or capture, thereby making the system insecure and prone to some 
                                series of attacks such as eavesdropping, shoulder surfing, etc. In order to 
                                solve this problem posed by the text-based password authentication method, 
                                this research work proposes a graphical password system using intuitive 
                                approach. This system will allow users to use images for authentication rather 
                                than a lengthy text password, thereby solving most of the problems existing in 
                                the text password authentication system. The selected methodology for the 
                                proposed system is Agile methodology. The system will be used on web platforms. 
                                Hence, it will be developed using some web technologies which are HTML, CSS and 
                                Javascript for the interface; PHP for the business logic and MySQL for the database.
                            </p>
                        </figure>
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