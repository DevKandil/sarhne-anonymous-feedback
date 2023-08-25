<?php
$pageTitle = "صارحني بـ صراحه";
include "init.php";
session_start();

include $tpl . 'header.php';
?>


<center>
    <div id="top" style="height:290px;">
        <br><img src="assets/img/search_icon.png" style="width: 60px; margin: 120px 0 20px 0;" alt="#"><br>
        <div class="logo">
            <h3>
                البحث عن مستخدم
            </h3>
        </div>
        <br><br>
    </div>
    </div>
    <div id="center">
        <h3>
            أكتب اسم مستخدم وانقر بحث
        </h3><br>
        <div class="input-group input-group-icon" dir="rtl">
            <input type="text" id="username" name="username" placeholder="ادخل اسم المستخدم" required />
        </div>
    </div>
</center>



<?php include "includes/templates/footer.php"; ?>