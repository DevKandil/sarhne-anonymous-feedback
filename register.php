<?php
$pageTitle = "صارحني تسجيل حساب";

session_start();

if (isset($_SESSION['user'])) {
    header('Location: messages.php');
}

include "init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // echo "##### POST #####\n";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPass = sha1($password);

    // Check If The User Exist In Database

	$stmt = $con->prepare("SELECT * FROM users WHERE username = ? OR email = ?");

    $stmt->execute([$username, $email]);

    $get = $stmt->fetch();

    $count = $stmt->rowCount();

    // If Count > 0 This Mean The Database Contain Record About This Username

    if ($count > 0) {

        exit('Error : User Exsits');

    } else {

        // Insert Category Info In Database

        $stmt = $con->prepare("INSERT INTO users(name, username, email, password, hashed_pass)

                                VALUES(:zname, :zusername, :zemail, :zpassword, :zhashedpass)");

        $stmt->execute(array(
        'zname' 	    => $name,
        'zusername' 	=> $username,
        'zemail' 	    => $email,
        'zpassword' 	=> $password,
        'zhashedpass' 	=> $hashedPass
        ));

        $count = $stmt->rowCount();

        if ($count > 0) {

            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;

            header('Location: messages.php');
    
        } else {
            exit('Error : Reagister Error.');
        }


    }


}

include $tpl . 'header.php';


?>

    <center>
        <div id="top">
            <img src="assets/img/logo-150.jpg" style="width: 110px; margin: 120px 0 20px 0;" alt="Sarhne_logo">
            <div class="logo">
                <h1 class="h1">
                    صارحني تسجيل حساب
                </h1>
            </div>
            <br><br>
        </div>
        <!-- <div id="center">
            <div class="center">

                <section id="reg">
                    <div class="rule">
                        <div class="line">
                            <div></div>
                        </div>
                        <div class="words"> تسجيل مباشر</div>
                        <div class="line">
                            <div></div>
                        </div>
                    </div>
                    <a href="https://www.facebook.com/v7.0/dialog/oauth?client_id=393419816215075&amp;state=cde2bbf3664399f73319c654b2499815&amp;response_type=code&amp;sdk=php-sdk-7.0.0&amp;redirect_uri=https%3A%2F%2Fwww.sarhne.com%2Ffacebook-callback.html&amp;scope=email"
                       class="flatbutton" style="background-color:#4267B2;margin-bottom:10px;"> <img src="assets/img/f.svg"
                                                                                                     width="15" height="auto" style="vertical-align:middle;padding-left:5px;" alt="F"> تسجيل بواسطة
                        فيس بوك </a>
                    <br>
                    <a href="https://accounts.google.com/o/oauth2/v2/auth?response_type=code&amp;access_type=online&amp;client_id=684046391432-mtghelnq5gg4cdcr4td02kicfvoc3uk7.apps.googleusercontent.com&amp;redirect_uri=https%3A%2F%2Fwww.sarhne.com%2Fgoogle-callback.html&amp;state&amp;scope=email%20profile&amp;approval_prompt=auto"
                       class="flatbutton" style="background-color:#DB4437;margin-bottom:10px;"><img src="assets/img/g.svg"
                                                                                                    width="15" height="auto" style="vertical-align:middle;padding-left:5px;" alt="G"> تسجيل بواسطة
                        جوجل </a>
                    <br>
                    <br>
                </section>
            </div>
        </div> -->
        <br><br>
        <span id="button_logins">
        <div id="center">
            <div class="center">
                <div class="rule">
                    <div class="line">
                        <div></div>
                    </div>
                    <div class="words"> أدخل البيانات </div>
                    <div class="line">
                        <div></div>
                    </div>
                </div>
                <div id="erorrid"> </div>
                <form action="" method="POST" id="form_singin" style="text-align: -webkit-center">

                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="text" id="email" name="name" placeholder="الإسم" required/>
                        <div class="input-icon"><i><img src="assets/img/user-form.svg" width="20" alt="*"></i>
                        </div>
                    </div>

                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="text" id="email" name="username" placeholder="إسم المستخدم" required/>
                        <div class="input-icon input-username" dir="ltr" style="
                            color: #536570;
                            background-color: #d4dbe0;
                            border: 1px solid #d4dbe0;
                            border-right: none;
                            border-radius: 4px 0 0 4px;
                            padding: 0 7px;
                            font-weight: bold;
                            width: 120px;
                            height: 48px;">
                            Sarah-ah.com/
                        </div>
                    </div>

                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="text" id="email" name="email" placeholder="البريد الإلكتروني" required/>
                        <div class="input-icon"><i><img src="assets/img/email-login.svg" width="20" alt="*"></i>
                        </div>
                    </div>

                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="password" name="password" id="showpassword" placeholder="الرقم السري" required/>
                        <div class="input-icon"><i><img src="assets/img/key.svg" width="20" alt="*"></i></div>
                    </div>

