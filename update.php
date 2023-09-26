<?php

    session_start();
    
    if(!isset($_SESSION['username']))
        {
            header("location:login.php");
        }

    elseif($_SESSION['usertype']!="admin")
        {
            header("location:login.php");

        }
     
    $host="localhost";

    $user="root";

    $password="";

    $db="school";


    $data=mysqli_connect($host,$user,$password,$db);
    
    $id = $_GET['student_id'];
    $sql = "SELECT * FROM user WHERE id='$id'";

    $result = mysqli_query($data,$sql);
    $info = $result->fetch_assoc(); 

    if(isset($_POST['update']))
    {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $query = "UPDATE user SET username='$username',email='$email',phone='$phone',password='$password' WHERE id='$id'";
        $result2 = mysqli_query($data,$query);

        if($result2)
        {   
            $_SESSION['message'] = "Data Updated Successfully";
            header("location:view_student.php");
        }

    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <?php
	
	include 'admin_css.php';
	
	?>
    <link rel="stylesheet" href="admin.css">

    <style>
        label{
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg{
            background-color: skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
    </style>


</head>
<body>

    <?php
	
	include 'admin_sidebar.php';
	
	?>

    <div class="content">
		<center>
                <h1>Update Student Information</h1>

                <div class="div_deg">

                <form action="#" method="POST" >
                    
                    <div>
                        <label >Name</label>
                        <input type="text" name="name" value="<?php echo "{$info['username']}" ?>">
                    </div>

                    <div>
                        <label >Email</label>
                        <input type="text" name="email" value="<?php echo "{$info['email']}"?>">
                    </div>

                    <div>
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?php echo "{$info['phone']}" ?>">
                    </div>

                    <div>
                        <label >Password</label>
                        <input type="text" name="password" value="<?php echo "{$info['password']}" ?>">
                    </div>

                    <div  >
                        
                        <input class="btn btn-success" id="submit" type="submit" value="Update Info" name="update">
                    </div>

                </form>
                </div>
        </center>
	</div>

</body>
</html>