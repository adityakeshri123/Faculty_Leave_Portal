
<?php
   // connect to mongodb
//    include ('connection.php');
   require_once __DIR__ . '/vendor/autoload.php';
   $m = new MongoDB\Client();
   // var_dump($m);
//    echo "Connection to database successfully";

    // FOR ENTER THE DATA OF FACULTY PROFILE IN MONGODB

   $db = $m->practice;
    if(isset($_POST['register'])){
        $collection = $db->user;
        $User=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $document = array( 
            "User" => $User, 
            "Name" => $name,
            "Branch" => $branch,
            "Course" =>[],
            "Publication"=>[],
            "Research"=>[]
        );
            
        $result=$collection->insertone($document);
        // echo "Document inserted successfully Object id :".
        // $result->getInsertedId();
    }


    // FOR EDIT THE PROFILE OF FACULTY

    if(isset($_POST['profile_add']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            $c[$i]=$course;
            $i++;
        }
        if($Course) $c[$i]=$Course;
        $i=0;
       foreach($row->Publication as $course){
            $p[$i]=$course;
            $i++;
        }
        if($publication) $p[$i]=$publication;
        $i=0;
        foreach($row->Research as $course){
            $r[$i]=$course;
            $i++;
        }
        if($research) $r[$i]=$research;
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Name' => $name]]);
            $sql= "UPDATE login SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE hod SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Branch' => $branch]]);
            $sql= "UPDATE login SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE hod SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile.php');
    }

    // FOR DELETE THE PROFILE OF FACULTY

    if(isset($_POST['profile_delete']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            if($course!=$Course){
                $c[$i]=$course;
                $i++;
            }
        }
        $i=0;
       foreach($row->Publication as $course){
            if($course!=$publication){
                $p[$i]=$course;
                $i++;
            }
        }
        $i=0;
        foreach($row->Research as $course){
            if($course!=$research){
                $r[$i]=$course;
                $i++;
            }
        }
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user , 'Name' =>$name],
                    ['$set' =>['Name' => ""]]);
            $sql= "UPDATE login SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE hod SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user , 'Branch' =>$branch ],
                    ['$set' =>['Branch' => '']]);
            $sql= "UPDATE login SET  Branch='' WHERE User='$user' AND Branch='$branch' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE hod SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile.php');
    }

    // FOR EDIT THE PROFILE OF HOD

    if(isset($_POST['profile_add_hod']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            $c[$i]=$course;
            $i++;
        }
        if($Course) $c[$i]=$Course;
        $i=0;
       foreach($row->Publication as $course){
            $p[$i]=$course;
            $i++;
        }
        if($publication) $p[$i]=$publication;
        $i=0;
        foreach($row->Research as $course){
            $r[$i]=$course;
            $i++;
        }
        if($research) $r[$i]=$research;
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Name' => $name]]);
            $sql= "UPDATE login SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE hod SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Branch' => $branch]]);
            $sql= "UPDATE login SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE hod SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_hod.php');
    }

    // FOR DELETE THE PROFILE OF HOD

    if(isset($_POST['profile_delete_hod']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            if($course!=$Course){
                $c[$i]=$course;
                $i++;
            }
        }
        $i=0;
       foreach($row->Publication as $course){
            if($course!=$publication){
                $p[$i]=$course;
                $i++;
            }
        }
        $i=0;
        foreach($row->Research as $course){
            if($course!=$research){
                $r[$i]=$course;
                $i++;
            }
        }
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user , 'Name' =>$name],
                    ['$set' =>['Name' => ""]]);
            $sql= "UPDATE login SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE hod SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user , 'Branch' =>$branch ],
                    ['$set' =>['Branch' => '']]);
            $sql= "UPDATE login SET  Branch='' WHERE User='$user' AND Branch='$branch' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE hod SET  Branch='' WHERE User='$user' AND Branch='$branch'";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_hod.php');
    }

    // FOR EDIT THE PROFILE OF DEAN

    if(isset($_POST['profile_add_dean']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            $c[$i]=$course;
            $i++;
        }
        if($Course) $c[$i]=$Course;
        $i=0;
       foreach($row->Publication as $course){
            $p[$i]=$course;
            $i++;
        }
        if($publication) $p[$i]=$publication;
        $i=0;
        foreach($row->Research as $course){
            $r[$i]=$course;
            $i++;
        }
        if($research) $r[$i]=$research;
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Name' => $name]]);
            $sql= "UPDATE login SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Branch' => $branch]]);
            $sql= "UPDATE login SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE dean SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_dean.php');
    }

    // FOR DELETE THE PROFILE OF DEAN

    if(isset($_POST['profile_delete_dean']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            if($course!=$Course){
                $c[$i]=$course;
                $i++;
            }
        }
        $i=0;
       foreach($row->Publication as $course){
            if($course!=$publication){
                $p[$i]=$course;
                $i++;
            }
        }
        $i=0;
        foreach($row->Research as $course){
            if($course!=$research){
                $r[$i]=$course;
                $i++;
            }
        }
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user , 'Name' =>$name],
                    ['$set' =>['Name' => ""]]);
            $sql= "UPDATE login SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE dean SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user , 'Branch' =>$branch ],
                    ['$set' =>['Branch' => '']]);
            $sql= "UPDATE login SET  Branch='' WHERE User='$user' AND Branch='$branch' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE dean SET  Branch='' WHERE User='$user' AND Branch='$branch'";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_dean.php');
    }

    // FOR EDIT THE PROFILE OF DIRECTOR

    if(isset($_POST['profile_add_director']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            $c[$i]=$course;
            $i++;
        }
        if($Course) $c[$i]=$Course;
        $i=0;
       foreach($row->Publication as $course){
            $p[$i]=$course;
            $i++;
        }
        if($publication) $p[$i]=$publication;
        $i=0;
        foreach($row->Research as $course){
            $r[$i]=$course;
            $i++;
        }
        if($research) $r[$i]=$research;
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Name' => $name]]);
            $sql= "UPDATE login SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE director SET  Name='$name' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user],
                    ['$set' =>['Branch' => $branch]]);
            $sql= "UPDATE login SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE director SET  Branch='$branch' WHERE User='$user' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_director.php');
    }

    // FOR DELETE THE PROFILE OF DIRECTOR

    if(isset($_POST['profile_delete_director']) && $_SESSION['User']==$_POST['User']){
        $collection = $db->user;
        $user=$_POST['User'];
        $name=$_POST['Name'];
        $branch=$_POST['Branch'];
        $Course=$_POST['Course'];
        $publication=$_POST['Publication'];
        $research=$_POST['Research'];
        $c= array();
        $p = array();
        $r=array();
        $i=0;
        $row= $collection->findOne(['User'=>$user]);
        foreach($row->Course as $course){
            if($course!=$Course){
                $c[$i]=$course;
                $i++;
            }
        }
        $i=0;
       foreach($row->Publication as $course){
            if($course!=$publication){
                $p[$i]=$course;
                $i++;
            }
        }
        $i=0;
        foreach($row->Research as $course){
            if($course!=$research){
                $r[$i]=$course;
                $i++;
            }
        }
        $collection->updateOne(['User'=>$user],
                    ['$set' =>['Course' => $c , 'Publication' => $p, 'Research' => $r ]]);

        if($name){
            $collection->updateOne(['User'=>$user , 'Name' =>$name],
                    ['$set' =>['Name' => ""]]);
            $sql= "UPDATE login SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE director SET  Name='' WHERE User='$user' AND Name='$name' ";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        if($branch){
            $collection->updateOne(['User'=>$user , 'Branch' =>$branch ],
                    ['$set' =>['Branch' => '']]);
            $sql= "UPDATE login SET  Branch='' WHERE User='$user' AND Branch='$branch' ";
            $result=mysqli_query($connect,$sql);
            $sql= "UPDATE director SET  Branch='' WHERE User='$user' AND Branch='$branch'";
            $result=mysqli_query($connect,$sql);
            // $sql= "UPDATE dean SET  Name='$name' WHERE User='$user' ";
            // $result=mysqli_query($connect,$sql);
        }
        header('Location: personal_profile_director.php');
    }
?>