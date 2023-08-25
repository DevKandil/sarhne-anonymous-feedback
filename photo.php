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

            <div class="settingtab "><a href="account.php">

                    <span class> الحساب </span>

                </a></div>

            <div class="settingtab tabopen"><a href="photo.php">

                    <span class="active"> الصورة </span>

                </a></div>

        </div>

    </div>

    <div id="center" style="margin-top:20px;">
        <div class="center">

            <div class="rule">

                <div class="line">
                    <div></div>
                </div>

                <div class="words"> تغير الصورة الشخصية </div>

                <div class="line">
                    <div></div>
                </div>

            </div>

            <img id="userphoto" style="overflow:hidden;border-radius:50%;" src="https://static.sarhne.com/sarhne.com/profile_photo/sarhny444.jpg?t=1690116757" width="150" height="150" alt><br>

            <form id="form">

                <input style="width:280px;" type="file" accept="image/*" id="PhotoFile" name="PhotoFile" required>

                <br>

                <input type="hidden" name="img_code" id="img_code">

                <br>

                <button type="submit" id="bphoto" class="flatbutton" style="background-color:#ccc;width:90%;border:0;" disabled> تغير الصورة الشخصية </button>

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


                function activebutton() {

                    document.getElementById('bphoto').disabled = false;

                    document.getElementById('PhotoFile').disabled = false;

                    document.getElementById('bphoto').style.backgroundColor = "#2D2F31";

                    $('#bphoto').html(' تغير الصورة الشخصية ');

                }



                function disabled_button() {

                    document.getElementById('bphoto').disabled = true;

                    document.getElementById('PhotoFile').disabled = true;

                    $('#bphoto').html(' انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');



                }





                var img_width = 300;

                var img_height = 300;



                function imageToDataUri(img, width, height) {



                    // create an off-screen canvas

                    var canvas = document.createElement('canvas'),

                        ctx = canvas.getContext('2d');



                    // set its dimension to target size

                    canvas.width = width;

                    canvas.height = height;



                    // draw source image into the off-screen canvas:

                    ctx.drawImage(img, 0, 0, width, height);



                    // encode image to data-uri with base64 version of compressed image

                    // return canvas.toDataURL();

                    return canvas.toDataURL('image/jpeg', 0.8);

                }

                function readURL(input) {

                    if (input.files && input.files[0]) {

                        var reader = new FileReader();

                        reader.onload = function(e) {





                            var img = new Image;

                            $(img).load(function() {

                                img_width = this.width;

                                img_height = this.height;

                            });

                            img.onload = resizeImage;

                            img.src = e.target.result;



                        }



                        reader.readAsDataURL(input.files[0]);

                    }

                }



                function resizeImage() {

                    var newHeight = Math.floor(img_height / img_width * 300);

                    var newDataUri = imageToDataUri(this, 300, newHeight);

                    $('#userphoto').attr('src', newDataUri);

                    $('#img_code').val(newDataUri);

                }





                $("#PhotoFile").change(function() {

                    readURL(this);

                    activebutton();

                });



                $(document).ready(function() {

                    $('#form').submit(function() {

                        disabled_button();

                        var img_code_post = $('#img_code').val();

                        var data = 'img_code=' + img_code_post;

                        $.ajax({

                                type: 'POST',

                                // enctype: 'multipart/form-data',

                                url: 'ajax/user/set_img.html',

                                //data: new FormData(this),

                                //processData: false,

                                //contentType: false

                                data: data

                            })

                            .done(function(data) {

                                if (data.includes("err")) {

                                    activebutton();

                                    showalert("المعذرة هنالك خطأ بالخادم من فضلك أعد المحاولة بعد قليل او اتصل بنا");



                                } else if (data.includes("suscc")) {

                                    suscc("تم تحديث الصورة الشخصية بنجاح");



                                }





                            })

                            .fail(function() {

                                showalert('الخادم لايستجيب من فضلك اعد المحاولة او اتصل بنا لحل المشكلة');

                                activebutton();

                            });

                        return false;

                    });

                });

                function suscc(msg) {

                    alerty.alert(msg, {

                            title: ' صارحني ',

                        },

                        function() {

                            window.location.replace("messages.html");

                        })

                }
            </script>

            <br>

</center>
</div>

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