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

            <div class="settingtab "><a href="profile.php">

                    <span class> الملف الشخصي </span>

                </a></div>

            <div class="settingtab tabopen"><a href="account.php">

                    <span class="active"> الحساب </span>

                </a></div>

            <div class="settingtab "><a href="photo.php">

                    <span class> الصورة </span>

                </a></div>

        </div>

    </div>

    <div id="center" style="margin-top:50px;border-radius: 10px;">

        <div class="s_left">

            <img src="assets/img/l.png" class="img_s_left">

        </div>
        <div class="s_center">

            <div class="s_contener">

                <div class="s_top">

                    <i style="font-size: 40px;color: #fff;margin-top: 10px;display: block;opacity: .7;" class="icofont-lock"></i>

                </div>

                <div class="s_text">

                    تغير كلمة المرور

                </div>

            </div>
        </div>

        <div class="s_right">

            <img src="assets/img/r.png" class="img_s_right">

        </div>

        <div style="clear:both;margin-bottom: 10px;"></div>

        <form id="chang_password">

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" id="password" name="password" placeholder="كلمة المرور الجديدة" autocomplete="off" />

                <div class="input-icon"><i><img src="assets/img/lockk.svg" width="20" alt="*"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" id="rpassword" name="repassword" placeholder="تأكيد كلمة المرور" autocomplete="off" />

                <div class="input-icon"><i><img src="assets/img/lock-form.svg" width="20" alt="*"></i></div>

            </div>

            <a id="f_chang_password" onclick="send_form('chang_password');" class="flatbutton" style="background-color: #A45851;width: 90%;border: 0;border-radius: 50px;padding: 6px;"> غير كلمة المرور </a>

        </form>
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
            $(window).bind('resize', function() {
                screenClass();
            });


            $("#password").on('keyup', function(e) {

                var val = $(this).val();

                if (val.match(/[^a-zA-Z0-9-_@!$.#]/g)) {

                    $(this).val(val.replace(/[^a-zA-Z0-9]/g, ''));

                }

            });

            $("#rpassword").on('keyup', function(e) {

                var val = $(this).val();

                if (val.match(/[^a-zA-Z0-9-_@!$.#]/g)) {

                    $(this).val(val.replace(/[^a-zA-Z0-9]/g, ''));

                }

            });
        </script>

    </div>

    <div id="center" style="margin-top:50px;border-radius: 10px;">

        <div class="s_left">

            <img src="assets/img/l.png" class="img_s_left">

        </div>
        <div class="s_center">

            <div class="s_contener">

                <div class="s_top">

                    <i style="font-size: 40px;color: #fff;margin-top: 10px;display: block;opacity: .7;" class="icofont-link"></i>

                </div>

                <div class="s_text">

                    روابط التواصل الأجتماعي

                </div>

            </div>
        </div>

        <div class="s_right">

            <img src="assets/img/r.png" class="img_s_right">

        </div>

        <div style="clear:both;margin-bottom: 10px;"></div>

        <form id="social_media">

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="facebook" placeholder="رابط الفيس بوك" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/facebook_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="instagram" placeholder="رابط انستغرام" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/instagram_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="twitter" placeholder="رابط تويتر" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/twitter_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="snapchat" placeholder="رابط سناب شات" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/snapchat_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="youtube" placeholder="رابط قناة يتيوب" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/youtube_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="wa" placeholder="رقم هاتفك ونداء بلدك" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/wa_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="tiktok" placeholder="رابط تيك توك" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/tiktok_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="messenger" placeholder="رابط المسنجر" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/messenger_icon.svg" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="gmail" placeholder="بريد ألكتروني" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/gmail_icon.png" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="input-group input-group-icon" dir="rtl">

                <input type="text" name="website" placeholder="رابط موقعك الألكتروني" autocomplete="off" value>

                <div class="input-icon"><i><img src="assets/img/social/website_icon.png" alt="*" width="30" class="s_soical_icon"></i></div>

            </div>

            <div class="forgot" dir="rtl" style="margin-right: -30px;" onclick="checkspan('hide_social')">

                <input type="checkbox" id="hide_social" name="hide_social" />

                <label for="check">

                    <span></span><small> أخفاء أزرار التواصل الاجتماعي من صفحتي؟ </small>

                </label>
            </div>

            <a id="f_social_media" onclick="send_form('social_media');" class="flatbutton" style="background-color: #A45851;width: 90%;border: 0;border-radius: 50px;padding: 6px;"> حفظ التغيرات </a>

        </form>

    </div>



    <br>

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
    </script>

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

        $(window).bind('resize', function() {

            screenClass();

        });
    </script>

    <?php include "includes/templates/footer.php"; ?>