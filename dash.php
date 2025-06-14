<?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        header("Location:login.php");
        exit();
    }
    $userid =  $_SESSION['userid'];
    $username = $_SESSION['username'];
    $con = mysqli_connect("localhost", "root", "", "mydb");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    function username($id)
    {
        global $con;
        $stmt = mysqli_prepare($con, "SELECT name FROM log WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $username);
        if (mysqli_stmt_fetch($stmt)) {
            return $username;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Main Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
            *{
                margin:0px;
            }
            body{
                background: linear-gradient(to right,rgb(207, 211, 132));
            }   
            .outer{
                height:auto;
                width:100%;
            }
            .header{
                height:100px;
                width:100%;
                background: #001f3f;
                border-radius:5px;
            }
            .left{
                height: auto;
                width:18%;
                background: black;
                float:left;
                color:white;
                background: #001f3f;
                margin-top: -1.7%;
            }
            .right{
                background:  #001f3f;
                width: 60%;
                margin: 20px auto;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
                font-family: Arial, sans-serif;
                display:none;
            }
            .slide{
                height:60px;
                width: 93%;
                font-size:30px;
                border-radius: 15px;
                margin-top:5%;
                margin-left:3%;
                margin-right:3%; 
            }
            .slide:hover{
                cursor:pointer;
                transform:scale(1.05);
                background:white;
                color:black;
            }
            .logo{
                height:80px;
                width:92%;
                margin-left:8%;
                margin-top:12%;
                background-image:url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7b1W9Sl1aMmX0h86FXDdm5zYRfN8sDls_bw&s");
                background-size:40px 40px;
                background-repeat:no-repeat;
                float:left;
                border-radius:10px; 
            }
            .logo h1{
                postion:relative;
                margin-left:20%;
                margin-top:1.5%;
            }
            
            i{
                margin-left:2%;
                padding-top:2%;
                margin-right:2%;
                text-align:center;   
                font-size: 25px; 
            }
            a:hover{
                color:black;
            }
            .c{
                background:rgb(246, 236, 236);
                width: 90%;    
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 15px;
                margin-top: 1%;
                margin-bottom: 2%;
                margin-left:2%;
                box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
                font-size:20px;
            }
            textarea {
                width: 90%;
                height: 80px;
                margin-top: 2%;
                margin-bottom: 2%;
                margin-left:2%;
                padding: 2%;
                resize: vertical;
                font-size: 20px;
                background:white;
            }
            input[type="submit"] {
                margin-top: 1%;
                margin-bottom: 2%;
                margin-left:2%;
                padding: 8px 15px;
                border: none;
                border-radius: 5px;
                margin-bottom : 2%;
                background:white;
                color:black;
            }
            .right1 {
                background:  #001f3f;
                width: 40%;
                margin: 20px auto;
                margin-left:20%;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 0 10px rgba(0,0,0,0.2);
                font-family: Arial, sans-serif;
                display:none;
            }
            .right1 h2 {
                margin-bottom: 15px;
                color: white;
            }
            .friend-box {
                background: white;
                padding: 15px;
                margin-bottom: 15px;
                border-radius: 10px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
            }
            .friend-box:hover{
                cursor:pointer;
                transform:scale(1.02);
            }
            .friend-name {
                width:30%;
                font-size: 18px;
                color: #333;
            }
            .friend-actions button {
                padding: 8px 15px;
                margin-left: 10px;
                border: none;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
            }
            .accept-btn {
                background-color: #2ecc71;
                color: white;
            }
            .accept-btn:hover {
                background-color: #27ae60;
                color:red;
            }
            .msgbox{
                background:white;
                height:100px;
                width:20%;
                display:none;
                border-radius:2px;
                box-shadow:1px 1px 1px black;
                float:right;    
                margin-right:10%;
                margin-top:-25%;
            }
            .msgbox input{
                margin-top:20%;
            }
        </style>
    </head>
    <body>
        <div class = "outer">
            
            <div class="left">
                <div class= "header"><div class = "logo"> <h1 > HR Connect</h1></div></div>
                <hr>
                <div class = "slide" ><i class="bi bi-person-circle" ></i><?php
                echo $username;
                ?></div>
                <div class = "slide" ><i class="fa fa-home" aria-hidden="true"></i>Home </div>
                <div class = "slide" ><i class="bi bi-pencil-square"></i>Post <i class="bi bi-caret-right-fill" style="float:right" id = "post"></i></div>
                <div class = "slide"><i class="bi bi-people-fill"></i>Friends <i class="bi bi-caret-right-fill" style="float:right" id = "frnd"></i></div>
                <div class = "slide"><i class="fa fa-bell" aria-hidden="true"></i>Notification <i class="bi bi-caret-right-fill" style="float:right" id = "post"></i></div>
                <div class = "slide"><i class="bi bi-chat-right-dots-fill"></i>Message <i class="bi bi-caret-right-fill" style="float:right" id = "mesg"></i></div>
                <div class = "slide"><i class="bi bi-chat-text"></i>Group chat <i class="bi bi-caret-right-fill" style="float:right" id = "post"></i></div>
                <div class = "slide"><i class="bi bi-controller"></i>Game <i class="bi bi-caret-right-fill" style="float:right" id = "post"></i></div>
                <div class = "slide"><i class="bi bi-journal-bookmark-fill"></i>Scrap <i class="bi bi-caret-right-fill" style="float:right" id = "post"></i></div>
                <div class = "slide"><i class="fa fa-cog" aria-hidden="true"></i>Setting</div>
                <div class = "slide"><i class="fa fa-sign-out" aria-hidden="true">  </i><a href="login.php" style="text-decoration:none;color:red;">Log Out</a></div>
            </div>
            <div class="right">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <textarea name="post" required placeholder="Want to share something ?"></textarea>
                    <input type="submit" name="ok" value="Post" />
                </form>
                <?php
                if (isset($_POST['ok'])) {
                    $userpost = mysqli_real_escape_string($con, $_POST['post']);
                    mysqli_query($con, "INSERT INTO userpost (content) VALUES ('$userpost')");
                }
                function pagipost($start, $end)
                {
                    global $con;
                    $query = "SELECT * FROM userpost ORDER BY id DESC LIMIT $start, $end";
                    $result = mysqli_query($con, $query);
                    $i = $start + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="c">';
                        echo '<p style="color:blue;"><strong>' . 'Post ' .$i . ' ' . htmlspecialchars(username($row['userid'])) . '</strong></p>';
                        echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '<br>';
                        $date = date('d-m-y H:i:s', strtotime($row['curtime']));
                        echo '<span style="color:gray;font-size:12px;">' . $date . '</span></p>';
                        echo '</div>';
                        $i++;
                    }
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
                    <input type="submit" name="pagi" value="1"/>
                    <input type="submit" name="pagi" value="2"/>
                    <input type="submit" name="pagi" value="3"/>
                    <input type="submit" name="pagi" value="4"/>
                </form>
                <?php
                if (isset($_GET['pagi'])) {
                    $page = intval($_GET['pagi']);
                    switch ($page) {
                        case 1: pagipost(0, 3); break;
                        case 2: pagipost(3, 3); break;
                        case 3: pagipost(6, 3); break;
                        case 4: pagipost(9, 3); break;
                        default: echo "<p>Invalid page</p>";
                    }
                }
                ?>
            </div>
            <div class="right1">
                <h2>Friend Requests</h2>
                <?php
                include "config.php";
                $query = "SELECT * FROM log WHERE name != '" . mysqli_real_escape_string($con, $username) . "'";
                $result = mysqli_query($con, $query);
                $friends = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $friends[] = $row['name'];
                }
                ?>
                <?php foreach ($friends as $user): ?>
                <div class="friend-box">
                    <div class="friend-name"><?php echo htmlspecialchars($user); ?></div>
                    <div class="friend-actions">
                        <form action="dash.php" method="post" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo $user; ?>">
                            <input type="button"name="accept" class="accept-btn" value="Add as friend" />
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php
                    if (isset($_POST['accept'])) {
                        include "config.php";
                        echo "Friend request accepted.";
                    }   
                ?>  
            </div>
            <div class="right1" id = "msg">
                <h2>Messages</h2>
                <?php
                include "config.php";
                $query = "SELECT * FROM log WHERE name != '" . mysqli_real_escape_string($con, $username) . "'";
                $result = mysqli_query($con, $query);
                $friends = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $friends[] = $row['name'];
                }
                ?>
                <?php foreach ($friends as $user): ?>
                <div class="friend-box">
                    <div class="friend-name" id = "message"><?php echo '<i class="bi bi-person-circle"></i>' . htmlspecialchars($user); ?></div>
                    <div class="friend-actions">
                        <form action="dash.php" method="post" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo $user; ?>">
                        </form>
                        <form action="dash.php" method="post" style="display:inline;">
                            <input type="hidden" name="username" value="<?php echo $user; ?>">
                            <?php
                                global $con;
                                $query = "SELECT * FROM userpost ORDER BY id DESC LIMIT 0, 3";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $date = date('H:i', strtotime($row['curtime']));
                                    echo '<span style="color:gray;font-size:12px;">' . $date . '</span></p>';   
                                    break;
                                }
                            ?>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            </div> 
            <div class = "msgbox">
                <i class="bi bi-emoji-smile" style="font-size: 20px;"></i>
                <input type="text" value="" placeholder="Type a message..." style="border-radius: 4px; border: none; outline: none; width: 70%; padding: 5px;">
                <i class="bi bi-send" style="font-size: 18px; cursor: pointer;"></i>
            </div> 
            <script>
                $(document).ready(function () {
                    $('#post').click(
                        function () {
                            $('.right').toggle();   
                        },
                    );
                    $('#frnd').click(
                        function (){
                            $('.right1').toggle();
                        }
                    )
                    $('#mesg').click(
                        function (){
                            $('#msg').toggle();
                        }
                    )
                    $('#message').click(
                        function (){
                            $('.msgbox').toggle();
                        }
                    )
                    $('.accept-btn').click(
                        function(){
                            alert("sent");
                        }
                    )
                    
                });
            </script>
        </div>
    </body>
</html>
