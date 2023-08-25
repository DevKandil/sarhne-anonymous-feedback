<?php
$pageTitle = "صارحني برسالة سرية";
include "init.php";
session_start();

$stmt = $con->prepare("SELECT * FROM users WHERE username = :user");
$stmt->bindParam(":user", $_GET['user']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // echo "##### POST #####\n";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();

    $message = $_POST['message'];
    $message = json_decode('"' . $message . '"', true, JSON_UNESCAPED_UNICODE);
    $receiver_id = $_POST['receiver_id'];
    $show_sender_info = ($_POST['show_sender_info'] == "true") ? 1 : 0;
    $sender_id = $_POST['sender_id'];
    $sender_ip = $_POST['sender_ip'];

    if ($message == "") {
        exit("msg_empty");
    }

    if (strlen($message) < 6 || strlen($message) > 500) {
        exit("msg_long");
    }

    if (empty($receiver_id)) {
        exit("user_not_found");
    }

    $stmt = $con->prepare("SET NAMES utf8mb4;");
    $stmt->execute();

    $stmt = $con->prepare("INSERT INTO `messages`(`user_id`,`sender_id`,`sender_ip`,`show_sender_info`,`content`) VALUES(:zuser_id, :zsender_id, :zsender_ip, :zshow_sender_info, :zcontent)");

    $stmt->execute([
        "zuser_id" => $receiver_id,
        "zsender_id" => $sender_id,
        "zsender_ip" => $sender_ip,
        "zshow_sender_info" => $show_sender_info,
        "zcontent" => $message,
    ]);

    $count = $stmt->rowCount();

    if ($count > 0) {
        echo "successfully";
        exit();
    }
}

include $tpl . 'header.php';
?>


