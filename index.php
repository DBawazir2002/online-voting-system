<?php
session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mobile = $_POST['mobile'];
    $pwd = $_POST['pwd'];
    $role = $_POST['role'];

    
    include "classes/login-contr.class.php";
    $login = new LoginContr($mobile, $pwd, $role);
    $result = $login->loginUser();
    if(is_string($result)){
        echo $result;
    }
    elseif (is_bool($result) == true) {
        echo "<div class='alert alert-success'>" ."تم تسجيل دخولك بنجاح سيتم تحويلك الى صفحة التصويتات". "</div>";
        $_SESSION['mobile'] = $mobile;
        header("REFRESH:3;URL=include/dashboard.inc.php");
    }
}
    ?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>التسجيل في النظام</title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
    <body>
        
            <center>
            <div id="headerSection">
            <h1>نظام التصويت الالكتروني</h1>  
            </div>
            <hr>

            <div id="loginSection">
                <h2>التسجيل</h2>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input type="number"   name="mobile" placeholder="رقم الهاتف" value="<?php if (isset($mobile)){echo $mobile;}?>"><br><br>
                    <input type="password"   name="pwd" placeholder="كلمة السر" value="<?php if (isset($pwd)){echo $pwd;}?>"><br><br>
                    <select name="role"   style="width: 15%; border: 2px solid black">
                        <option value="1">المصوت</option>
                        <option value="2">حزب</option>
                    </select><br><br>                  
                    <button id="loginbtn" type="submit" name="loginbtn">التسجيل</button><br><br>
                    مستخدم جديد؟ <a href="singup.php">الاشتراك الان</a>
                </form>
            </div>

            </center> 
    </body>
</html>