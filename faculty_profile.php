<?php
include ('connection.php') ;
include ('connection2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>FACULTY_PROFILE_PAGE</title>
</head>
<style>
body{
    margin: 0px;
    padding: 0px;
    background: url('IIT_image2.jpg');
    /* background: skyblue; */
    /* width:100%; */
    height: 100%; 
    /* background-position: center;  */
    /* background-repeat: no-repeat;  */
    /* background-size: cover;  */
    
    }
.content_table{
    border-collapse:collapse;
    position:absolute;
    top:240px;
    left:450px;
    right:150px;
    /* margin: 40px 100px; */
    margin-right: 50px;
    font-size:15px;
    min-width:500px;
    max-width: 1200px;
    /* width: 100%; */
    border-radius: 5px;
    border: 1px solid brown;
    /* table-layout: fixed; */
}
.content_table thead tr{
    background-color: rgb(43, 113, 156);
    background-color: DarkCyan;
    /* background-color: red; */
    color: grey;
    text-align: left;
    font-weight: bold;
}
.content_table th,
.content_table td{
    padding: 12px 15px;
    border: 1px solid brown;
    color:white;
    /* width:80px; */
    /* overflow:hidden; */
}

.content_table tbody tr{
    border: 1px solid brown;
    background-color: DarkCyan;
     /* rgb(178, 192, 201); */
}
.content_table tbody tr:nth-of-type(even){
    border: 1px solid brown;
    background-color: rgb(43, 113, 156);
    background-color: DarkCyan;
}

.mid{
    display: block;
    width:20%;
    margin:60px 1100px;
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


.container h1{
    color: white;
    position:absolute;
    top:60px;
    left:510px;
    text-align: center;
    display: inline-block; 
    background-color: rgb(29, 74, 197);
    border-radius: 5px;
    /* margin: 20px 510px; */
    /* border: 2px solid green; */
    width:30%;
}

.top{
    position:absolute;
     top:5px; 
     left: 650px;
     color: red;
    /* margin:0px 650px; */
}

</style>

<body>


<header class="header">

        <!-- mid box -->
        <div class="mid">
           <ul class="navbar">
               <li><a href="home.php">HOME</a></li>
               <li><a href="login.php">LOGIN</a></li>
           </ul>
       </div>
   </header>

   <div class ="top">
    <?php if(isset($_SESSION['msg6'])) : ?>
            <h3>
                <?php
                    echo $_SESSION['msg6'];
                    unset($_SESSION['msg6']);
                ?>
            <h3>
        <?php endif ?>
    </div>

    <div class="container">
        <h1>FACULTY PROFILE</h1>
    </div>    
<table class="content_table">
    <thead>
        <tr>
            <th>User</th>
            <th>Name</th>
            <th>Branch</th>
            <th>Courses</th>
            <th>Publication</th>
            <th>Background</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // $User=$_SESSION['User'];
        // $sql = "SELECT User,day_leave,Branch,start_date,end_date,faculty_comment,hod_comment,
        // hod_approve,dean_comment,dean_approve,Status FROM faculty_leave WHERE User='$User'";
        // $result=mysqli_query($connect,$sql);
            $collection = $db->user;
            $cursor = $collection->find();
        // if(mysqli_num_rows($result)>0){
        //     while($row=mysqli_fetch_assoc($result)){
            foreach ($cursor as $row) {
                $c=" ";
                $p = " ";
                $r=" ";
                foreach($row->Course as $course){
                     $c = $c." ".$course.",";
                }
                foreach($row->Publication as $course){
                    $p = $p." ".$course.",";
                }
               foreach($row->Research as $course){
                $r = $r." ".$course.",";
                }
                echo "<tr><td>".$row["User"]."</td><td>"
                .$row["Name"]."</td><td>"
                .$row["Branch"]."</td><td>"
                .$c."</td><td>"
                .$p."</td><td>"
                .$r."</td>";
            }
        //         echo "</table>";
            
        ?>
    </tbody>
</table>
</body>
</html>