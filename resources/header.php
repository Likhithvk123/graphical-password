<?php
$head_uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : "";
$head_role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
?>
<div class="wrapper row1">
    <header id="header" class="hoc clear"> 
        <div id="logo" class="fl_left">
            <h1><a href="index.php"><?php echo $ses->APP_NAME2 ?></a></h1>
        </div>
        <nav id="mainav" class="fl_right">
            <ul class="clear">
                <li class="active"><a href="index.php">Home</a></li>
                    <?php
                    if ($role == "admin") {
                        ?>
                    <li><a href="upload.php">Upload Passwords</a></li>
                    <li><a href="password.php">View Passwords</a></li>
                    <?php
                } else {
                    ?>
                    <li><a href="profile.php">View Profile</a></li>
                    <li><a href="about.php">About</a></li>
                    <?php
                }
                ?>
                <li><a href="../logout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>
</div>