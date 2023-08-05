<?php
session_start();
include 'resources/sessions.php';
$ses = new Sessions();
$url_uname = isset($_GET['un']) ? base64_decode($_GET['un']) : "";
$uname_key = "";
$gpass_key = "";
$tpass_key = "";

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
if ($uid != "" && $role != "") {
    header("location:pages/index.php");
}

if ($url_uname != "") {
    if ($url_uname == "admin") {
        $uname_key = "hidden";
        $gpass_key = "hidden";
        $tpass_key = "";
    } else {
        $uname_key = "hidden";
        $gpass_key = "";
        $tpass_key = "hidden";
    }
} else {
    $uname_key = "";
    $gpass_key = "hidden";
    $tpass_key = "hidden";
}

//check username and text password
if (isset($_POST['proceed'])) {
    $uname = $_POST['username'];
    $tpass = $_POST['tpass'];
    //$result = $ses->checkUsername($uname);
    $result = $ses->userTextLogin($uname, $tpass);

    if ($result != NULL) {
        if ($result['role'] == "admin") {
            $_SESSION['uid'] = $uname;
            $_SESSION['role'] = $result['role'];

            header("location:pages/index.php");
        } else {

            header("location:index.php?un=" . base64_encode($uname));
        }
    } else {
        echo "<script>alert('Incorrect sign in credentials!');</script>";
    }
}

//text sign in (for admin only)
/* if (isset($_POST['tsignin'])) {
  $tpassword = $_POST['tpassword'];
  $result = $ses->userLogin($url_uname, $tpassword);

  if ($result != NULL) {
  $_SESSION['uid'] = $url_uname;
  $_SESSION['role'] = $result['role'];

  header("location:pages/index.php");
  } else {
  $t_re_enc = base64_encode($url_uname);
  echo "<script>alert('Incorrect password!'); window.location.href='index.php?un=$t_re_enc';</script>";
  }
  } */

//text sign in with images (for user only)
if (isset($_POST['gsignin'])) {
    $gpassword = $_POST['gpassword'];

    $result = $ses->userGraphicalLogin($url_uname, $gpassword);
    
    if ($result != NULL) {
        $_SESSION['uid'] = $url_uname;
        $_SESSION['role'] = $result['role'];
        
        header("location:pages/index.php");
        
    } else {
        $t_re_enc = base64_encode($url_uname);
        echo "<script>alert('Incorrect password!'); window.location.href='index.php?un=$t_re_enc';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $ses->APP_NAME1 ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Tiny Ui Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-awesome.css" rel="stylesheet">		<!-- font-awesome icons -->
        <!-- //Custom Theme files -->
        <!-- web font -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
        <!-- //web font -->
        <style type="text/css">
            .my_img:hover{
                filter: brightness(50%);
            }
        </style>
    </head>
    <body>
        <!-- main -->
        <div class="main-agileits">
            <h1><?php echo $ses->APP_NAME1 ?></h1>
            <div class="mainw3-agileinfo">
                <!-- login form -->
                <div class="login-form">  
                    <p style="font-weight: bold;"><u>User Signin Form</u></p>
                    <p style="text-align: right;">
                        <input onclick="clearPassword()" <?php echo $gpass_key ?> style="background-color: #f00; color: #fff;" name="reg" type="button" value="Clear Password">
                        &nbsp;
                        <a href="index.php" style="color: #f00;">Reset Page</a>
                    </p><br>
                    <div class="login-agileits-top"> 	
                        <form <?php echo $uname_key ?> id="unameform" name="unameform" method="post"> 
                            <p>Username </p>
                            <input id="input1" type="text" class="name" name="username" required/>
                            <p>Password </p>
                            <input id="input1" type="password" class="name" name="tpass" required/>
                            <input name="proceed" type="submit" value="Proceed"> 

                        </form>
                        <!--<form <?php //echo $tpass_key         ?> id="textpass" name="textpass" method="post"> 
                            <p>Password </p>
                            <input id="input1" type="password" class="name" name="tpassword" required/>
                            <input name="tsignin" type="submit" value="Sign In Now"> 
                        </form>-->
                        <form <?php echo $gpass_key ?> id="graphicalpass" name="textpass" method="post"> 
                            <p>Password </p>
                            <input type="hidden" id="gpassword" name="gpassword"/>
                            <input disabled id="display" type="text" class="name" name="display" required/>
                            <div>
                                <?php
                                foreach (new DirectoryIterator('passwords') as $img_file) {
                                    if ($img_file->isFile()) {
                                        $img_path = $img_file->getPath() . "/" . $img_file->getFilename();
                                        ?>
                                        <img class="my_img" onclick="addPassword('<?php echo $img_file->getFilename() ?>')" width="50" src="<?php echo $img_path ?>" alt=""/>
                                        <?php
                                    }
                                }
                                ?>
                            </div>                            
                            <input name="gsignin" type="submit" value="Sign In Now">
                        </form>
                        <script type="text/javascript">
                            function addPassword(val) {
                                new_display = document.getElementById("display").value + "*";
                                document.getElementById("display").value = new_display;

                                new_pass = document.getElementById("gpassword").value + val;
                                document.getElementById("gpassword").value = new_pass;
                            }

                            function clearPassword() {
                                document.getElementById("display").value = "";
                                document.getElementById("gpassword").value = "";
                            }
                        </script>
                    </div>
                    <br/>
                    <p style="text-align: center;">
                        New user? 
                        <a style="color: #fff; font-weight: bold;" href="register.php">
                            Sign up now!
                        </a>
                    </p>
                </div> 
            </div>	
        </div>	
        <!-- //main -->
        <!-- //copyright -->
        <!-- js -->  
        <script src="js/superplaceholder.js"></script>
        <!-- //js --> 
    </body>
</html>