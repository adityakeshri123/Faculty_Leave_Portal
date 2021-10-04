<?php include ('connection.php') ;
      include ('connection2.php') ;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Register Page</title>
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
    .left{
    display: inline-block;
    position:absolute;
    left: 40px;
    /* top: 20px; */
    /* border: 2px solid green; */
}
.mid{
    display: block;
    width:15%;
    margin:20px auto;
    border: 2px solid green;
    background-color: rgb(148, 179, 199);
    border-radius: 10px;
}
.right{
    position:absolute;
    right:34px;
    top:20px;
    display: inline-block;
    /* border: 2px solid green; */
}
.navbar{
    display: inline-block;
}
.navbar li{
    display: inline-block;
    font-size: 18px;
}
.navbar li a{
    color: black;
    text-decoration: none;
    padding: 34px 23px;
}
.navbar li a:hover,.navbar li a.active{
    /* text-decoration: underline; */
    color: white;
}
    .container{
    display: block;
    width:30%;
    text-align: center;
     background-color: rgb(178, 192, 201);
    margin:40px auto;
     border: 2px solid rgb(31, 27, 27); 
     border-radius: 6px;
     /* opacity:0.8; */
}
.container h1{
    color: white;
    text-align: center;
    display: inline-block; 
    background-color: rgb(29, 74, 197);
    border-radius: 10px;
    /* border: 2px solid green; */
    width:27%;
}

input,textarea{
    text-align: center;
    /* opacity:0.1; */
    border: 2px solid black;
    border-radius: 10px;
    font-size:16px;
    width:80%;
    margin: 11px;
    padding:7px;
}
.btn{
    color:white;
    background-color: rgb(29, 74, 197);
    padding: 4px 12px;
    margin: 10px;
    font-size: 16px;
    border: 2px solid black;
    border-radius: 10px;
    cursor:pointer;
}
.error{
    width: 92%;
    margin:0px auto;
    padding: 10px;
    /* border: 1px solid green; */
    color:red;
    /* background-color: rgb(178, 192, 201); */
    border-radius: 5px;
    /* text-align:left; */
}
</style>
<body>
<header class="header">
        
         <!-- left box -->
         <div class="left">
            <section id="home">
                <!-- <h1 class="H-primary"> APPLICATION LEAVE PORTAL </h1> -->
            </section>
         </div>

         <!-- mid box -->
         <div class="mid">
            <ul class="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <!-- <li><a href="register.php">Register</a></li> -->
                <!-- <li><a href="#">Leave</a></li> -->
            </ul>
        </div>

        <!-- right box -->
        <div class="right">
            
        </div>
    </header>
<div class="container">
        <h1>Register</h1>
        <form action="register.php" method="post">
    
            <input type="text" name="User" required id="User" placeholder="Enter User name">
            <input type="text" name="Name" required id="Name" placeholder="Enter Your name">
            <input type="password" name="Password" required id="Password" placeholder="Enter Password">
            <input type="text" name="Branch" required id="Branch" placeholder="Enter Your department">
            <!-- <textarea name="Comment" id="Comment" cols="20" rows="10" -->
            <!-- placeholder="Enter Comments related to Leave application"></textarea> -->
            <button class="btn" name ="register" type="submit">Submit</button>
            <p class="error"> Must Enter Unique User Name</p>
            <!-- <button class="btn">Reset</button> -->

        </form>
    </div>
</body>
</html>

