<?php
session_start();
include 'resources/sessions.php';
$ses = new Sessions();
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
if ($uid != "" && $role != "") {
    header("location:pages/index.php");
}

$url_fullname = isset($_GET['fn']) ? base64_decode($_GET['fn']) : "";
$url_email = isset($_GET['e']) ? base64_decode($_GET['e']) : "";
$url_mobile = isset($_GET['m']) ? base64_decode($_GET['m']) : "";
$url_tpass = isset($_GET['p']) ? base64_decode($_GET['p']) : "";

$stage1_key = "";
$stage2_key = "";

if ($url_email != "" && $url_fullname != "" && $url_mobile != "") {
    $stage1_key = "hidden";
    $stage2_key = "";
} else {
    $stage1_key = "";
    $stage2_key = "hidden";
}

//try registering
if (isset($_POST['proceed'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $tpass = $_POST['tpassword'];

    $result = $ses->checkUsername($email);

    if ($result == TRUE) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        header("location:register.php?fn=" . base64_encode($fullname)
                . "&e=" . base64_encode($email) . "&m=" . base64_encode($mobile) 
                . "&p=" . base64_encode($tpass));
    }
}

//reg proper
if (isset($_POST['reg'])) {
    $real_pass = $_POST['password'];
    //$ses->newLogin($url_email, $real_pass, "user");
    $ses->newLogin($url_email, $real_pass, $url_tpass, "user");
    $ses->newUser($url_email, $url_mobile, $url_fullname);
    echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
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
            <h1>Graphical Password Using Intuitive Approach</h1>
            <div class="mainw3-agileinfo">
                <!-- login form -->
                <div class="login-form">  
                    <p style="font-weight: bold;"><u>User Registration Form</u></p>
                    <p style="text-align: right;">
                        <input onclick="clearPassword()" <?php echo $stage2_key ?> style="background-color: #f00; color: #fff;" name="reg" type="button" value="Clear Password">
                        &nbsp;
                        <a href="register.php" style="color: #f00;">Reset Page</a>
                    </p><br>
                    <div class="login-agileits-top"> 	
                        <form <?php echo $stage1_key ?> id="stage1" name="stage1" method="post"> 
                            <p>Full Name </p>
                            <input id="input1" type="text" class="name" name="fullname" required/>

                            <p>Email Address </p>
                            <input id="input1" type="text" class="name" name="email" required/>

                            <p>Mobile Number </p>
                            <input id="input1" type="text" class="name" name="mobile" required/>

                            <p>Password </p>
                            <input id="input1" type="password" class="name" name="tpassword" required/>

                            <input name="proceed" type="submit" value="Proceed"> 
                        </form>

                        <form <?php echo $stage2_key ?> id="stage2" name="stage2" method="post"> 
                            <p>Password </p>
                            <input type="hidden" id="password" name="password"/>
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
                            <input name="reg" type="submit" value="Sign Up Now"> 
                        </form> 
                        <script type="text/javascript">
                            function addPassword(val) {
                                new_display = document.getElementById("display").value + "*";
                                document.getElementById("display").value = new_display;

                                new_pass = document.getElementById("password").value + val;
                                document.getElementById("password").value = new_pass;
                            }

                            function clearPassword() {
                                document.getElementById("display").value = "";
                                document.getElementById("password").value = "";
                            }
                        </script>
                    </div>
                    <br/>
                    <p style="text-align: center;">
                        Already have an account? 
                        <a style="color: #fff; font-weight: bold;" href="index.php">
                            Sign in now!
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