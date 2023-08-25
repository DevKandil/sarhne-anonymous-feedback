<?php
$pageTitle = "تم ارسال المصارحة بنجاح";
include "init.php";
session_start();

include $tpl . 'header.php';

?>

<center>
    <div id="top">
        <div class="user-title" dir="rtl" style="padding-top: 100px;">
        </div>
        <img id="myImg" src="assets/img/done.png" width="100" height="100" alt="#" onerror="this.onerror=null;this.src='assets/img/logo-150.jpg';" class="cimg"><br>
    </div>

    <div id="center" class="box" dir="rtl">
        <br>
        <h3 id="w2">
            تم ارسال المصارحة بنجاح
        </h3>
        <img src="assets/img/lll.gif" alt="#" width="140" id="w3"><br>
        <span id="w1"> شكرا لك على صراحتك </span>
<br>
        <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="userbutton" style="background-color:#F0776C;width:50%;margin:10px;"> الرجوع الي الصفحه السابقه. </a>

    </div>

    <div class="box">
<i class="icofont-bulb-alt main_color" style="font-size:120px;"></i>
<br>
<div class="logo" ><h1 style="font-size: 30px;">
حانت لحظة الصراحة
</h1> </div>
<font color="#000">
<b>هل أنت مستعد لمعرفة ملاحظات الناس عنك بدون أن تعرفهم ؟</b></font><small><font color="#25373D"><br>
أحصل على رسائل سرية من زملائك بصراحة <br>
إعرف مزاياك و عيوبك، وما يعتقده الناس عنك <br>
عزز شخصيتك بمعرفة الواقع بعيدا عن النفاق <br>
واجه الصراحة التي أخفتها عنك المجاملات <br>
<br></font></small>
<a href="register.php" class="userbutton" style="background-color:#F0776C;width:90%;margin:10px;"> ! سجل حسابك الآن </a>
</div>
</center>


<?php include "includes/templates/footer.php"; ?>