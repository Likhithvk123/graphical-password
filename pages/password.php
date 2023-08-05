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
                            <header class="heading"><u>Uploaded Password Images</u></header>
                            <ul class="nospace clear">
                                <?php
                                $counter = 0;
                                foreach (new DirectoryIterator('../passwords') as $img_file) {
                                    if ($img_file->isFile()) { //ensure it is a file
                                        $img_path = $img_file->getPath() . "/" . $img_file->getFilename();
                                        $class_labael = "one_quarter";
                                        $counter++;
                                        if ($counter == 1) {
                                            $class_labael = "one_quarter first";
                                        }
                                        if ($counter == 4) {
                                            $counter = 0;
                                        }
                                        ?>
                                        <li class="<?php echo $class_labael ?>">
                                            <a href="#">
                                                <img src="<?php echo $img_path ?>" alt="">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <figcaption>These images cannot be deleted since they may have been used as passwords by other users.</figcaption>
                        </figure>
                    </div>
                    <!--<nav class="pagination">
                        <ul>
                            <li><a href="#">&laquo; Previous</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><strong>&hellip;</strong></li>
                            <li><a href="#">6</a></li>
                            <li class="current"><strong>7</strong></li>
                            <li><a href="#">8</a></li>
                            <li><a href="#">9</a></li>
                            <li><strong>&hellip;</strong></li>
                            <li><a href="#">14</a></li>
                            <li><a href="#">15</a></li>
                            <li><a href="#">Next &raquo;</a></li>
                        </ul>
                    </nav>-->
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