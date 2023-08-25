
<div class="footer footer--dark" dir="rtl">
    <div class="container" dir="rtl">
        <div id="footer">
            <center> <br>
                <a href="https://www.facebook.com/"><img src="assets/img/ffacebook.svg" width="50" height="auto"> &nbsp; </a>
                <a href="https://www.instagram.com/"><img src="assets/img/finstagram.svg" width="50" height="auto"> &nbsp; </a>
                <a href="#"><img src="assets/img/fwhatsapp.svg" width="50" height="auto"> &nbsp; </a>
                <a href="https://play.google.com/store/"><img src="assets/img/fandroid.svg" width="50" height="auto"></a>
                <br>
                <small> جميع الحقوق محفوظة © 2023 </small>
                <br>
                <a href="index.php" class="wh"> صارحني </a> - <a href="privacy.php" class="wh"> الخصوصية </a> - <a href="terms.php" class="wh"> القوانين </a> - <a href="contact.php" class="wh"> اتصل بنا </a> <img src="assets/img/sarhne-footer.png" width="20" alt="2021">
                <br> <br> </center> </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/alerty.js"></script>
    <script src="assets/js/func.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/toast.js"></script>

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


        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-117429964-1');
    </script>
    <style>
        h1 {
            color: #f1776c;
        }
    </style>
    </body>

    </html>