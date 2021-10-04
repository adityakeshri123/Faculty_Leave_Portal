<?php
//  include 'home.php';
//  include 'login.php';
//  include 'register.php';
//   include 'errors.php';
// if(isset($_POST['Email'])){
    session_start();  
    // ini_set('memory_limit', '1024M'); 
    $server='localhost';
    $username='root';
    $password='';
    $db='leave_portal';

    $error="hi";
    $errors = array();
    $connect=mysqli_connect($server,$username,$password,$db);

    if(!$connect){
        die("connection failed".mysqli_connect_error());
    }
      // Registration of User
    // echo "Successfully connected";
    // $db=mysqli_select_db('leave_portal');
if(isset($_POST['register'])){
    $user=$_POST['User'];
    $name=$_POST['Name'];
    $password=$_POST['Password'];
    $branch=$_POST['Branch'];
    // $desc=$_POST['Comment'];

    //form validation

    if(empty($user)) array_push($errors,"Username is required");

    // check databse for existing user with same email as ,we want 
    // unique email in database.

    $user_check = "SELECT * FROM `login` WHERE `User`='$user'";
    $results = mysqli_query($connect,$user_check);
    $count=mysqli_num_rows($results);
  //  $user = mysqli_fetch_assoc($results);

   if($count>0){
    //    if($user['Email']==$email){
           array_push($errors,"Username already exists");
        // }
   }
   else{
    $password=md5($password);
    if($user=="director"){
        $sql="INSERT INTO director(User,Name,Password,Branch)
        VALUES ('$user', '$name', '$password','$branch');";   //current_timestamp()
    //  echo $sql;


        mysqli_query($connect,$sql);
        // $connect->query($sql);
        $_SESSION['User']=$user;
        $_SESSION['Name']=$name;
        $_SESSION['Branch']=$branch;
        //  $_SESSION['leave_days']=45;
        $_SESSION['success']="Logged in Successfully";
        header('Location: login.php');
    }
    else{
        $sql="INSERT INTO login(User,Name,Password,Branch,leave_days)
        VALUES ('$user', '$name', '$password','$branch',45);";   //current_timestamp()
        //  echo $sql;


        mysqli_query($connect,$sql);
        // $connect->query($sql);
        $_SESSION['User']=$user;
        $_SESSION['Name']=$name;
        $_SESSION['Branch']=$branch;
        $_SESSION['leave_days']=45;
        $_SESSION['success']="Logged in Successfully";
        header('Location: login.php');
    }
    // session_destroy();
    // $connect->close();
   }
}



    // Login of User
    // $error="";
    if(isset($_POST['login'])){
        $user=$_POST['User'];
        $password=$_POST['Password'];

        // $name=$_POST['Name'];
        // $desc=$_POST['Comment'];

        // error checking

        if(empty($user)){
            array_push($errors,"Username is Required");
        }

        if(empty($password)){
            array_push($errors,"Password is Required");
        }

        if(count($errors)==0){
            $password=md5($password);

            if($user=="director"){
                $sql = "SELECT User,Name,Branch FROM `director` WHERE `User`='$user' 
                    AND `Password`='$password'";

                $result=mysqli_query($connect,$sql);
            // $row=mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result)>0){
                    $row=mysqli_fetch_assoc($result);
                    $_SESSION['User']=$user;
                    $_SESSION['Name']=$row["Name"];
                    $_SESSION['Branch']=$row["Branch"];
                    // $_SESSION['leave_days']=$row["leave_days"];
                    $_SESSION['success']="Logged in Successfully";
                    header('Location: director.php');
                }
            }
            else{

                $sql1 = "SELECT User,Name,Branch,leave_days FROM `hod` WHERE `User`='$user' 
                AND `Password`='$password'";

                $result1=mysqli_query($connect,$sql1);
            // $row=mysqli_fetch_assoc($result);
                if(mysqli_num_rows($result1)>0){
                    $row=mysqli_fetch_assoc($result1);
                    $_SESSION['User']=$user;
                    $_SESSION['Name']=$row["Name"];
                    $_SESSION['Branch']=$row["Branch"];
                    $_SESSION['leave_days']=$row["leave_days"];
                    $_SESSION['success']="Logged in Successfully";
                    header('Location: hod.php');
                }
                else{
                        $sql = "SELECT User,Name,Branch,leave_days FROM `dean` WHERE `User`='$user' 
                        AND `Password`='$password'";

                        $result=mysqli_query($connect,$sql);
                // $row=mysqli_fetch_assoc($result);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        $_SESSION['User']=$user;
                        $_SESSION['Name']=$row["Name"];
                        $_SESSION['Branch']=$row["Branch"];
                        $_SESSION['leave_days']=$row["leave_days"];
                        $_SESSION['success']="Logged in Successfully";
                        header('Location: dean.php');
                    }

                    else{

                    $sql = "SELECT User,Name,Branch,leave_days FROM `login` WHERE `User`='$user' 
                    AND `Password`='$password'";

                    $result=mysqli_query($connect,$sql);
                // $row=mysqli_fetch_assoc($result);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        $_SESSION['User']=$user;
                        $_SESSION['Name']=$row["Name"];
                        $_SESSION['Branch']=$row["Branch"];
                        $_SESSION['leave_days']=$row["leave_days"];
                        $_SESSION['success']="Logged in Successfully";
                        header('Location: faculty.php');
                        }
                    }
                }
            }
        }
        else{
            array_push($errors,"Wrong email or password");
            $error = "Wrong email or password";
            header('Location: login.php');
            }
    }

  /*  if(isset($_SESSION['Email'])){
        $_SESSION['msg']="First You need to Logged in";
        header("Location: login.php");
    }
       */

    //Logout of User   
    if(isset($_GET['logout'])){
        // session_destroy();
        unset($_SESSION['User']);
        header("Location: login.php");
    }


    // Select hod

    if(isset($_POST['appointhod'])){
        $user=$_POST['User'];
        $branch=$_POST['Branch'];
        $sql = "SELECT User,Name,Password,Branch,leave_days FROM login WHERE User='$user' AND Branch='$branch'";
        $result=mysqli_query($connect,$sql);
        if(mysqli_num_rows($result)>0){

            $sql3 = "SELECT User,Name,Password,Branch,leave_days FROM dean WHERE Branch='$branch' and User='$user'";
            $result3=mysqli_query($connect,$sql3);
            if(mysqli_num_rows($result3)>0){
                $_SESSION['error_hod']="This Faculty already at dean position";
                header('Location: selecthod.php');
            }
            else{
            $sql3 = "SELECT User,Name,Password,Branch,leave_days FROM hod WHERE Branch='$branch'";
            $result3=mysqli_query($connect,$sql3);
            if(mysqli_num_rows($result3)>0){
                $del = "DELETE FROM hod WHERE Branch='$branch'";
                if (mysqli_query($connect, $del)){ $_SESSION['msg1']="REMOVED FROM HOD";}
            }
        
                $sql1 = "SELECT User,Name,Password,Branch,leave_days FROM login WHERE User='$user' AND Branch='$branch'";
                $result1=mysqli_query($connect,$sql1);
              //  $row=mysqli_fetch_assoc($result);
             //   $password=$row['Password'];
             //   $name=$row['Name'];
            //    $leave=$row['leave_days'];
                $sql2= "INSERT INTO hod (User,Name,Password,Branch,leave_days) 
                SELECT User,Name,Password,Branch,leave_days FROM login
                WHERE User='$user' AND Branch='$branch'";
                mysqli_query($connect,$sql2);
                
                $_SESSION['msg3']="NEW HOD APPOINTED";
                $_SESSION['msg2']="APPOINTED AS NEW HOD";
                // $msg2="APPOINTED AS NEW HOD";
                header('Location: director.php');
            }
         }
        else{
            $_SESSION['error']="this user name or department not exist";
            header('Location: selecthod.php');
        }
    }


    // select dean

    if(isset($_POST['appointdean'])){
        $user=$_POST['User'];
        $branch=$_POST['Branch'];
        $sql = "SELECT User,Name,Password,Branch,leave_days FROM login WHERE User='$user' AND Branch='$branch'";
        $result=mysqli_query($connect,$sql);
        if(mysqli_num_rows($result)>0){
            $sql3 = "SELECT User,Name,Password,Branch,leave_days FROM hod WHERE Branch='$branch' and User='$user'";
            $result3=mysqli_query($connect,$sql3);
            if(mysqli_num_rows($result3)>0){
                $_SESSION['error_dean']="This Faculty already at hod position";
                header('Location: selectdean.php');
            }
            else{
                    $sql4 = "SELECT * FROM dean ";
                    $result4=mysqli_query($connect,$sql4);
                    if(mysqli_num_rows($result4)>0){
                        $del = "DELETE FROM dean";
                        if (mysqli_query($connect, $del)){ $_SESSION['msg1']="REMOVED FROM DEAN";}
                    }
                $sql1 = "SELECT User,Name,Password,Branch,leave_days FROM login WHERE User='$user' AND Branch='$branch'";
                $result1=mysqli_query($connect,$sql1);
              //  $row=mysqli_fetch_assoc($result);
             //   $password=$row['Password'];
             //   $name=$row['Name'];
            //    $leave=$row['leave_days'];
                $sql2= "INSERT INTO dean (User,Name,Password,Branch,leave_days) 
                SELECT User,Name,Password,Branch,leave_days FROM login
                WHERE User='$user' AND Branch='$branch'";
                mysqli_query($connect,$sql2);
                
                $_SESSION['msg3']="NEW DEAN APPOINTED";
                $_SESSION['msg4']="APPOINTED AS NEW DEAN";
                // $msg2="APPOINTED AS NEW HOD";
                header('Location: director.php');
            }
         }
        else{
            $_SESSION['error']="this user name or department not exist";
            header('Location: selectdean.php');
        }
    }


    // Apply faculty leave 
    if(isset($_POST['faculty_apply'])){
        $user=$_POST['User'];
        $day_leave=$_POST['day_leave'];
        $branch=$_POST['Branch'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $faculty_comment=$_POST['faculty_comment'];      
        
        
        if($user==$_SESSION['User'] && $branch==$_SESSION['Branch']){

            $sql="SELECT * FROM faculty_leave WHERE User='$user' AND Status='Pending' ";
            $result=mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0){
                header('Location: faculty_leave.php');
                $_SESSION['msg5']="Your One application is already at Pending";
            }
            else{
                $sql="INSERT INTO faculty_leave (Status,User,day_leave,Branch,start_date,end_date,faculty_comment) 
                VALUES ('Pending','$user', '$day_leave','$branch','$start_date', '$end_date','$faculty_comment');";
                $result=mysqli_query($connect,$sql);
                $_SESSION['leave']="APPLICATION SUBMITTED";
                header('Location: faculty.php');
            }
        }

        else{
            $_SESSION['error']="Enter Your Correct Username and Branch";
            header('Location: faculty_leave.php');
        }

    }


    // faculty_add_comment

    if(isset($_POST['faculty_comment_add'])){
        $user=$_POST['User'];
        $faculty_comment=$_POST['faculty_comment'];
        // $hod_approve=$_POST['hod_approve'];
        // $branch=$_SESSION['Branch'];

        if($user==$_SESSION['User']){
            $sql = "SELECT faculty_comment FROM faculty_leave WHERE User='$user' AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            if( mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $faculty_comment= $faculty_comment."\r\n".$row["faculty_comment"];
                $sql= "UPDATE faculty_leave SET  faculty_comment='$faculty_comment' WHERE User='$user' AND Status='Pending'";
                $result=mysqli_query($connect,$sql);
                $_SESSION['msg8']="COMMENT GETS ADDED";
                header('Location: faculty_leave_status.php');
            }
        }
        else{
            $_SESSION['msg9']="Enter Your Correct username";
            header('Location: faculty_respond_comment.php');
        }

    }

    // hod_respond_comment

    if(isset($_POST['hodapprove'])){
        $user=$_POST['User'];
        $hod_comment=$_POST['hod_comment'];
        $hod_approve=$_POST['hod_approve'];
        $branch=$_SESSION['Branch'];
        $sql = "SELECT hod_comment,hod_approve FROM faculty_leave WHERE User='$user' AND Branch='$branch' AND Status='Pending'";
        $result=mysqli_query($connect,$sql);
        if( mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $hod_comment= $hod_comment."\r\n".$row["hod_comment"];
            $sql= "UPDATE faculty_leave SET  hod_comment='$hod_comment',hod_approve='$hod_approve' WHERE User='$user' AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            $_SESSION['msg6']="COMMENT GETS ADDED";
            header('Location: hod_leave_recieved.php');
        }
        else{
            $_SESSION['msg7']="Enter Correct username";
            header('Location: hod_respond_comment.php');
        }

    }

     // dean_respond_comment

     if(isset($_POST['deanapprove'])){
        $user=$_POST['User'];
        $dean_comment=$_POST['dean_comment'];
        $dean_approve=$_POST['dean_approve'];
        $status='Pending';
        // $branch=$_SESSION['Branch'];
        $sql = "SELECT dean_comment,dean_approve,day_leave FROM faculty_leave WHERE User='$user' AND hod_approve='YES' AND Status='Pending'";
        $result=mysqli_query($connect,$sql);
        if( mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $dean_comment= $dean_comment."\r\n".$row["dean_comment"];
            if($dean_approve=='YES') {
                $status='Approve';
                $day_leave=$row["day_leave"];
                $sql1 = "SELECT leave_days FROM login WHERE User='$user'";
                $result1=mysqli_query($connect,$sql1);
                $row1=mysqli_fetch_assoc($result1);
                $leave_day=$row1['leave_days'];
                $leave_day=$leave_day - $day_leave;
                if($leave_day<0){
                    $leave_day=0;
                    $_SESSION['msg12']="Doesn't have enough leaves";
                }
                $sql2= "UPDATE login SET  leave_days='$leave_day' WHERE User='$user' ";
                $result2=mysqli_query($connect,$sql2);
            }
            $sql= "UPDATE faculty_leave SET  dean_comment='$dean_comment',dean_approve='$dean_approve',Status='$status'
                     WHERE User='$user' AND hod_approve='YES'AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            $_SESSION['msg10']="COMMENT GETS ADDED";
            header('Location: dean_leave_recieved.php');
        }
        else{
            $_SESSION['msg11']="Enter Correct username";
            header('Location: dean_respond_comment.php');
        }

    }

    
    
    // Apply hod leave 
    if(isset($_POST['hod_apply'])){
        $user=$_POST['User'];
        $day_leave=$_POST['day_leave'];
        $branch=$_POST['Branch'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $cross_faculty_comment=$_POST['cross_faculty_comment'];      
        
        
        if($user==$_SESSION['User'] && $branch==$_SESSION['Branch']){

            $sql="SELECT * FROM cross_faculty_leave WHERE User='$user' AND Status='Pending' ";
            $result=mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0){
                header('Location: hod_leave.php');
                $_SESSION['msg13']="Your One application is already at Pending";
            }
            else{
                $sql="INSERT INTO cross_faculty_leave (Status,User,day_leave,Branch,start_date,end_date,cross_faculty_comment) 
                VALUES ('Pending','$user', '$day_leave','$branch','$start_date', '$end_date','$cross_faculty_comment');";
                $result=mysqli_query($connect,$sql);
                $_SESSION['leave']="APPLICATION SUBMITTED";
                header('Location: hod.php');
            }
        }

        else{
            $_SESSION['error']="Enter Your Correct Username and Branch";
            header('Location: hod_leave.php');
        }

    }

    // hod_add_comment related to his own leave application

    if(isset($_POST['hod_comment_add'])){
        $user=$_POST['User'];
        $cross_faculty_comment=$_POST['cross_faculty_comment'];
        // $hod_approve=$_POST['hod_approve'];
        // $branch=$_SESSION['Branch'];

        if($user==$_SESSION['User']){
            $sql = "SELECT cross_faculty_comment FROM cross_faculty_leave WHERE User='$user' AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            if( mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $cross_faculty_comment= $cross_faculty_comment."\r\n".$row["cross_faculty_comment"];
                $sql= "UPDATE cross_faculty_leave SET  cross_faculty_comment='$cross_faculty_comment'
                         WHERE User='$user' AND Status='Pending'";
                $result=mysqli_query($connect,$sql);
                $_SESSION['msg14']="COMMENT GETS ADDED";
                header('Location: hod_leave_status.php');
            }
        }
        else{
            $_SESSION['msg15']="Enter Your Correct username";
            header('Location: hod_add_comment.php');
        }

    }

     
    // Apply dean leave 
    if(isset($_POST['dean_apply'])){
        $user=$_POST['User'];
        $day_leave=$_POST['day_leave'];
        $branch=$_POST['Branch'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $cross_faculty_comment=$_POST['cross_faculty_comment'];      
        
        
        if($user==$_SESSION['User'] && $branch==$_SESSION['Branch']){

            $sql="SELECT * FROM cross_faculty_leave WHERE User='$user' AND Status='Pending' ";
            $result=mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0){
                header('Location: dean_leave.php');
                $_SESSION['msg13']="Your One application is already at Pending";
            }
            else{
                $sql="INSERT INTO cross_faculty_leave (Status,User,day_leave,Branch,start_date,end_date,cross_faculty_comment) 
                VALUES ('Pending','$user', '$day_leave','$branch','$start_date', '$end_date','$cross_faculty_comment');";
                $result=mysqli_query($connect,$sql);
                $_SESSION['leave']="APPLICATION SUBMITTED";
                header('Location: dean.php');
            }
        }

        else{
            $_SESSION['error']="Enter Your Correct Username and Branch";
            header('Location: dean_leave.php');
        }

    }

    // dean_add_comment related to his own leave application

    if(isset($_POST['dean_comment_add'])){
        $user=$_POST['User'];
        $cross_faculty_comment=$_POST['cross_faculty_comment'];
        // $hod_approve=$_POST['hod_approve'];
        // $branch=$_SESSION['Branch'];

        if($user==$_SESSION['User']){
            $sql = "SELECT cross_faculty_comment FROM cross_faculty_leave WHERE User='$user' AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            if( mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $cross_faculty_comment= $cross_faculty_comment."\r\n".$row["cross_faculty_comment"];
                $sql= "UPDATE cross_faculty_leave SET  cross_faculty_comment='$cross_faculty_comment'
                         WHERE User='$user' AND Status='Pending'";
                $result=mysqli_query($connect,$sql);
                $_SESSION['msg16']="COMMENT GETS ADDED";
                header('Location: dean_leave_status.php');
            }
        }
        else{
            $_SESSION['msg17']="Enter Your Correct username";
            header('Location: dean_add_comment.php');
        }
    }

    // director_respond_comment

    if(isset($_POST['directorapprove'])){
        $user=$_POST['User'];
        $director_comment=$_POST['director_comment'];
        $director_approve=$_POST['director_approve'];
        $status='Pending';
        // $branch=$_SESSION['Branch'];
        $sql = "SELECT director_comment,director_approve,day_leave FROM cross_faculty_leave WHERE User='$user' AND Status='Pending'";
        $result=mysqli_query($connect,$sql);
        if( mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $director_comment= $director_comment."\r\n".$row["director_comment"];
            if($director_approve=='YES') {
                $status='Approve';
                $day_leave=$row["day_leave"];
                $sql1 = "SELECT leave_days FROM login WHERE User='$user'";
                $result1=mysqli_query($connect,$sql1);
                $row1=mysqli_fetch_assoc($result1);
                $leave_day=$row1['leave_days'];
                $leave_day=$leave_day - $day_leave;
                if($leave_day<0){
                    $leave_day=0;
                    $_SESSION['msg18']="Doesn't have enough leaves";
                }
                $sql2= "UPDATE login SET  leave_days='$leave_day' WHERE User='$user' ";
                $result2=mysqli_query($connect,$sql2);
                $sql2= "UPDATE hod SET  leave_days='$leave_day' WHERE User='$user' ";
                $result2=mysqli_query($connect,$sql2);
                $sql2= "UPDATE dean SET  leave_days='$leave_day' WHERE User='$user' ";
                $result2=mysqli_query($connect,$sql2);
            }
            $sql= "UPDATE cross_faculty_leave SET  director_comment='$director_comment',director_approve='$director_approve',Status='$status'
                     WHERE User='$user' AND Status='Pending'";
            $result=mysqli_query($connect,$sql);
            $_SESSION['msg19']="COMMENT GETS ADDED";
            header('Location: director_leave_recieved.php');
        }
        else{
            $_SESSION['msg20']="Enter Correct username";
            header('Location: director_respond_comment.php');
        }

    }

?>
<script>
    // alert('Looged in');
</script>
