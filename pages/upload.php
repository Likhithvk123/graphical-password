<?php
session_start();
include '../resources/sessions.php';
include '../resources/resize_img_code.php';
$ses = new Sessions();

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
if ($uid == "" || $role == "") {
    header("location:../index.php");
}

//upload image
if (isset($_POST['upload'])) {
    $img_name = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $ext_array = array("png", "jpeg", "jpg");

    if (in_array(strtolower($ext), $ext_array)) {
        $img_new_id = "p" . date("YmdHis") . "w." . $ext;
        $new_path_r = "../resize/" . $img_new_id;
        $new_path = "../passwords/" . $img_new_id;
        $res = move_uploaded_file($img_tmp, $new_path_r);

        $resizeObj = new resize($new_path_r);
        $resizeObj->resizeImage(250, 250, 'crop');
        $resizeObj->saveImage($new_path, 100);
        unlink($new_path_r);

        if ($res) {
            echo "<script>alert('Image uploaded successfully!'); window.location.href='upload.php';</script>";
        } else {
            echo "<script>alert('Operation failed!');</script>";
        }
    } else {
        echo "<script>alert('File format not suported!');</script>";
    }
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
                    <div id="comments">
                        <h2><u>Upload images that can be used as passwords</u></h2>
                        <form style="min-height: 300px" method="post" enctype="multipart/form-data">
                            <div class="one_half first">
                                <label>Image (jpg, jpeg, png) <span>*</span></label>
                                <input accept=".jpg,.png,.jpeg" type="file" name="img" id="img" required>
                            </div>
                            <div class="one_half">
                                <label>&nbsp;</label>
                                <input class="btn" type="submit" id="upload" name="upload" value="Upload Image">
                            </div>
                        </form>
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