<center>
    <div id="top">
        <div class="user-title" dir="rtl" style="padding-top: 100px;">
            أكتب رسالة إلى <b> <?= $user['name']; ?> </b> دون ان يعرفك </div>
        <img id="myImg" src="assets/img/profile-images/devkandil.jpg" width="120" height="120" alt="Sarhny" onerror="this.onerror=null;this.src='assets/img/logo-150.png';" class="cimg"><br>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
        </div>
    </div>
    
    <div id="center" class="noselect" dir="rtl">
        <div class="s_left">
            <img src="assets/img/l.png" class="img_s_left">
        </div>
        <div class="s_right" style="margin-top: -10px;margin-right: -7px;">
            <img src="assets/img/r.png" class="img_s_right">
        </div>
        <div style="clear:both;"></div>
        <style>
            .middle {
                vertical-align: middle;
            }

            .profile_online {
                width: 15px;
                height: 15px;
                background: #18ac16;
                display: inline-block;
                /* float: left; */
                border-radius: 50%;
                /* position: relative; */
                /* top: 4px; */
                margin-right: 5px;
                /* font-family: "weblysleek_uilight"; */
                /* -moz-transform: translateY(0.1em); */
            }
        </style>
        <small dir="rtl" class="gray" style="display: block;"> <span class="profile_online middle"></span> متصل الآن
        </small>
        <span id="erorrid"></span>
        <form id="form" action="" method="POST">

            <textarea id="sarhne" dir="rtl" rows="7" maxlength="500" name="msg" placeholder="هناك شيء تريد قوله لـ <?= $user['name']; ?> ، بدون ان يعرفك ؟ أكتب هنا" class="textarea"></textarea>
            <small style="float:left;direction: ltr;"><b id="char_count">500</b> الحروف المتبقية </small>

            <input type="checkbox" name="show_my_info" class="switch-input" id="show_my_info" checked>
            <section style="margin-bottom:10px;" onclick="show_my_info_switch();" for="id-name--1" class="switch-label">
                <small class="toggle--on"> بشكل سري : <span class="green"> نعم </span>
                </small>
                <small class="toggle--off"> بشكل سري : <span class="red"> لا </span>
                </small>
            </section>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery-confirm.min.js"></script>
            <script>


                var show_my_info = 'false';
                <?php

                if (isset($_SESSION['user'])) { ?>

                    function show_my_info_switch() {

                        if (show_my_info.includes('true')) {

                            document.getElementById("show_my_info").checked = true;
                            show_my_info = 'false';
                            showalert('جميع معلومات سرية الآن للغاية');
                        } else if (show_my_info.includes('false')) {
                            document.getElementById("show_my_info").checked = false;
                            show_my_info = 'true';
                            showalert('سيتم الان في هذه المصارحة اظهار اسمك وصورتك الشخصية مع هذا المستخدم');
                        }

                    }

                <?php } else { ?>

                    function show_my_info_switch() {
                        showalert(
                            'ميزة أظهار اسم مرسل الصراحة تعمل فقط مع الاعضاء المسجلين معنا من فضلك سجل اشتراك جديد او دخول لحسابك لأستخدام هذه الميزة'
                        );
                    }

                <?php } ?>


                var len = 0;
                var maxchar = 500;
                $('#sarhne').keyup(function() {
                    len = this.value.length
                    if (len > maxchar) {
                        return false;
                    } else if (len > 0) {
                        $("#char_count").html(maxchar - len);
                    } else {
                        $("#char_count").html(maxchar);
                    }
                });
            </script>
            <div style="clear:both;"></div>
            <div id="idemoj" style="width:97%; background:#fff;margin:5px;padding:5px;display:block;font-size:22px;">
                <a onclick="sendemoji(' &#129409; ');"> &#129409; </a>
                <a onclick="sendemoji(' 😅 ');"> 😅 </a>
                <a onclick="sendemoji(' 😂 ');"> 😂 </a>
                <a onclick="sendemoji(' 🤣 ');"> 🤣 </a>
                <a onclick="sendemoji(' 🙂 ');"> 🙂 </a>
                <a onclick="sendemoji(' 😍 ');"> 😍 </a>
                <a onclick="sendemoji(' 😘 ');"> 😘 </a>
                <a onclick="sendemoji(' 😭 ');"> 😭 </a>
                <a onclick="sendemoji(' 😢 ');"> 😢 </a>
                <a onclick="sendemoji(' 😎 ');"> 😎 </a>
                <a onclick="sendemoji(' 🤨 ');"> 🤨 </a>
                <a onclick="sendemoji(' 😳 ');"> 😳 </a>
                <a onclick="sendemoji(' 💩 ');"> 💩 </a>
                <a onclick="sendemoji(' 😡 ');"> 😡 </a>
                <a onclick="sendemoji(' 😷 ');"> 😷 </a>
                <a onclick="sendemoji(' 👋 ');"> 👋 </a>
                <a onclick="sendemoji(' 💋 ');"> 💋 </a>
                <a onclick="sendemoji(' 🙈 ');"> 🙈 </a>
                <a onclick="sendemoji(' 🌹 ');"> 🌹 </a>
                <a onclick="sendemoji(' ❤️ ');"> ❤️ </a>
            </div>
            <style>
                .buttom_img {
                    background-color: #F6F6F6;
                    width: 60%;
                    /* margin: 10px; */
                    border: 0;
                    direction: ltr;
                    border: 1px dashed #C6C6C6;
                    padding: 5px;
                    font-size: 13px;
                    color: #2d2f31;
                    text-decoration: none;
                    border-radius: 5px;
                    display: inline-block;
                }


                .remove_photo_msg {
                    text-decoration: none;
                    color: #717171;
                    font-size: 12px;
                    display: none;
                }
            </style>
            <!-- <a id="add_photo_msg" class="buttom_img" onclick="getFile()">
                <img src="assets/img/add_photo_msg.svg" alt="#" style="vertical-align:middle;" width="22" height="auto">
                أضافة صورة
            </a>
            <img id="userphoto" style="overflow:hidden;border-radius:5px;display:none;" src width="150" alt>
            <br>
            <a onclick="reset_photo_img();" class="remove_photo_msg" id="remove_photo_msg"> ازالة الصورة؟ </a>
            <form id="form">
                <input style="display:none;" type="file" accept="image/*" id="PhotoFile" name="PhotoFile" required>
                <input type="hidden" name="img_code" id="img_code">
            </form> -->
            <!-- <script>

                function getFile() {

                    showalert('لايرغب هذا المستخدم بالحصول على صور مع الرسائل الجديدة حالياً  , اذا كنت صاحب الحساب وترغب بتفعيل هذه الميزة اذهب الى اعدادات الحساب ومن ثم اختر تفعيل قبول الصور')





                }


                var img_width = 300;
                var img_height = 300;

                function isCanvasBlank(canvas) {
                    const context = canvas.getContext('2d');

                    const pixelBuffer = new Uint32Array(
                        context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                    );

                    return !pixelBuffer.some(color => color !== 0);
                }


                var is_img = false;
                function imageToDataUri(img, width, height) {

                    // create an off-screen canvas
                    var canvas = document.createElement('canvas'),
                        ctx = canvas.getContext('2d');

                    // set its dimension to target size
                    canvas.width = width;
                    canvas.height = height;

                    // draw source image into the off-screen canvas:
                    ctx.drawImage(img, 0, 0, width, height);

                    const blank = isCanvasBlank(canvas);

                    if(blank == false){
                        is_img = true;
                    }


                    return canvas.toDataURL('image/jpeg', 0.8);
                }
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {


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

                    if(is_img == true){
                        $('#userphoto').attr('src', newDataUri);
                        $('#img_code').val(newDataUri);
                        $('#userphoto').attr('src', newDataUri);
                        $("#add_photo_msg").hide();
                        $("#userphoto").show();
                        $("#remove_photo_msg").show();
                    }

                }


                $("#PhotoFile").change(function() {
                    readURL(this);

                });


                function reset_photo_img(){
                    is_img = false;
                    $('#img_code').val('');
                    $("#add_photo_msg").show();
                    $("#userphoto").hide();
                    $("#remove_photo_msg").hide();
                    $('#userphoto').attr('src', '');
                }





            </script> -->
            <a id="send_button" class="flatbutton" onclick="sendMessage()" type="submit" style="background-color:#2D2F31;cursor: pointer;width:90%;margin:10px;border:0;direction: ltr;">
                <img src="assets/img/sent.svg" alt="#" style="vertical-align:middle;" width="22" height="auto"> أرسال
                الآن
            </a>
        </form>

        <div class="hr"></div>
        <div class="user-report" dir="rtl">
            <span> الزيارات : 0</span>
            <p id="report"><a href="#mailto:sarhne.com@gmail.com?subject=البلاغ عن اساءة استخدام&body=مرحباً , لقد عثرت على رابط اعتقد انه يخالف شروط موقع صارحني الرجاء النظر على الرابط التالي : https://sarhne.com/sarhny444 " style="font-size: 13px;" class="white">أبلاغ؟</a> </p>
        </div>
    </div>
    <div class="box2">
        <div id="user_messages">
            <h1>Public Messages Here</h1>
        </div>
    </div>
    <script>
        // get_messages();
        // function get_messages(){
        //     $.ajax({
        //         type:'POST',
        //         url:'ajax/messages/get_messages.html',
        //         data:'link=sarhny444&name=Sarhny&photo=https://static.sarhne.com/sarhne.com/profile_photo/sarhny444.jpg?t=1690116757',
        //         success:function(res){
        //             $('#user_messages').html(res);
        //         },error: function (request, status, error) {
        //             $('#user_messages').html('حدث خطأ في جلب البيانات اعد المحاولة');
        //         }});
        // }



        // function loade_more(){
        //     var last_id = $('.timeline-centered:last').attr('id');
        //     get_messages_disabled_button();
        //     $.ajax({
        //         type:'POST',
        //         url:'ajax/messages/fetch_get_messages.html',
        //         data:'last_id='+last_id+'&link=sarhny444&name=Sarhny&photo=https://static.sarhne.com/sarhne.com/profile_photo/sarhny444.jpg?t=1690116757',
        //         success:function(res){

        //             get_messages_activebutton();
        //             if(res.includes('nomore')){
        //                 $('#send_button_messages').hide();
        //                 nativeToast({
        //                     message: ' تم عرض جميع الردود ',
        //                     type: 'success',
        //                     position: 'center'
        //                 })
        //             } else {
        //                 $('#posts_results').append(res);
        //             }


        //         },error: function (request, status, error) {
        //             document.getElementById('send_button_messages').disabled = false;
        //             $('#send_button_messages').html('<img src="assets/img/loader.svg" alt="#" style="vertical-align:middle;" width="22" height="auto"> أعادة المحاولة  ');
        //             server_erorr();
        //         }});

        // }



        // function get_messages_activebutton(){
        //     document.getElementById('send_button_messages').disabled = false;
        //     $('#send_button_messages').html('<img src="assets/img/scroll_down.gif" alt="#" style="vertical-align:middle;" width="22" height="auto"> عرض المزيد من الرسائل ');
        // }

        // function get_messages_disabled_button(){
        //     document.getElementById('send_button_messages').disabled = true;
        //     $('#send_button_messages').html('  انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');

        // }
    </script>
    <div class="box">
        <i class="icofont-bulb-alt" style="font-size:120px;"></i>
        <br>
        <div class="logo">
            <h1 style="font-size: 30px;">
                حانت لحظة الصراحة
            </h1>
        </div>
        <font color="#000">
            <b>هل أنت مستعد لمعرفة ملاحظات الناس عنك بدون أن تعرفهم ؟</b>
        </font><small>
            <font color="#25373D"><br>
                أحصل على رسائل سرية من زملائك بصراحة <br>
                إعرف مزاياك و عيوبك، وما يعتقده الناس عنك <br>
                عزز شخصيتك بمعرفة الواقع بعيدا عن النفاق <br>
                واجه الصراحة التي أخفتها عنك المجاملات <br>
                <br>
            </font>
        </small>
        <a href="register.php" class="userbutton" style="background-color:#F0776C;width:90%;margin:10px;"> ! سجل حسابك
            الآن </a>
    </div>
    <br>
    <div id="center" style="margin-top:50px;">
        <div class="s_left">
            <img src="assets/img/l.png" class="img_s_left">
        </div>
        <div class="s_center">
            <div class="s_contener">
                <div class="s_top">
                    <img src="assets/img/social/all.gif" style="width: 80px;opacity: .5;">
                </div>
                <div class="s_text" style="direction: rtl;font-size:14px;">
                    روابط التواصل الأجتماعي الخاصة بـ : <?= $user['name']; ?> </div>
            </div>
        </div>
        <div class="s_right">
            <img src="assets/img/r.png" class="img_s_right">
        </div>
        <div style="clear:both;"></div>
        <img src="assets/img/arrow.png" class="img_arrow">
        <br> <br>
        <img onclick="social_link('no_link','instagram');" src="assets/img/social/instagram_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','twitter');" src="assets/img/social/twitter_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','facebook');" src="assets/img/social/facebook_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','snapchat');" src="assets/img/social/snapchat_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','youtube');" src="assets/img/social/youtube_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','wa');" src="assets/img/social/wa_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','tiktok');" src="assets/img/social/tiktok_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','messenger');" src="assets/img/social/messenger_icon.svg" class="soical_icon">
        <img onclick="social_link('no_link','email');" src="assets/img/social/gmail_icon.png" class="soical_icon">
        <img onclick="social_link('no_link','website');" src="assets/img/social/website_icon.png" class="soical_icon">
    </div>

    <br>


    <script src="assets/js/autosize.min.js"></script>
    <script>
        function activebutton() {

            document.getElementById('send_button').disabled = false;
            $('#send_button').html('   ارسال مصارحة <img src="assets/img/sent.svg" width="27" class="middle" alt="#"> ');
        }

        function disabled_button() {
            document.getElementById('send_button').disabled = true;
            $('#send_button').html('  انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');

        }



        function sendMessage() {
            var message = $('#sarhne').val();

            if (message.length < 6 || message.length > 500) {
                activebutton();
                showerorr('warning', 'خطأ', 'لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف');
                showalert("لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف");
                smoothScroll(document.getElementById('erorrid'));

            } else {

                $.ajax({
                    method: "POST",
                    url: "user.php",
                    data: {
                        receiver_id: "<?= $user['id']; ?>",
                        message: message,
                        show_sender_info: show_my_info,
                        sender_id: "<?= $_SESSION['user']['id'] ?>",
                        sender_ip: "<?= $_SERVER['REMOTE_ADDR'] ?>",
                    },
                    beforeSend: function() {
                        disabled_button();
                    },
                    success: function(data, status, error) {
                        activebutton();
                        if (data.includes("msg_empty")) {
                            showerorr('warning', 'خطأ', 'لايمكن ان تكون رسالة المصارحة فارغة');
                            showalert("لايمكن ان تكون رسالة المصارحة فارغة");
                            smoothScroll(document.getElementById('erorrid'));

                        } else if (data.includes("msg_long")) {
                            showerorr('warning', 'خطأ', 'لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف');
                            showalert("لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف");
                            smoothScroll(document.getElementById('erorrid'));

                        } else if (data.includes("user_not_found")) {
                            showerorr('warning', 'خطأ', 'لم يتم العثور على المستخدم');
                            showalert("  لم يتم العثور على المستخدم  ");
                            smoothScroll(document.getElementById('erorrid'));

                        } 
                        // else if (data.includes("block")) {
                        //     showerorr('warning', 'خطأ', 'تم رفض الوصول قد يكون تم حظرك من قبل هذا المستخدم');
                        //     showalert(" تم رفض الوصول قد يكون تم حظرك من قبل هذا المستخدم  ");
                        //     smoothScroll(document.getElementById('erorrid'));

                        // }
                         else if (data.includes("successfully")) {
                            location.href = 'done.php';

                        } else {
                            console.log(data);
                            showerorr('warning', 'خطأ', 'أعد المحاولة بعد قليل واذا استمرت المشكلة من فضلك تواصل مع الادارة من خلال ازار التواصل الاجتماعي اسفل الصفحة');
                            showalert(" أعد المحاولة بعد قليل واذا استمرت المشكلة من فضلك تواصل مع الادارة من خلال ازار التواصل الاجتماعي اسفل الصفحة ");
                            smoothScroll(document.getElementById('erorrid'));
                        }
                    },
                    error: function(xhr, status, error) {

                        activebutton();
                        showerorr('warning', 'مشكلة في الموقع  ', ' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
                        showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
                        smoothScroll(document.getElementById('erorrid'));
                        // console.log(xhr);
                        // console.log(status);
                        // console.log(error);
                    },
                    complete: function() {
                        activebutton();
                    }
                });

            }
        }






        // function send_form(){
        //     disabled_button();


        //     if($('#sarhne').val().length < 6)
        //     {
        //         activebutton();
        //         showerorr('warning','خطأ','لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف');
        //         showalert("لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف");
        //         smoothScroll(document.getElementById('erorrid'));

        //     } else if($('#img_code').length > 0 && $('#img_code').val() != '') {


        //         var img_code_post = $('#img_code').val();
        //         var data = 'img_code=' + img_code_post;

        //         $.ajax({
        //             type:'POST',
        //             url:'ajax/messages/upload_img.html',
        //             data: data,
        //             success:function(i){
        //                 if(i !='' && i.length>0 && i != 'err'){
        //                     post_msg(i);
        //                 } else {
        //                     post_msg('null');
        //                 }

        //             },error: function (request, status, error) {
        //                 post_msg('null');

        //             }});

        //     } else {

        //         post_msg('null');

        //     }
        // }



        // function post_msg(i){

        //     grecaptcha.ready(function() {
        //         grecaptcha.execute('6Le10rcUAAAAAE71INWyFbBjBUU7BPGQo5_thY9b', {action: 'submit'}).then(function(t) {
        //             $.ajax({
        //                 type:'POST',
        //                 url:'ajax/messages/send.html',
        //                 data: $('#form').serialize()+"&link=sarhny444&bad_words=false&i="+i+"&t="+t,
        //                 success:function(data){
        //                     activebutton();
        //                     if (data.includes("security_err")){
        //                         showerorr('warning','خطأ','تم اكتشاف نشاط مريب الرجاء أعادة المحاولة او اتصل بنا');
        //                         showalert("خطأ في حماية الموقع من فضلك تواصل معنا اذا استمرت المشكلة");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("send_limit")){
        //                         showerorr('warning','خطأ','نحن نضع حدود للمصارحات لاتستطيع ارسال اكثر من مصارحة في مدة اقل من 30 ثانية انتظر قليلاً واعد المحاولة');
        //                         showalert("نحن نضع حدود للمصارحات لاتستطيع ارسال اكثر من مصارحة في مدة اقل من 30 ثانية انتظر قليلاً واعد المحاولة");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("msg_empty")){
        //                         showerorr('warning','خطأ','لايمكن ان تكون رسالة المصارحة فارغة');
        //                         showalert("لايمكن ان تكون رسالة المصارحة فارغة");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("msg_long")){
        //                         showerorr('warning','خطأ','لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف');
        //                         showalert("لايمكن ان تكون رسالة المصارحة اقل من 6 حروف او اكبر من 500 حرف");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("user_not_found")){
        //                         showerorr('warning','خطأ','لم يتم العثور على المستخدم');
        //                         showalert("  لم يتم العثور على المستخدم  ");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("block")){
        //                         showerorr('warning','خطأ','تم رفض الوصول قد يكون تم حظرك من قبل هذا المستخدم');
        //                         showalert(" تم رفض الوصول قد يكون تم حظرك من قبل هذا المستخدم  ");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     } else if (data.includes("bad_word")){
        //                         showerorr('warning','خطأ','تم رفض الوصول تأكد من محتوى المصارحة');
        //                         showalert(" تم رفض الوصول تأكد من محتوى المصارحة  ");
        //                         smoothScroll(document.getElementById('erorrid'));

        //                     }  else if (data.includes("successfully")){
        //                         $("#sarhne").val('');
        //                         document.getElementById("success_form").submit();
        //                         $('#send_button').html('  جارٍ معالجة الطلب <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');

        //                     } else {
        //                         showerorr('warning','خطأ','أعد المحاولة بعد قليل واذا استمرت المشكلة من فضلك تواصل مع الادارة من خلال ازار التواصل الاجتماعي اسفل الصفحة');
        //                         showalert(" أعد المحاولة بعد قليل واذا استمرت المشكلة من فضلك تواصل مع الادارة من خلال ازار التواصل الاجتماعي اسفل الصفحة ");
        //                         smoothScroll(document.getElementById('erorrid'));
        //                     }









        //                 },error: function (request, status, error) {
        //                     activebutton();
        //                     showerorr('warning','مشكلة في الموقع  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
        //                     showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
        //                     smoothScroll(document.getElementById('erorrid'));

        //                 }});

        //         });
        //     });

        // }



        // function social_link(link,socila){
        //     var msg = "";
        //     if(socila == 'facebook'){
        //         msg = "هذا المستخدم لم يضع رابط الفيسبوك الخاص به";
        //     } else  if(socila == 'instagram'){
        //         msg = "هذا المستخدم لم يضع رابط انستغرام الخاص به";
        //     } else  if(socila == 'twitter'){
        //         msg = "هذا المستخدم لم يضع رابط تويتر الخاص به";
        //     } else  if(socila == 'snapchat'){
        //         msg = "هذا المستخدم لم يضع رابط سناب شات الخاص به";
        //     } else  if(socila == 'youtube'){
        //         msg = "هذا المستخدم لم يضع رابط قناته على اليتيوب ";
        //     } else  if(socila == 'wa'){
        //         msg = "هذا المستخدم لم يضع رقم هاتفه  ";
        //     } else  if(socila == 'tiktok'){
        //         msg = "هذا المستخدم لم يضع رابط التيك توك الخاص به  ";
        //     } else  if(socila == 'messenger'){
        //         msg = "هذا المستخدم لم يضع رابط المسنجر الخاص به  ";
        //     } else  if(socila == 'email'){
        //         msg = "هذا المستخدم لم يضع بريده الألكتروني  ";
        //     }else  if(socila == 'website'){
        //         msg = "هذا المستخدم لم يضع رابط موقعه الألكتروني  ";
        //     }


        //     if(link == 'no_link'){
        //         showalert(msg);
        //     } else {
        //         window.location.href=link;
        //     }




        // }




        function showerorr(type, title, msg) {
            $('#erorrid').show();
            document.getElementById('erorrid').innerHTML = "<div class='notification " + type +
                "' dir='rtl'><span class='notification-close'>&times;</span><h3 class='notification-title'>" + title +
                "</h3><p class='notification-message'>" + msg + "</p></div>";
        }






        // function msglike(id){

        //     document.getElementById("imglk_"+id).src="assets/img/ajax_clock_black.svg";

        //     $.ajax({
        //         type:'POST',
        //         url:'ajax/messages/like.html',
        //         data:'msg_id='+id,
        //         success:function(res){
        //             $('#totallk_'+id).html(res);
        //             document.getElementById("imglk_"+id).src="assets/img/like.svg";
        //             document.getElementById('msglike_'+id).onclick = null;
        //         },error: function (request, status, error) {
        //             document.getElementById("imglk_"+id).src="assets/img/ajax_err_black.svg";
        //             server_erorr();
        //         }});


        // }


        function screenClass() {
            if ($(window).innerWidth() > 1200) {
                $('.tabs').hide();
                $('.hrbac').hide();
            } else {
                $('.hrbac').show();
                $('.tabs').show();
            }
        }

        screenClass();
        $(window).bind('resize', function() {
            screenClass();
        });
        var modal = document.getElementById('myModal');

        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
        autosize(document.getElementById("sarhne"));

        function sendemoji(e) {

            var textField = $('#sarhne');

            $("#sarhne").val(textField.val() + e);
            $("#sarhne").focus();
        }
    </script>


    <?php include "includes/templates/footer.php"; ?>