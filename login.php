<?php
$pageTitle = "صارحني تسجيل الدخول";

session_start();

if (isset($_SESSION['user'])) {
    header('Location: messages.php');
}

include "init.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();

    if (isset($_POST['login'])) {

        $email = $_POST['email'];
        $pass = $_POST['password'];
        $hashedPass = sha1($pass);

        // Check If The User Exist In Database

        $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND hashed_pass = ?");

        $stmt->execute([$email, $hashedPass]);

        $get = $stmt->fetch(PDO::FETCH_ASSOC);

        $count = $stmt->rowCount();

        // If Count > 0 This Mean The Database Contain Record About This Username

        if ($count > 0) {

            $_SESSION['user']['id'] = $get['id']; // Register User ID in Session
            $_SESSION['user']['isAdmin'] = $get['is_admin']; // Register User ID in Session
            $_SESSION['user']['name'] = $get['name']; // Register Session Name
            $_SESSION['user']['username'] = $get['username']; // Register Session email
            $_SESSION['user']['email'] = $get['email']; // Register Session email
            $_SESSION['user']['public_pic'] = $get['public_pic']; // Register Session Name
            $_SESSION['user']['gender'] = $get['gender']; // Register Session Name
            $_SESSION['user']['sumary'] = $get['sumary']; // Register Session Name
            $_SESSION['user']['visitors_num'] = $get['visitors_num']; // Register Session Name
            $_SESSION['user']['last_login'] = $get['last_login']; // Register Session Name
            $_SESSION['user']['social']['facebook'] = $get['facebook']; // Register Session Name
            $_SESSION['user']['social']['twitter'] = $get['twitter']; // Register Session Name
            $_SESSION['user']['social']['instagram'] = $get['instagram']; // Register Session Name
            $_SESSION['user']['created_at'] = $get['created_at']; // Register Session Name
            $_SESSION['user']['updated_at'] = $get['updated_at']; // Register Session Name


            header('Location: messages.php'); // Redirect To Dashboard Page

            exit();
        } 
    }
}

include $tpl . 'header.php';


//initialize facebook sdk
/*require 'vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '1562230330978982',
    'app_secret' => 'a575ec86a091a01021c8588ce62a7a09',
    'default_graph_version' => 'v2.5',
]);


$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
try {
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
} catch(Facebook\Exceptions\facebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
if (isset($accessToken)) {
    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
    // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
    // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    // redirect the user to the profile page if it has "code" GET variable
    if (isset($_GET['code'])) {
        header('Location: profile.php');
    }
    // getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
        $requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture
        $picture = $requestPicture->getGraphUser();
        $profile = $profile_request->getGraphUser();
        $fbid = $profile->getProperty('id');           // To Get Facebook ID
        $fbfullname = $profile->getProperty('name');   // To Get Facebook full name
        $fbemail = $profile->getProperty('email');    //  To Get Facebook email
        $fbpic = "<img src='".$picture['url']."' class='img-rounded'/>";
    // save the user nformation in session variable
        $_SESSION['fb_id'] = $fbid.'</br>';
        $_SESSION['fb_name'] = $fbfullname.'</br>';
        $_SESSION['fb_email'] = $fbemail.'</br>';
        $_SESSION['fb_pic'] = $fbpic.'</br>';
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
    // redirecting user back to app login page
        header("Location: ./");
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
} else {
    // replace  website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and used
    $loginUrl = $helper->getLoginUrl('https://tutsmake.com/Demos/php-facebook', $permissions);
    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}*/
?>


