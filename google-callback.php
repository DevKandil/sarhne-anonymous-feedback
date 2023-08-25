
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title> خطوة واحدة للبدء </title>
    <link href="assets/style.css?v=1641488955" rel="stylesheet"> <script src="https://www.google.com/recaptcha/api.js?render=6LcioskhAAAAAC2ftymi6tgPWopSlc7ghmQlW-i8"></script>
    <link rel="stylesheet" type="text/css" href="assets/icofont.min.css">
    <script src="assets/js/jquery.min.js"></script>
</head>
<body id="body">
<center>
    <div id="top">
        <br><img class="cimg" src="https://lh3.googleusercontent.com/a/AAcHTtdYyHbytjL8zURpUaduYoy7m5u1KSF5h3F2Il-wgDaR=s96-c" width="111" alt="#"><br>
        <div class="logo"><h3>
                Sarhny </h3> </div>
        <br><br>
    </div>
    <div id="center"> <div class="center">
            <section id="succ" style="display:none;">
                <div class="hhr"></div>
                <h3>
                    تم تسجيل حسابك بنجاح
                </h3>
                <img src="assets/img/done.svg" width="100" height="100" alt="*">
                <h5>
                    الرجاء الأنتظار
                </h5><div class="hhr"></div>
            </section>
            <section id="ajax_wait" style="display:none;">
                <div class="hhr"></div>
                <h3>
                    تسجيل حساب جديد
                </h3>
                <div class="loader"></div>
                <h5>
                    الرجاء الأنتظار
                </h5><div class="hhr"></div>
            </section>
            <section id="reg">
                <span id="erorrid"></span>
                <div class="rule">
                    <div class="line"><div></div></div>
                    <div class="words"> خطوة واحدة للأنتهاء </div>
                    <div class="line"><div></div></div>
                </div>
                <span class="green newline"> الرجاء تأكيد الاسم والجنس للأستمرار </span>
                <br> <br>
                <form id="form">
                    <input name="email" type="hidden" value="sarhny444@gmail.com">
                    <input name="picture" type="hidden" value="https://lh3.googleusercontent.com/a/AAcHTtdYyHbytjL8zURpUaduYoy7m5u1KSF5h3F2Il-wgDaR=s96-c">
                    <input name="reg_type" type="hidden" value="google">
                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="text" name="name" value="Sarhny" placeholder="اكتب الأسم او اللقب" />
                        <div class="input-icon"><i><img src="assets/img/user-form.svg" width="20" alt="*"></i></div>
                    </div>
                    <div class="input-group input-group-icon" dir="ltr" style="margin-bottom:0px;padding-bottom:0px;">
                        <input type="text" id="link" name="link" placeholder="اختر رابط خاص بك حروف وارقام انجلزية فقط" autocomplete="off" />
                        <div class="input-icon"><i><img src="assets/img/link-form.svg" width="20" alt="*"></i></div>
                    </div>
                    <span style="float:left;padding-left:29px;"><font color="#FF5239"> https://www.sarhne.com/<span style="color:#212121;" class="preview"></span> </span></font>
                    <span id="make_link" style="float:right;padding-right:29px;font-size: 13px;color: green;" onclick="get_link();"> توليد رابط؟ </span>
                    <br>
                    <br>
        </div>
        <div class="select">
            <select id="sex" name="sex" style="direction: rtl; text-align: center;">
                <option value="0"> الجنس - ذكر </option>
                <option value="1"> الجنس - أنثى </option>
            </select>
        </div>
        <br>
        <a onclick="signup();" class="flatbutton" style="background-color:#34383D;width:90%;border:0;"> تسجيل حساب جديد </a>
        </form>
        <br>
        </section></div></div>
