<?php
$pageTitle = "صارحني بـ صراحه";
include "init.php";
session_start();

include $tpl . "header.php";
?>


<div class="hero">
    <center>
        <div class="herobkg"></div>
        <div class="hero__overlay hero__overlay--gradient"></div>
        <div class="hero__mask"></div>
        <div class="hero__inner">
            <div class="container">
                <div class="hero__content">
                    <div class="hero__content__inner" id="navConverter">
                        <h1 class="hero__title logo"> صارحني بـ صراحه </h1>
                        <p class="hero__text"> هل أنت مستعد لمعرفة ملاحظات الناس عنك بدون أن تعرفهم ؟ </p>
                        <p class="hero__text" style="color:#fff;height:30px;" id="ityped" class="ityped"></p>
                        <a href="login.php" title=" صارحني رسائلي" class="button button__accent" style="background-color:#1D628B;">
                            <img src="assets/img/main-login.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> دخول للحساب
                        </a>
                        <a href="register.php" title="صارحني تسجيل اشتراك جديد" class="button button__accent" style="background-color:#F1786C;">
                            <img src="assets/img/main-add.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> تسجيل حساب
                            جديد </a>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<a class="next-section" id="howto">
    <div class="arrow bounce">
        <img src="assets/img/next-section.svg" alt="!" width="20">
    </div>
</a>

<div class="steps landing__section" style="background-color: #fff">
    <div class="container">
        <h2>
            شرح موقع بصراحة
        </h2>

        <div class="steps__inner">
            <div class="step">
                <div class="step__media">
                    <img src="assets/img/step1.svg" class="step__image">
                </div>
                <h4> انشاء حساب صراحة </h4>
                <p class="step__text"> يمكنك تسجيل حساب عبر بريدك الإلكتروني او الحسابات الإجتماعية بسهولة </p>
            </div>
            <div class="step">
                <div class="step__media">
                    <img src="assets/img/step2.svg" class="step__image">
                </div>
                <h4>مشاركة رابط صراحة </h4>
                <p class="step__text"> عند حصولك على الرابط الخاص بك يمكنك نشره عبر مواقع التواصل الإجتماعي لتحصل على
                    ملاحظات دون ان تعرف المصدر </p>
            </div>
            <div class="step">
                <div class="step__media">
                    <img src="assets/img/step3.svg" class="step__image">
                </div>
                <h4> صارحني رسائلي إقرأ ما كتبه الناس عنك </h4>
                <p class="step__text"> عند دخولك لحسابك ستجد كل الملاحظات التي قام بكتابها أصدقائك عنك ، أنت وحدك من
                    يمكنه قرائتها </p>
            </div>
        </div>
    </div>
</div>

<div class="expanded landing__section">
    <h2 style="display:none;">
        صارحني رسائلي
    </h2>
    <h3 style="display:none;">
        موقع صراحة الجديد
    </h3>
    <h3 style="display:none;">
        sarahah
    </h3>
    <h3>
        كيفية استخدام موقع صراحة
    </h3>
    <img src="assets/img/main_how_to.png" width="280">
    <p class="cta__sub cta__sub--center">
        يمكن اعتبار صراحة بسيطًا للغاية، فبمجرد التسجيل باستخدام اسم مستخدم وكلمة مرور ستتمكن من مشاركة رابط ملف التعريف
        الخاص بك على أي من مواقع التواصل الاجتماعي والطلب من الناس استخدام الرابط لتقديم تعليقاتهم لك. يمكن للأشخاص
        كتابة أي شيءٍ بشكلٍ مجهولٍ وسيتم تسليمه لك من خلال التطبيق أو الموقع
    </p>
</div>
<div class="cta cta--reverse">
    <div class="container">
        <div class="cta__inner">
            <h2 class="cta__title"> تنزيل تطبيق صارحني صراحة </h2>
            <img src="assets/img/mobile-app.svg" class="expanded__image">
            <p class="cta__sub cta__sub--center">تابع الرسائل التي تصل لحسابك لحظة بلحظة عبر تطيقاتنا للهاتف المحمول
            </p>
            <a href="https://play.google.com/store/apps/details?id=app.sarhne.com" title="تنزيل تطبيق صارحني جوجل بلاي" target="_blink"> <img src="assets/img/ar_badge_web_generic.png" width="140" alt="تنزيل تطبيق صارحني">
            </a>
            <a href="https://appgallery.huawei.com/#/app/C103038039" title="هواوي تنزيل تطبيق صارحني" target="_blink">
                <img src="assets/img/appgallery-badge-AR.png" width="140" alt="تنزيل تطبيق هواوي صارحني"> </a>
            <a href="javascript:alert('صارحني غير متاح بالوقت الحالي للأيفون')" title="تنزيل صارحني للأيفون"> <img src="assets/img/iphone-store.png" width="140" alt="تنزيل صارحني للأيفون"> </a>
        </div>
    </div>
</div>
<div class="expanded landing__section">
    <br> <br>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/typing.js"></script>

<script>

ityped.init('#ityped', {
            strings:['أحصل على رسائل سرية من زملائك بصراحة','إعرف مزاياك و عيوبك، وما يعتقده الناس عنك','عزز شخصيتك بمعرفة الواقع بعيدا عن النفاق','واجه الصراحة التي أخفتها عنك المجاملات'],
            startDelay: 800,
            loop: true
        });

        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-117429964-1');

        
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