<?php include '../resources/config/db.php'; ?>
<?php
    global $err_msg;
    $err_msg = "";
    if(isset($_POST["submit"])) {
        // try {
            
            $email = $_POST["email"];
            $password = $_POST["password1"];
            $login_query = "SELECT * FROM tbl_user WHERE email = '$email' and password = '$password'";

            if($data = mysqli_query($link, $login_query)) {
                if(mysqli_num_rows($data) > 0) {
                    $row = mysqli_fetch_assoc($data);
       
                    setcookie("cur_user", $row["id"]);
                    setcookie("cur_user_uname", $row["username"]);
                    
                    header("Location: index.php");
                    
                } else {
                    $err_msg = "No account found.";
                }
            } else {
               
                $err_msg = "Cannot Login1";
            }

        // } catch (Exception $e) {
            
            $err_msg = "Cannot Login";
        // }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php include '../resources/template/header.php'; ?>
    <form name="loginform" method="POST" onsubmit="return validateLogin()">
        <label>Email</label>
        <input type="email" name="email"> <br>
        <label>Password</label>  
        <input type="password" name="password1"> <br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <div id="opt"></div>
    <?php echo $err_msg ?>
    <?php include '../resources/template/footer.php'; ?>
    <!-- <script>
        function validate() {
           
            // var email = document.loginform.email.value;
            
            // var opt = document.getElementById("opt");
            // console.log(email);
            if(!document.loginform.email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                document.getElementById("opt").innerHTML = "Email Invalid";
                return false;
            }
        }
    </script> -->
    <script src="./js/script.js"></script>
</body>
</html>


