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
                background: linear-gradient(to right, #ffb6c1, #87cefa);
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
                height:20px;
                width:50%;
                margin-left: 25%;
                margin-bottom: 5%;
                margin-top:1%;   
                border-radius:10px;
            }
            button{
                height:30px;
                width:52%;
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
                margin-left :28%;
                border-radius:10px;
                margin-bottom:5%;
                font-size:15px;
                text-align:center;
                text-decoration:none;
                color:black;
                font-weight:bold;
            }
            
        </style>
    </head>
    <body>
        
        <div class = "login">
            <h1>SIGN UP</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="username">Name</label>
                <input type="text" placeholder="Enter Name" name = "username"/>
                <label for="email">Email</label>
                <input type="text" placeholder="Enter email " name = "email"/>
                <label for="mob">Phone No.</label>
                <input type="tel" placeholder="Enter Phone No. " name = "mob"/>
                <label for="pass">Password</label>
                <input type="password" placeholder="Enter password " name = "pass"/>
                <br>
                <button name = "sign">Sign Up</button>
            </form>
            <?php
                if(isset($_POST['sign'])){
                    $user = $_POST['username'];
                    $pass = $_POST['pass'];
                    $mail = $_POST['email'];
                    $mob = $_POST['mob'];
                    if(strlen($pass) < 8){
                        echo "<p style='color:red;text-align:center;'>Password must be at least 8 characters long</p>";
                    }
                    elseif(!preg_match("/[A-Z]/", $pass)){
                        echo "<p style='color:red;text-align:center;'>Password must contain at least one uppercase letter</p>";
                    }
                    elseif(!preg_match("/[0-9]/", $pass)){
                        echo "<p style='color:red;text-align:center;'>Password must contain at least one number</p>";
                    }
                    if($user!="" && $pass!=""&&$mail!=""&&$mob!=""){
                        $con = mysqli_connect("localhost","root","","mydb");
                        $query = mysqli_query($con, "INSERT INTO log(name, mobile, email, password) VALUES('$user', '$mob', '$mail', '$pass')");
                        if(!$query)die("error in query");
                    }
                    else{
                        echo "Credentials Wrong";
                    }
                }
            ?>
            <a href="login.php"> Already have account ? <u>Login</u></a>
            <br>
            <br>
        </div>
    </body>
</html>
