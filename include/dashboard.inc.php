<?php
        include('../classes/votes-contr.class.php');
        if(!isset($_SESSION['mobile'])){
            header("Location:../");
        }
        $votes = new VotesContr($_SESSION['mobile']);
        $resultUser = $votes->displayInfoUser();
        $resultGroups = $votes->displayInfoGroups();
        if ($resultUser['status'] == 1 ) {
            $status = '<b style="color: green">تم التصويت </b>';
        } else {
            $status = '<b style="color: red">لم تقم بالتصويت بعد </b>';
        }
?>


<html>
    <head>
        <title>نظام التصويت الالكتروني - لوحة التحكم</title>
        <!-- Bootstrap and Bootstrap Rtl -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-rtl.css">
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>
    <body>
        
            <center>
            <div id="headerSection">
            <a href="../"><button id="back-button"> العودة للخلف</button></a>
            <a href="../logout.php"><button id="logout-button">تسجيل الخروج</button></a>
            <h1>نظام التصويت الالكتروني</h1>  
            </div>
            </center>
            <hr>

            <div id="mainSection">
                <div id="profileSection">
                    <center><img src="../uploads/<?php echo $resultUser['photo']?>" height="100" width="100"></center><br>
                    <b>الاسم: </b><?php echo $resultUser['name'] ?><br><br>
                    <b>رقم الهاتف: </b><?php echo $resultUser['mobile'] ?><br><br>
                    <b>العنوان: </b><?php echo $resultUser['address'] ?><br><br>
                    <?php  
                        if($resultUser['role'] != 2){
                    ?>
                    <b>الحالة: </b><?php echo $status; 
                        }
                    ?>
                </div>
                <div id="groupSection">
                    <?php

                    if($resultGroups != false){
                        for($i=0; $i<count($resultGroups); $i++){
                            ?>
                                <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <img style="float: right" src="../uploads/<?php echo $resultGroups[$i]['photo']?>" height="80" width="80">
                                <b>اسم الحزب: </b><?php echo $resultGroups[$i]['name']?><br><br>
                                <b>عدد الاصوات: </b> <?php echo $resultGroups[$i]['votes']?><br><br>
                                <?php
                                
                                if($resultUser['role'] != 2){
                                    if($resultUser['status'] == 1){
                                    ?>
                                    <br>
                                    <button disabled style="padding: 5px; font-size: 15px; background-color: #27ae60; color: white; border-radius: 5px;" type="button">تم التصويت</button>
                                    <?php
                                 }
                                }
                                else{

                                    if($resultUser['role'] != 2){
                                    ?>
                                    <br>
                                    <button style="padding: 5px; font-size: 15px; background-color: #3498db; color: white; border-radius: 5px;"><a  style="color:white" href='dashboard.inc.php?id=<?php echo $resultGroups[$i]['id']?>'>صوت الان</a></button>
                                    <?php
                                   }
                                }
                                
                                ?>
                                    </form>
                        <hr />
                        
                                </div>
                            <?php
                        }
                    
                    /*else{
                        ?>
                            <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px" class="alert alert-danger">
                                <b>No groups available right now.</b>    
                            </div>
                        <?php
                    }  */
                    ?>
                    <?php
                                        if(isset($_GET['id'])){
                                            $vote = 1;
                                            $id = $_GET['id'];
                                            if($res = $votes->votes($vote, $id) == true){
                                                header("REFRESH:3;URL=dashboard.inc.php");
                                            }
                                        }

                                
                                ?>
                </div>
            </div> 
    </body>
</html>

<?php 
                    }  else{

                        ?>
                        <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px" class="alert alert-danger">
                                <b>لم يتم تسجيل أي أحزاب في الوقت الحالي.</b>    
                            </div>

                            <?php

                    }       

?>