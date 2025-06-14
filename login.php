<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <style>
            *{
                margin:0px;
            }
            body{
                background-color:black;
            }
            .login{
                background: linear-gradient(to right,rgb(222, 243, 35), #87cefa);
                height: auto;
                width: 25%;
                border: 1px solid;
                margin-left:40%;
                margin-top:15%; 
                border-radius: 10px;
            }
            h1{
                font-size: 35px;
                text-align: center;
                padding-top:2%;
                margin-bottom: 8%;
            }
            label{  
                margin-left:25%;
                font-size: 20px;
                font-weight: bold;
            }
            input{
                height:30px;
                width:50%;
                margin-left: 25%;
                margin-bottom: 5%;
                margin-top:1%;   
                border-radius:10px;
            }
            button{
                height:30px;
                width:50%;
                margin-left:25%;
                border-radius:10px;
                margin-top:5%;
                margin-bottom:5%;
            }
            button:hover{
                cursor:pointer;
                transform: scale(1.05);
            }
            a{
                height:30px;
                width:52%;
                margin-left:38%;
                border-radius:10px;
                margin-bottom:5%;
                font-size:15px;
                text-align:center;
                color:black;
                font-weight:bold;
            }
            
        </style>
    </head>
    <body>
        
        <div class = "login">
            <h1>LOGIN</h1>
            <form action="login.php" method="post">
                <label for="username">Username</label>
                <input type="text" placeholder="Enter phone number or email" name = "username"/>
                <label for="pass">Password</label>
                <input type="password" placeholder="Enter password " name = "pass"/>
                <br>
                <a href="#" id="fp">Forgot Password </a>
                <button name = "login">Login</button>
            </form>
            <?php
                if(isset($_POST['login'])){
                    $user = trim($_POST['username']);
                    $pass = $_POST['pass'];
                    $con = mysqli_connect("localhost","root","","mydb");
                    $query = mysqli_query($con, "SELECT * FROM log WHERE email = '$user' OR mobile = '$user'");
                    if(mysqli_num_rows($query) == 1) {
                        $row = mysqli_fetch_assoc($query);
                        if($pass == $row['password']) {
                            $_SESSION['userid'] = $row['id'];
                            $_SESSION['username'] = $row['name'];
                            header("Location: dash.php");
                            exit(); 
                        } else {
                            echo "<p style='color:red;text-align:center;'>Incorrect password</p>";
                        }
                    } else {
                            echo "<p style='color:red;text-align:center;'>Username not found</p>";
                    } 
                }
            ?>
            <a href="reg.php">Register Or Sign Up</a>
            <br>
            <br>
        </div>
    </body>
</html>
