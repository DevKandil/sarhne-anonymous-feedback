<?php
$pageTitle = "اتصل بنا";
include "init.php";
session_start();

include $tpl . "header.php";
?>

<center>
    <div id="top">
        <img src="assets/img/help.svg" style="width: 60px; margin: 120px 0 20px 0;" alt="#">
        <div class="logo">
            <h1 style="font-size: 40px">
                اتصل بنا
            </h1>
        </div>
        <br><br>
    </div>
    </div>
    <div id="center">
        <div class="center" dir="rtl">
            <br><br>
            إذا كنت بحاجة إلى أي مزيد من المعلومات أو لديك أية أسئلة ، لا تتردد في الاتصال بنا
            <div class="cyellow">
                <h3>
                    بواسطة البريد الألكتروني
                </h3>
            </div>
            <h3>
                <a href="mailto:sarhne.com@gmail.com" style="color: #f1776c;"> sarhne.com@gmail.com </a>
            </h3> <br>
            <div class="cyellow">
                <h3>
                    تابعنا عبر انستغرام
                </h3>
            </div>
            <a href="https://www.instagram.com/sarhne_official/?swa33" class="white" target="_blank">
                sarhne_official </a>
            <br><br>
            <div class="cyellow">
                <h3>
                    رابط صفحتنا على الفيس بوك
                </h3>
            </div>
            <a href="https://www.facebook.com/Sarhne.Official" class="white" target="_blank">
                https://www.facebook.com/Sarhne.Official </a>
            <br><br>
            <div class="fb-page" data-href="https://www.facebook.com/Sarhne.Official/" data-small-header="false"
                 data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/Sarhne.Official/" class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/Sarhne.Official/">‏صارحني‏</a></blockquote>
            </div>
        </div>
    </div>
</center> <br></div>
</div>
<script>
    function screenClass() {
        if ($(window).innerWidth() > 1200) {
            $('.tabs').hide();
            $('.nav').show();
        } else {
            $('.nav').hide();
            $('.tabs').show();
        }
    }

    // Fire.
    screenClass();

    // And recheck when window gets resized.
    $(window).bind('resize', function () {
        screenClass();
    });

</script>

<?php include "includes/templates/footer.php"; ?>