</center><br><br>
<script>

    function get_link(){
        $('#make_link').html('<img src="assets/img/loading.svg" width="30" alt="انتظر">');
        $.ajax({
            type:'GET',
            url:'ajax/account/link.html',
            data: $('#form').serialize(),
            success:function(res){
                if (res == 'err'){
                    get_link();
                } else {
                    $('#link').val(res);
                    $('.preview').html(res);
                    $('#make_link').html(' ');
                }
            },error: function (request, status, error) {
                $('#make_link').html(' ');
                showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");

            }});
    }

    function signup() {
        $('#erorrid').hide();
        $('#ajax_wait').show();
        $('#reg').hide();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcioskhAAAAAC2ftymi6tgPWopSlc7ghmQlW-i8', {action: 'submit'}).then(function(token) {
                send_form(token);
            });
        });
        // smoothScroll(document.getElementById('ajax_wait'));
    }


    function send_form(token){



        $.ajax({
            type:'POST',
            url:'ajax/account/signup.html',
            data: $('#form').serialize()+"&g-recaptcha-response="+token,
            success:function(data){
                $('#ajax_wait').hide();
                $('#reg').show();
                if (data.includes("recerorr")){
                    showerorr('warning','خطأ التحقق البشري','الرجاء أعادة المحاولة او اتصل بنا');
                    showalert("خطأ التحقق البشري الرجاء أعادة المحاولة او اتصل بنا");
                    smoothScroll(document.getElementById('erorrid'));
                    grecaptcha.reset();
                } else if(data.includes("emptyname")){
                    showerorr('warning','خطأ الاسم او اللقب','الرجاء كتابة اسمك او لقبلك بشكل صحيح');
                    showalert("الرجاء كتابة اسمك او لقبلك بشكل صحيح");
                    smoothScroll(document.getElementById('erorrid'));

                } else if(data.includes("erorremail")){
                    showerorr('warning','خطأ البريد الألكتروني','الرجاء كتابة بريدك الألكتروني بشكل صحيح');
                    showalert("الرجاء كتابة بريدك الألكتروني بشكل صحيح");
                    smoothScroll(document.getElementById('erorrid'));

                }  else if(data.includes("dns")){
                    showerorr('warning','خطأ البريد الألكتروني','لم يتم العثور على البريد الألكتروني الذي تم ادخاله الرجاء استخدام gmail او yahoo او خدمة بريد حقيقية الرجاء اعادة المحاولة');
                    showalert("لم يتم العثور على البريد الألكتروني الذي تم ادخاله الرجاء اعادة المحاولة");
                    smoothScroll(document.getElementById('erorrid'));

                }   else if(data.includes("link1")){
                    showerorr('warning','خطأ أختيار الرابط',' الرابط يحتوي على حروف غير صحيحة الرجاء كتابة الرابط بحرف وارقام انكليزية فقط ');
                    showalert("الرابط يحتوي على حروف غير صحيحة الرجاء كتابة الرابط بحرف وارقام انكليزية فقط");
                    smoothScroll(document.getElementById('erorrid'));

                } else if(data.includes("link2")){
                    showerorr('warning','خطأ أختيار الرابط',' الرابط يجب ان يكون اكثر من 3 حروف واقل من 30 حرفاً ');
                    showalert(" الرابط يجب ان يكون اكثر من 3 حروف واقل من 30 حرفاً ");
                    smoothScroll(document.getElementById('erorrid'));

                }  else if(data.includes("gender")){
                    showerorr('warning','خطأ أختيار الجنس ',' أختر جنسك من فضلك  ');
                    showalert("  أختر جنسك من فضلك ");
                    smoothScroll(document.getElementById('erorrid'));

                }  else if(data.includes("emailused")){
                    showerorr('warning','خطأ البريد الألكتروني ','تم استخدام البريد الألكتروني الذي ادخلته من قبل شخص أخر الرجاء ادخال بريد مختلف او انتقل لصفحة تسجيل الدخول واستخدم هذا البريد للدخول الى حسابك    ');
                    showalert("تم استخدام البريد الألكتروني الذي ادخلته من قبل شخص أخر الرجاء ادخال بريد مختلف او انتقل لصفحة تسجيل الدخول واستخدم هذا البريد للدخول الى حسابك ");
                    smoothScroll(document.getElementById('erorrid'));

                }  else if(data.includes("linkused")){
                    showerorr('warning','خطأ أختيار الرابط ',' الرابط الذي قمت باختياره غير متاح مستخدم من قبل شخص اخر من فضلك اختر رابط مختلف او انقر على خيار توليد رابط ');
                    showalert("الرابط الذي قمت باختياره غير متاح مستخدم من قبل شخص اخر من فضلك اختر رابط مختلف او انقر على خيار توليد رابط ");
                    smoothScroll(document.getElementById('erorrid'));
                    $('#h_link').show();
                    $('#link_preview').show();

                } else if(data.includes("mysqlerorr")){
                    showerorr('warning','مشكلة في الموقع  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
                    showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
                    smoothScroll(document.getElementById('erorrid'));

                } else if(data.includes("succ")){
                    $('#erorrid').hide();
                    $('#ajax_wait').hide();
                    $('#reg').hide();
                    $('#succ').show();
                    window.location.replace("messages.html");
                }
            },error: function (request, status, error) {

                showerorr('warning','مشكلة في الموقع  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
                showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
                smoothScroll(document.getElementById('erorrid'));

            }});




    }
    function showerorr(type,title,msg){
        $('#erorrid').show();
        document.getElementById('erorrid').innerHTML="<div class='notification "+type+"' dir='rtl'><span class='notification-close'>&times;</span><h3 class='notification-title'>"+title+"</h3><p class='notification-message'>"+msg+"</p></div>";
    }
</script>
<script src="assets/js/func.js?v=1598020502"></script>
<script src="assets/js/alerty.js?v2"></script>
<script src="assets/js/toast.js"></script>
<div id="footer">
    <center> <br>
        <a href="https://www.facebook.com/Sarhne.Official/"><img src="assets/img/ffacebook.svg" width="50" height="auto"> &nbsp; </a>
        <a href="https://www.instagram.com/sarhne_official/?swa33"><img src="assets/img/finstagram.svg" width="50" height="auto"> &nbsp; </a>
        <a href="#"><img src="assets/img/fwhatsapp.svg" width="50" height="auto"> &nbsp; </a>
        <a href="https://play.google.com/store/apps/details?id=app.sarhne.com"><img src="assets/img/fandroid.svg" width="50" height="auto"></a>
        <br>
        <small> جميع الحقوق محفوظة © 2023 </small>
        <br>
        <a href="index.html" class="wh"> صارحني </a> - <a href="https://www.sarhne.com/Privacy.html" class="wh"> الخصوصية </a> - <a href="https://www.sarhne.com/Terms.html" class="wh"> القوانين </a> - <a href="contact_us.html" class="wh"> اتصل بنا </a> <img src="assets/img/sarhne-footer.png" width="20" alt="2021">
        <br> <br> </center> </div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117429964-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-117429964-1');
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2cb3a2ab87c5498db5ce7e6608cf55231689030342039" integrity="sha512-DI3rPuZDcpH/mSGyN22erN5QFnhl760f50/te7FTIYxodEF8jJnSFnfnmG/c+osmIQemvUrnBtxnMpNdzvx1/g==" data-cf-beacon='{"rayId":"7eb40ace8ecb5fa1","token":"218cd1753fe64a258e6d9b2b19630e7e","version":"2023.4.0","si":100}' crossorigin="anonymous"></script>
</body>
</html>
