<?php //include 'connection.php'?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="style.css">
    <title>Home Page</title>
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
    width:35%;
    margin:35px auto;
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

#home {
   /* display: flex;
    flex-direction:column;*/
    /* padding: 3px 20px; */
    /* justify-content: center; */
    /* align-items: center; */
    display: block;
    color: white;
    background-color: rgb(75, 156, 211);
    border-radius: 6px;
    border: 2px solid black;
}
</style>
<body>
    <!-- <img class="bg" src="IIT_image2.jpg" alt="IIT Ropar"> -->
    <header class="header">
        
         <!-- left box -->
         <div class="left">
            <section id="home">
                <h1 class="H-primary"> APPLICATION LEAVE PORTAL </h1>
            </section>
         </div>

         <!-- mid box -->
         <div class="mid">
            <ul class="navbar">
                <li><a href="home.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="faculty_profile.php">Faculty Profile</a></li>
            </ul>
        </div>

        <!-- right box -->
        <div class="right">
            
        </div>
    </header>
    
      <!-- <div class="container">
        <h1>Login</h1>

        <form action="index.php" method="post">
            <input type="email" name="email" id="email" placeholder="Enter Email">
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <textarea name="desc" id="desc" cols="20" rows="10"
            placeholder="Enter Comments related to Leave application"></textarea>
            <button class="btn" name="submit">Submit</button>
            <button class="btn">Reset</button>

         </form>
         </div> --> 
    <script src="index.js"></script>
    <!-- INSERT INTO `login` (`SNo.`, `Email`, `Password`, `Comment`, `date`)  -->
    <!-- VALUES ('1', 'keshri@gmail.com', '1234', 'I want leave',  -->
    <!-- current_timestamp()); -->
</body>
</html>

