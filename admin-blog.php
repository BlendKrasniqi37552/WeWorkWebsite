<?php
require 'includes/class-autoload.inc.php';
session_start();

$adminCheck = new AdminCheck();
if (!$adminCheck->isAdmin()) {
	header('location: ../login.php');
}

$loginCheck = new LoginCheck();
$blogpost = new BlogPost();
$blogpost->fetchBlogPosts();
?>
<!DOCTYPE html>
<html>

<head>
    <title>WeWork - Admin Panel</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style600.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="icon" type="image/png" href="img/logo.png" />
</head>

<body>

<div class="content">

<div class="header">
        <a href="index.php"><img src="img/logo.png" width="50px" height="50px"></a>

        <?php if(isset($_SESSION['name'])): ?>
        <p>Welcome, <?php echo $_SESSION['name'];?>
        <?php if($_SESSION['user_type'] == "admin" ): ?>
            <a href="admin.php">(Admin Panel)</a>
        <?php endif; ?>
        / <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <p><a href="login.php">Login</a> / <a href="signup.php">Sign up</a></p>
    <?php endif; ?>

    </div>

    <div class="headermenu" id="headermenuid">
        <ul>
        <li id="icon"><a id="menuhref" href="javascript:void(0);" onclick="menu()">
        <i class="fa fa-bars"></i>
        </a></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li id="active"><a href="blog.php">Blog</a></li>
        </ul>
    </div>

    <div class="maincontainer">
        <h1 style="text-align: center">Blog</h1>
         <div class="section6">
           <?php if ($loginCheck->isLogin()) {
           	echo "<div class='addarticle'>
              <!-- onsubmit='return validateContact()' -->
                <form name='contactForm' action='includes/blog.inc.php' method='post' enctype='multipart/form-data'>
                 <label for='title'>Enter your title:</label><br>
                 <input type='text' id='title' name='title' placeholder='Enter your title...' >
                 <label for='entertext'>Enter your text:</label>
                 <textarea placeholder='Enter your text...' id='entertext' name='entertext' ></textarea>
                   <div class='addarticleButtons'>
                       <input type='file' id='file' name='file'>
                       <input id='button' type='submit' name='submit' value='Submit'>
                   </div>
                </form>
            </div>";
           } ?>

        <div class="blog">
          <?php if ($blogpost->echoBlogPostsAdmin()) ?>
        </div>
    </div>


</div>
    </div>
    <div class="footer">
        <p>All Rights Reserved &copy;</p>
       <p><a style="color: skyblue" href="https://github.com/BlendKrasniqi37552/WeWorkWebsite">GitHub</a> | Lirian Dragusha | Blend Krasniqi | 2020</p>
    </div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