<!--                    <div class="input-group input-group-icon" dir="rtl">-->
<!--                        <label style="width: 30%; cursor: none; display: inline;margin-left: 20px">الصورة الشخصية :-->
<!--                        </label>-->
<!--                        <input type="file" name="profile_pic" style="width: 70%" />-->
<!--                    </div>-->



                    <div class="forgot" dir="rtl">
                        <input type="checkbox" id="check" name="check" value />
                        <label for="check" onclick="showpassword();">
                            <span></span><small> عرض كلمة المرور </small>
                        </label>
                    </div>
                    <small dir="rtl" style="font-size: 12px;
                            margin-bottom: 10px;
                            display: block;text-align: right;
                            margin-right: 25px;"> بالضغط على تسجيل الدخول لـ صارحني فأنك توافق على <a href="terms.php"
                                                                                                      style="color: #f1776c" dir="rtl" class> شروط
                            الأستخدام </a> و <a href="privacy.php" style="color: #f1776c" dir="rtl" class> سياسة الخصوصية </a> . </small>
                    <input type="submit" name="submit" value="إنشاء حساب" id="login" class="flatbutton"
                           style="background-color:#2D2F31;width:90%;border:0; cursor: pointer; font-family: cairo">

                </form><br>

            <div class="hhr"></div>
        </div>
            </div>
    </span>
    </center>
    <br>
    <script>
        

        // function send_form(token){
        //
        //
        //
        //     $.ajax({
        //         type:'POST',
        //         url:'ajax/account/signup.html',
        //         data: $('#form').serialize()+"&g-recaptcha-response="+token,
        //         success:function(data){
        //             $('#ajax_wait').hide();
        //             $('#reg').show();
        //             if (data.includes("recerorr")){
        //                 showerorr('warning','خطأ التحقق البشري','الرجاء أعادة المحاولة او اتصل بنا');
        //                 showalert("خطأ التحقق البشري الرجاء أعادة المحاولة او اتصل بنا");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("emptyname")){
        //                 showerorr('warning','خطأ الاسم او اللقب','الرجاء كتابة اسمك او لقبلك بشكل صحيح');
        //                 showalert("الرجاء كتابة اسمك او لقبلك بشكل صحيح");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("erorremail")){
        //                 showerorr('warning','خطأ البريد الألكتروني','الرجاء كتابة بريدك الألكتروني بشكل صحيح');
        //                 showalert("الرجاء كتابة بريدك الألكتروني بشكل صحيح");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             }  else if(data.includes("dns")){
        //                 showerorr('warning','خطأ البريد الألكتروني','لم يتم العثور على البريد الألكتروني الذي تم ادخاله الرجاء استخدام gmail او yahoo او خدمة بريد حقيقية الرجاء اعادة المحاولة');
        //                 showalert("لم يتم العثور على البريد الألكتروني الذي تم ادخاله الرجاء اعادة المحاولة");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("pasnotmatch")){
        //                 showerorr('warning','خطأ كلمة المرور',' كلمات المرور غير متطابقة ');
        //                 showalert(" كلمات المرور غير متطابقة الرجاء اعادة المحاولة");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else  if(data.includes("notacceptpass")){
        //                 showerorr('warning','خطأ كلمة المرور',' كلمات المرور تحتوي على حروف غير صحيحة الرجاء كتابة كلمة المرور بحرف وارقام انكليزية فقط يجب ان تكون اكثر من 3 حروف واقل من 30 حرفاً ');
        //                 showalert("كلمات المرور تحتوي على حروف غير صحيحة الرجاء كتابة كلمة المرور بحرف وارقام انكليزية فقط يجب ان تكون اكثر من 3 حروف واقل من 30 حرفاً");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("link1")){
        //                 showerorr('warning','خطأ أختيار الرابط',' الرابط يحتوي على حروف غير صحيحة الرجاء كتابة الرابط بحرف وارقام انكليزية فقط ');
        //                 showalert("الرابط يحتوي على حروف غير صحيحة الرجاء كتابة الرابط بحرف وارقام انكليزية فقط");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("link2")){
        //                 showerorr('warning','خطأ أختيار الرابط',' الرابط يجب ان يكون اكثر من 3 حروف واقل من 30 حرفاً ');
        //                 showalert(" الرابط يجب ان يكون اكثر من 3 حروف واقل من 30 حرفاً ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             }  else if(data.includes("gender")){
        //                 showerorr('warning','خطأ أختيار الجنس ',' أختر جنسك من فضلك  ');
        //                 showalert("  أختر جنسك من فضلك ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             }  else if(data.includes("emailused")){
        //                 showerorr('warning','خطأ البريد الألكتروني ','تم استخدام البريد الألكتروني الذي ادخلته من قبل شخص أخر الرجاء ادخال بريد مختلف او انتقل لصفحة تسجيل الدخول واستخدم هذا البريد للدخول الى حسابك    ');
        //                 showalert("تم استخدام البريد الألكتروني الذي ادخلته من قبل شخص أخر الرجاء ادخال بريد مختلف او انتقل لصفحة تسجيل الدخول واستخدم هذا البريد للدخول الى حسابك ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             }  else if(data.includes("linkused")){
        //                 showerorr('warning','خطأ أختيار الرابط ',' الرابط الذي قمت باختياره غير متاح مستخدم من قبل شخص اخر من فضلك اختر رابط مختلف او انقر على خيار توليد رابط ');
        //                 showalert("الرابط الذي قمت باختياره غير متاح مستخدم من قبل شخص اخر من فضلك اختر رابط مختلف او انقر على خيار توليد رابط ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //                 grecaptcha.reset();
        //             } else if(data.includes("mysqlerorr")){
        //                 showerorr('warning','مشكلة في الموقع  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
        //                 showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("security_err")){
        //                 showerorr('warning','مشكلة في الحماية  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
        //                 showalert("مشكلة في حماية الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
        //                 smoothScroll(document.getElementById('erorrid'));
        //
        //             } else if(data.includes("succ")){
        //                 $('#erorrid').hide();
        //                 $('#ajax_wait').hide();
        //                 $('#reg').hide();
        //                 $('#succ').show();
        //                 window.location.replace("index-2.html");
        //             }
        //         },error: function (request, status, error) {
        //
        //             showerorr('warning','مشكلة في الموقع  ',' اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً  ');
        //             showalert("مشكلة في الموقع اعد المحاولة بعد قليل او اتصل بنا لحل المشكلة فوراً ");
        //             smoothScroll(document.getElementById('erorrid'));
        //
        //         }});
        //
        //
        //
        //
        // }

        function showpassword() {
            var x = document.getElementById("showpassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }


    </script>

<?php include "includes/templates/footer.php"; ?>