<center>
    <div id="top">
        <img src="assets/img/logo-150.jpg" style="width: 100px; margin: 120px 0 20px 0;" alt="#"><br>
        <div class="logo">
            <h1 class="h1">
                صارحني تسجيل الدخول
            </h1>
        </div>
        <br><br>
    </div>
    <!-- <div id="center">
        <div class="center">
            <div class="rule">
                <div class="line">
                    <div></div>
                </div>
                <div class="words"> دخول مباشر </div>
                <div class="line">
                    <div></div>
                </div>
            </div>

            <span id="button_s">
                <a href="https://www.facebook.com/v7.0/dialog/oauth?client_id=393419816215075&amp;state=cf234b90801cc7dac5e3f0a3de735b06&amp;response_type=code&amp;sdk=php-sdk-7.0.0&amp;redirect_uri=https%3A%2F%2Fwww.sarhne.com%2Ffacebook-callback.html&amp;scope=email" class="flatbutton" style="background-color:#4267B2;margin-bottom:10px;"> <img src="assets/img/f.svg" width="15" height="auto" style="vertical-align:middle;padding-left:5px;" alt="F"> تسجيل الدخول باستخدام
                    فيس بوك </a>
                <br>
                <a href="https://accounts.google.com/o/oauth2/v2/auth?response_type=code&amp;access_type=online&amp;client_id=684046391432-mtghelnq5gg4cdcr4td02kicfvoc3uk7.apps.googleusercontent.com&amp;redirect_uri=https%3A%2F%2Fwww.sarhne.com%2Fgoogle-callback.html&amp;state&amp;scope=email%20profile&amp;approval_prompt=auto" class="flatbutton" style="background-color:#DB4437;margin-bottom:10px;"><img src="assets/img/g.svg" width="15" height="auto" style="vertical-align:middle;padding-left:5px;" alt="G"> تسجيل الدخول باستخدام
                    جوجل </a>
                <br>
            </span>
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
                <div id="erorrid"></div>
                <form action="" method="POST" id="form_singin" style="text-align: -webkit-center">
                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="text" id="email" name="email" placeholder="أدخل بريدك الألكتروني" required />
                        <div class="input-icon"><i><img src="assets/img/email-login.svg" width="20" alt="*"></i>
                        </div>
                    </div>
                    <div class="input-group input-group-icon" dir="rtl">
                        <input type="password" name="password" id="showpassword" placeholder="كلمة المرور" required />
                        <div class="input-icon"><i><img src="assets/img/key.svg" width="20" alt="*"></i></div>
                    </div>
                    <div class="forgot" dir="rtl">
                        <input type="checkbox" id="check" />
                        <label for="check" onclick="showpassword();">
                            <span></span><small> عرض كلمة المرور </small>
                        </label>
                    </div>


                    <small dir="rtl" style="font-size: 12px;
                            margin-bottom: 10px;
                            display: block;text-align: right;
                            margin-right: 25px;"> بالضغط على تسجيل الدخول لـ صارحني فأنك توافق على <a href="terms.php" style="color: #f1776c" dir="rtl" class> شروط
                            الأستخدام </a> و <a href="privacy.php" style="color: #f1776c" dir="rtl" class> سياسة الخصوصية </a> . </small>
                    <input type="submit" name="login" value="تسجيل الدخول" id="login" class="flatbutton" style="background-color:#2D2F31;width:90%;border:0; cursor: pointer; font-family: cairo">
                </form> <br>
                ليس لديك حساب ؟ <a href="register.php" style="color: #f1776c">سجل حسابك الآن</a>
                <br>
                <p><a style="font-size: 13px;" class="white" href="resetpassword.php">نسيت كلمة السر؟</a></p>
                <div class="hhr"></div>
</center>
<br></div>
</div> </span>
<script>
    function showerorr(type, title, msg) {
        $('#erorrid').show();
        document.getElementById('erorrid').innerHTML = "<div class='notification " + type +
            "' dir='rtl'><span class='notification-close'>&times;</span><h3 class='notification-title'>" + title +
            "</h3><p class='notification-message'>" + msg + "</p></div>";
    }

    showerorr('warning', 'خطأ البريد الألكتروني او كلمة المرور', 'الرجاء كتابة بريدك الألكتروني او كلمة المرور بشكل صحيح');
    smoothScroll(document.getElementById('erorrid'));


    function showpassword() {
        var x = document.getElementById("showpassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function activebutton() {
        document.getElementById('login').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('showpassword').disabled = false;
        $('#login').html(' تسجيل الدخول ');
    }

    function disabled_button() {
        document.getElementById('login').disabled = true;
        document.getElementById('email').disabled = true;
        document.getElementById('showpassword').disabled = true;
        $('#login').html('  انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');

    }
</script>

<?php include "includes/templates/footer.php"; ?>