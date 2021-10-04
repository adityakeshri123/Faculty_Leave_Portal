<?php
include ('connection.php') ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>HOD_RESPOND_COMMENT_PAGE</title>
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
    width:30%;
    margin:20px auto;
    border: 2px solid green;
    background-color: rgb(148, 179, 199);
    border-radius: 10px;
}
.navbar{
    display: inline-block;
}
.navbar li{
    display: inline-block;
    font-size: 18px;
}
.navbar li a{
    color: brown;
    text-decoration: none;
    padding: 34px 23px;
}
.navbar li a:hover,.navbar li a.active{
    /* text-decoration: underline; */
    color: white;
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
    width:80%;
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
.space{
    width: 92%;
    margin:0px auto;
    padding: 10px;
    /* border: 1px solid green; */
    /* text-align: 50px; */
    color : #ac1010f2;
    /* background-color: rgb(178, 192, 201); */
    border-radius: 5px;
    /* text-align:left; */
}



.tab { 
       display:inline-block; 
       margin-left: 40%; 
}

.text{
    min-width: 200px;
    max-width: 700px;
    width: 100%;
  }

  .top{
    position:absolute;
     top:650px; 
     left: 640px;
     color: red;
    /* margin:0px 650px; */
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
               <li><a href="hod.php">HOME</a></li>
               <!-- <li><a href="login.php">Login</a></li> -->
               <li><a href="hod_leave_recieved.php">APPLICATION RECIEVED</a></li>
               <!-- <li><a href="#">Leave</a></li> -->
           </ul>
       </div>

       <!-- right box -->
       <div class="right">
           
       </div>
   </header>
   
   <div class="top">
        <?php if(isset($_SESSION['error'])) : ?>
            <strong>
                <?php
                //    echo $_SESSION['error'];
                //    unset($_SESSION['error']);
                ?>
            </strong>
        <?php endif ?>
    </div>

    <div class="container">
        <h1>ADD COMMENT</h1>
        <form action="hod_respond_comment.php" method="post">
            
        <input type="text" name="User" required id="User" placeholder="Enter User name of Applicant">
            <textarea name="hod_comment" id="hod_comment" cols="20" rows="10"
            placeholder="HOD Please Enter Your Comments related to Application"></textarea>
            <input type="text" name="hod_approve" required id="hod_approve" placeholder="Hod Approve : YES or NO">
            <!-- <button class="btn" name ="hod_reject" type="submit">Reject</button> -->
            <button class="btn" name ="hodapprove" type="submit">Submit</button>
            
                
                <p class="error"> Must Enter Right User Name</p>

        </form>
    </div>


</body>
</html>