<?php
$pageTitle = "تغيير المعلومات الشخصية";
include "init.php";

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include $tpl . 'header.php';

?>

<center>

    <div id="top" style="height:290px;">

    <br><img onclick="askimg();" style="overflow:hidden;border-radius:50%;border: 3px #ffffff4a solid;" src="https://static.sarhne.com/sarhne.com/profile_photo/sarhny444.jpg?t=1690116757" onerror="this.onerror=null;this.src='assets/img/logo-150.jpg';" width="111" height="111" alt="#"><br>

        <div class="user">
            <h3 dir="rtl" style="    color: #fff;
    font-family: cairo,sans-serif;
    direction: rtl;
    unicode-bidi: isolate;
    margin: 0;
    padding: 0;">

                Sarhny

            </h3>
        </div>

        <span class="cyellow"> تغيير المعلومات الشخصية </span>

    </div>

    <div id="center" style="border-radius: 10px;">

        <div class="settingtabs">

            <div class="settingtab tabopen"><a href="profile.php">

                    <span class="active"> الملف الشخصي </span>

                </a></div>

            <div class="settingtab "><a href="account.php">

                    <span class> الحساب </span>

                </a></div>

            <div class="settingtab "><a href="photo.php">

                    <span class> الصورة </span>

                </a></div>

        </div>

    </div>

    <div id="center" style="border-radius: 10px;margin-top:50px;">

        <div class="s_left">

            <img src="assets/img/l.png" class="img_s_left">

        </div>

        <div class="s_center">

            <div class="s_contener">

                <div class="s_top">

                    <i style="font-size: 40px;color: #fff;margin-top: 10px;display: block;opacity: .7;" class="icofont-tools-alt-2"></i>

                </div>

                <div class="s_text">

                    أعدادات ملفي

                </div>

            </div>

        </div>

        <div class="s_right">

            <img src="assets/img/r.png" class="img_s_right">

        </div>

        <div style="clear:both;margin-bottom: 10px;">

        </div>

        <form id="user_info">

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="name" placeholder="اكتب الأسم او اللقب" value="Sarhny" autocomplete="off">

                <div class="input-icon"><i><img src="assets/img/user-form.svg" alt="*" width="20"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" dir="ltr" name="email" placeholder="أدخل بريدك الألكتروني" value="sarhny444@gmail.com" autocomplete="off" required>

                <div class="input-icon"><i><img src="assets/img/email-login.svg" alt="*" width="20"></i></div>

            </div>

            <div class="select">

                <select id="sex" name="sex" style="direction: rtl; text-align: center;">

                    <option value="0" selected> ذكر </option>

                    <option value="1"> أنثى </option>

                </select>

            </div>

            <textarea class="s_textarea" maxlength="300" rows="3" name="bio" placeholder="نبذة عني ..."></textarea>

            <small style="float: right;margin-right: 29px;font-size: 10px;color: #2d2f31;"> القليل من المعلومات عنك </small>

            <br>

            <a id="f_user_info" onclick="send_form('user_info');" class="flatbutton" style="background-color: #A45851;width: 90%;border: 0;border-radius: 50px;padding: 6px;"> حفظ التغيرات </a>

        </form>

        <span class="s_user_info"> عدد زوار صفحتك : 3 | تاريخ الانضمام : 07/23/2023 </span>

    </div>
    </div>

    <div id="center" style="margin-top:50px;border-radius: 10px;">

        <div class="s_left">

            <img src="assets/img/l.png" class="img_s_left">

        </div>
        <div class="s_center">

            <div class="s_contener">

                <div class="s_top">

                    <i style="font-size: 50px;color: #fff;margin-top: 5px;display: block;opacity: .7;" class="icofont-safety"></i>

                </div>

                <div class="s_text">

                    أعدادات الخصوصية

                </div>

            </div>
        </div>

        <div class="s_right">

            <img src="assets/img/r.png" class="img_s_right">

        </div>

        <div style="clear:both;margin-bottom: 10px;"></div>

        <form id="user_privacy">

            <div class="hr"></div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_msg')">

                <input type="checkbox" id="accept_msg" name="accept_msg" checked />

                <label for="check">

                    <span></span><small> السماح بالمصارحات الجديدة </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_photo')">

                <input type="checkbox" id="accept_photo" name="accept_photo" />

                <label for="check">

                    <span></span><small> السماح ارسال صور مع الرسالة </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_any')">

                <input type="checkbox" id="accept_any" name="accept_any" checked />

                <label for="check">

                    <span></span><small> السماح لغير المسجلين بالموقع إرسال صراحات </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_bad')">

                <input type="checkbox" id="accept_bad" name="accept_bad" checked />

                <label for="check">

                    <span></span><small> السماح بالرسائل التي تحتوي كلمات سيئة </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_push')">

                <input type="checkbox" id="accept_push" name="accept_push" checked />

                <label for="check">

                    <span></span><small> السمح بتلقي اشعارات البريد والهاتف المحمول </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('show_visit')">

                <input type="checkbox" id="show_visit" name="show_visit" />

                <label for="check">

                    <span></span><small> أخفاء عدد زوار الرابط الخاص بي </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('show_seen')">

                <input type="checkbox" id="show_seen" name="show_seen" />

                <label for="check">

                    <span></span><small> أخفاء اخر ظهور لي </small>

                </label>
            </div>

            <div class="forgot" dir="rtl" style="margin-right: -70px;" onclick="checkspan('accept_search')">

                <input type="checkbox" id="accept_search" name="accept_search" checked />

                <label for="check">

                    <span></span><small> الظهور بالبحث </small>

                </label>
            </div>

            <div class="hr"></div>

            <a id="f_user_privacy" onclick="send_form('user_privacy');" class="flatbutton" style="background-color: #A45851;width: 90%;border: 0;border-radius: 50px;padding: 6px;"> حفظ التغيرات </a>

        </form>

    </div>

    <br>

    <script src="assets/js/jquery.min.js"></script>
    <script>
        function ask_send_form(id) {





            alerty.confirm(

                ' هل انت متأكد من حذف حسابك والرسائل والرابط الخاص بك بشكل نهائي؟', {

                    title: ' تأكيد ',

                    cancelLabel: 'لا',

                    okLabel: 'نعم'

                },
                function() {

                    send_form(id);

                    try {
                        setcanback('');
                    } catch (err) {}

                },
                function() {

                    try {
                        setcanback('alerty');
                    } catch (err) {}

                })







        }

        function form_active_button(id) {

            document.getElementById('f_' + id).disabled = false;

            document.getElementById('f_' + id).style.backgroundColor = "#A45851";

            $('#f_' + id).html(' حفظ التغيرات ');

        }



        function form_disabled_button(id) {

            document.getElementById('f_' + id).disabled = true;

            document.getElementById('f_' + id).style.backgroundColor = "#2D2F31";

            $('#f_' + id).html(' انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');



        }



        function send_form(id) {



            form_disabled_button(id);



            $.ajax({

                type: 'POST',

                url: 'ajax/user/' + id + '.html',

                data: $('#' + id).serialize(),

                success: function(data) {

                    form_active_button(id);



                    if (data.includes("sucss_del_account")) {

                        alerty.alert(' تم حذف حسابك بشكل نهائي ', {

                                title: 'صارحني',

                            },

                            function() {

                                window.location.replace("index.html");

                                try {
                                    setcanback('alerty');
                                } catch (err) {}

                            })



                    } else if (data.includes("wa")) {

                        showalert(" رقم الهاتف غير صحيح تأكد من أضافة نداء بلدك ");

                    } else if (data.includes("website")) {

                        showalert(" لم يتم العثور على الموقع الأكتروني الرجاء كتابة رابط موقعك بشكل كامل تأكد من اضافة http:// ");

                    } else if (data.includes("gmail")) {

                        showalert(" بريد الألكتروني غير صحيح ");

                    } else if (data.includes("messenger")) {

                        showalert(" رابط مسنجر غير صحيح ");

                    } else if (data.includes("tiktok")) {

                        showalert(" رابط tiktok غير صحيح ");

                    } else if (data.includes("youtube")) {

                        showalert(" رابط قناة يتيوب غير صحيح ");

                    } else if (data.includes("snapchat")) {

                        showalert(" رابط سناب شات غير صحيح ");

                    } else if (data.includes("twitter")) {

                        showalert(" رابط تويتر غير صحيح ");

                    } else if (data.includes("instagram")) {

                        showalert(" رابط انستغرام غير صحيح ");

                    } else if (data.includes("facebook")) {

                        showalert(" رابط الفيس بوك غير صحيح ");

                    } else if (data.includes("pasnotmatch")) {

                        showalert(" كلمات المرور غير متطابقة الرجاء اعادة المحاولة");

                    } else if (data.includes("emptyname")) {

                        showalert("الرجاء كتابة اسمك او لقبلك بشكل صحيح");

                    } else if (data.includes("erorremail")) {

                        showalert("الرجاء كتابة بريدك الألكتروني بشكل صحيح");

                    } else if (data.includes("dns")) {

                        showalert("لم يتم العثور على البريد الألكتروني الذي تم ادخاله الرجاء اعادة المحاولة");

                    } else if (data.includes("pasnotmatch")) {

                        showalert(" كلمات المرور غير متطابقة الرجاء اعادة المحاولة");

                    } else if (data.includes("notacceptpass")) {

                        showalert(" يجب أن تكون كلمة المرور اكثر من 6 حروف واقل من 30 حرفاً وتكتب حصراً حروف وارقام انكليزية ");

                    } else if (data.includes("you_cant_chang_email")) {

                        showalert(" لايمكن ان يكون بريدك الألكتروني فارغ لم يتم اقران حسابك مع فيس بوك ");

                    } else if (data.includes("emailused")) {

                        showalert(" البريد الألكتروني الذي ادخلته مرتبط بحساب شخص اخر ");

                    } else if (data.includes("successfully")) {

                        alerty.alert(' تم حفظ التغيرات بنجاح سيتم اعادة تحميل الصفحة', {

                                title: 'صارحني',

                            },

                            function() {

                                window.location.replace("");

                                try {
                                    setcanback('alerty');
                                } catch (err) {}

                            })

                        try {
                            setcanback('alerty');
                        } catch (err) {}



                    } else {

                        server_erorr();

                    }

                },
                error: function(request, status, error) {

                    form_active_button(id);

                    server_erorr();

                }
            });



        }





        function checkspan(id) {

            if (document.getElementById(id).checked) {

                document.getElementById(id).removeAttribute('checked');

            } else {

                document.getElementById(id).setAttribute('checked', 'checked');

            }

        }

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

        $(window).bind('resize', function() {

            screenClass();

        });
    </script>


    <?php include "includes/templates/footer.php"; ?>