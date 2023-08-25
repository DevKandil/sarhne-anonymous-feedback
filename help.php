<?php
$pageTitle = "التعليمات والمساعدة";
include "init.php";
session_start();

include $tpl . "header.php";
?>

<center>
    <div id="top">
        <img src="assets/img/help.svg" style="width: 60px; margin: 120px 0 20px 0;" alt="#">
        <div class="logo">
            <h1 style="font-size: 30px">
                التعليمات والمساعدة
            </h1>
        </div>
        <br><br>
    </div>
    </div>
    <div id="center">
        <div class="container" dir="rtl">
            <details class="default square">
                <summary> ماهو موقع صارحني </summary>
                <p>
                    بخطوة واحدة، أنت على موعد مع الحقيقة
                    أحصل على رسائل سرية من زملائك بصراحة
                    إعرف مزاياك و عيوبك، وما يعتقده الناس عنك
                    عزز شخصيتك بمعرفة الواقع بعيدا عن النفاق
                    ادخل في حوارات مباشرة مع أصدقاءك بسرية
                    واجه الصراحة التي أخفتها عنك المجاملات
                </p>
            </details>
            <details class="default square">
                <summary> كيف انشئ حساب </summary>
                <p>
                    يمكنك تسجيل حساب عبر بريدك الإلكتروني او الحسابات الإجتماعية بسهولة
                </p>
            </details>
            <details class="default square">
                <summary> نسيت كلمة المرور </summary>
                <p>
                    من خلال صفحة تسجيل الدخول أضغط على نسيت كلمة المرور ادخل بريدك الألكتروني وسنرسل لك رابط اعادة
                    تعين كلمة
                    السر , ملاحظة اذا كنت مسجل بواسطة الشبكات الاجتماعية فقط انقر على دخول بواسطة جوجل او فيس بوك
                </p>
            </details>
            <details class="default square">
                <summary> كيف احصل على مصارحات </summary>
                <p>
                    بعد انشاء الحساب ستحصل على الرابط الخاص بك عند حصولك على الرابط الخاص بك يمكنك نشره عبر مواقع
                    التواصل
                    الإجتماعي لتحصل على ملاحظات دون ان تعرف المصدر
                </p>
            </details>
            <details class="default square">
                <summary> وصلتني مصارحة مزعجة </summary>
                <p>
                    المعذرة لن نكون قادرين على معرفة من المرسل لان نظام عمل الموقع الحصول على مصاراحات مجهولة تستطيع
                    من الأعدادت
                    الحساب تفعيل ميزة فلترة المصاراحات التي تحتوى على كلام سيء ولن نكون قادرين على فلترة جميع
                    الكلمات
                </p>
            </details>
            <details class="default square">
                <summary> الأبلاغ عن مستخدم </summary>
                <p>
                    في حال وجدت مستخدم ينتهك معاير وشروط موقع صارحني من فضلك ارسل لنا بلاغ عن هذا المستخدم من خلال
                    صفحته الشخصية
                    ستجد زر ابلاغ عن اساءة والفريق المختص سيراجع الابلاغ ويتخذ الأجراء المطلوب
                </p>
            </details>
            <details class="default square">
                <summary> ارغب بالأتصال بأدارة صارحني </summary>
                <p>
                    يمكنك التواصل معنا بشكل مباشر من خلال ازرار شبكات التواصل الموجودة اسفل كل صفحة
                </p>
            </details>
        </div>
        <br>
    </div>
    <br>
    </div>
</center>
<script src="assets/js/jquery.min.js"></script>

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
