<?php
include ('connection.php') ;
    //  session_start();
    /* if(isset($_SESSION['Email'])){
         $_SESSION['msg']="First You need to Logged in";
         header("Location: login.php");
     }
        
     if(isset($_POST['logout'])){
         session_destroy();
         unset($_SESSION['Email']);
         header("Location: login.php");
     }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>DEAN_Page</title>
</head>
<style>
body{
    margin: 0px;
    padding: 0px;
    background: url('IIT_image2.jpg');
    /* width:100%; */
    height: 100%; 
    /* background-position: center;  */
    /* background-repeat: no-repeat;  */
    background-size: cover; 
    }
    .btn{
    color:white;
    background-color: rgb(29, 74, 197);
    padding: 4px 12px;
    margin: 10px 60px;
    font-size: 16px;
    border: 2px solid black;
    border-radius: 10px;
    cursor:pointer;
    width:20%;
    
    }
    .content{
        width:20%;
        position:absolute;
        top: 55px;
        margin: 0px 20px;
        padding:20px;
        color:brown;
        border:1px solid black;
        background-color: rgb(178, 192, 201);
        border-radius:10px;
        font-size:18px;
    }
    .mid{
    display: block;
    width:25%;
    margin:20px auto;
    border: 2px solid green;
    background-color: rgb(29, 74, 197);
    border-radius: 10px;
    /* text-align:center; */
    /* font-size: 18px; */
}
.mid h1{
    display: block;
    /* width:0%; */
    margin:auto;
    /* border: 2px solid green; */
    /* background-color: rgb(148, 179, 199); */
    color: white;
    /* border-radius: 10px; */
    text-align:center;
    /* font-size: 25px; */
}

/*.left{
    display: inline-block;
    position:absolute;
    left: 40px;
    padding: 2px 2px;
    /* margin-bottom: 20px; */
   /* color: white;
    background-color: rgb(29, 74, 197);
    border-radius: 6px;
    border: 2px solid black;
    width: 200px;
    /* top: 20px; */
    /* border: 2px solid green; 
}*/
.top{
    position:absolute;
     top:5px; 
     left: 650px;
     color: red;
    /* margin:0px 650px; */
}

.right{
    position:absolute;
    right:30px;
    top:30px;
    /* display: inline-block; */
    display: block;
    width:20%;
    margin:20px auto;
    border: 2px solid black;
    background-color: rgb(148, 179, 199);
    border-radius: 10px;
    /* border: 2px solid green; */
}

.navbar{
    display: inline-block;
}
.navbar li{
    display: inline-block;
    padding: 10px 0px ;
    font-size: 18px;
    text-align: center;
}
.navbar li a{
    color: brown;
    text-decoration: none;
    /* text-align: center; */
    /* padding: 34px 15px; */
}
.navbar li a:hover,.navbar li a.active{
    /* text-decoration: underline; */
    color: white;
}

</style>
<body>
    <div class="header">
        <h1>DEAN PAGE</h1>
        
    </div>
    <div class="top">
        <?php if(isset($_SESSION['leave'])) : ?>
            <h3>
                <?php
                   echo $_SESSION['leave'];
                   unset($_SESSION['leave']);
                ?>
            <h3>
        <?php endif ?>
    </div>
    <div class="left">
        <?php if(isset($_SESSION['success'])) : ?>
            <h3>
                <?php
                //    echo $_SESSION['success'];
                //    unset($_SESSION['success']);
                ?>
            <h3>
        <?php endif ?>
    </div>
    <div class ="top">
    <?php if(isset($_SESSION['msg4'])) : ?>
            <h3>
                <?php
                   echo $_SESSION['msg4'];
                   unset($_SESSION['msg4']);
                ?>
            <h3>
        <?php endif ?>
    </div>
    <div class="mid">
        <h1> Welcome <strong> <?php echo "DEAN"; ?></strong><h1> 
    </div>

    <div class="right">
            <ul class="navbar">
                <li><a href="personal_profile_dean.php">PROFILE</a></li>
                <li class="c"><a href="dean_leave_recieved.php"> APPLICATION RECIEVED </a></li>
                <li><a href="dean_leave.php">APPLY FOR LEAVE </a></li>
                <li><a href="dean_leave_status.php">LEAVE STATUS</a></li>
                <!-- <li><a href="register.php">Register</a></li> -->
                <!-- <li><a href="#">Leave</a></li> -->
            </ul>
    </div>

    <div class="content">
        
        
<!-- if the user logged in then print information -->
    <?php if(isset($_SESSION['User'])) : ?>
        <!-- <p> Welcome <strong> <?php// echo $_SESSION['User']; ?></strong></p> -->
        <?php  $u = $_SESSION['User'];
             $sql = "SELECT User,Name,Branch,leave_days FROM `dean` WHERE `User`= '$u'";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($result);
        ?>
        <p> <strong>Username:  <?php echo $row['User']; ?></strong></p>
        <p> <strong>Name:  <?php echo $row['Name']; ?></strong></p>
        <p> <strong>Department:  <?php echo $row['Branch']; ?></strong></p>
        <p> <strong>Number of Leave Days Available: <?php echo $row['leave_days']; ?></p>
        <p class="btn"><a href="dean.php?logout='1'" 
         style="color:white;text-decoration:none;";>LOGOUT</a></p>
    <!-- <button class="btn" name ="Logout" type="submit">Logout<button> -->
    <?php endif ?>   
    </div>
  <!-- //  style="color:red " -->

</body>
</html>