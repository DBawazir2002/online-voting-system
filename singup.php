<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "classes/singup-contr.class.php";

    $name = $_POST['name'];
    $mobile = $_POST['mob'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdRepeat'];
    $address = $_POST['address'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];

    $singup = new SignupContr($name,$pwd,$pwdRepeat,$mobile,$address,$role,$image);
    $result = $singup->singupUser();
    if(is_string($result)){
        echo $result;
    }
    elseif (is_bool($result) == true) {
        move_uploaded_file($tmp_name,"uploads/$image");
        echo "<div class='alert alert-success'>" . " لقد تم تسجيلك بنجاح في النظام" . "</div>";
        header("REFRESH:3;URL=include/dashboard.inc.php");
    }
}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>الاشتراك في النظام</title>
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

        <h2>اشتراك في النظام</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="name"  placeholder="الاسم"  value="<?php if (isset($name)){echo $name;}?>" >&nbsp
            <input type="number" name="mob"   placeholder="رقم الهاتف"  value="<?php if (isset($mobile)){echo $mobile;}?>"  ><br><br>
            <input type="password" name="pwd"   placeholder="كلمة السر"   value="<?php if (isset($pwd)){echo $pwd;}?>" >&nbsp
            <input type="password" name="pwdRepeat"   placeholder="تكرار كلمة السر"  value="<?php if (isset($pwdRepeat)){echo $pwdRepeat;}?>"  ><br><br>
            <input style="width: 31%" type="text" name="address"   placeholder="العنوان"  value="<?php if (isset($address)){echo $address;}?>"  ><br><br>
            <div id="upload" style="width: 30%">
            يرجى ادراج الصورة الشخصية: <input type="file" id="profile" name="image"   >
            </div><br>
            <div id="upload" style="width: 30%"  >
                يرجى اختيار الدور:
                <select name="role">
                    <option value="1">مصوت</option>
                    <option value="2">حزب</option>
                </select><br>
            </div><br>
            <button id="loginbtn" type="submit" name="registerbtn">اشتراك</button><br><br>
            هل تملك حساب من قبل؟ <a href="../">تسجيل الدخول</a>
        </form>
    </center>
</body>

</html>