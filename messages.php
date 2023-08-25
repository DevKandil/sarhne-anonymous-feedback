<?php
$pageTitle = "رسائلي | صارحني";
include "init.php";

session_start();

// echo "##### SESSION #####\n";
// echo "<pre>";
// print_r($_SESSION['user']);
// echo "</pre>";


if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_POST['do'] == 'my_messages') {


        $sort = (empty($_POST['sort_msg'])) ? 'DESC' : $_POST['sort_msg'];

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `user_id` =" . $_SESSION['user']['id'] . " AND `is_deleted` = 0 ORDER BY `messages`.`created_at` $sort");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {

            $time_ago = time_ago($message['created_at']);

?>
            <div class="timeline-centered" id="<?= $message['id'] ?>">
                <div id="dl-<?= $message['id'] ?>">

                    <article class="timeline-entry">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon bg-secondary" onclick="open_link('#');"><img src="assets/img/s-48.png" class="img_user_not_found">
                                <br><small class="white"> 0 </small>
                                <img src="assets/img/blike.svg" alt="#" style="vertical-align:middle;opacity:.70" width="18" height="auto">
                            </div>
                            <div class="timeline-label">
                                <div class="containe">

                                    <div class="right" onclick="open_link('#')">
                                        مجهول : <span class="msg_time"><?= $time_ago; ?><br> </span> </div>

                                    <div class="left" style="text-align:left;cursor: pointer;width: 30px;">
                                        <a onclick="fav('<?= $message['id'] ?>')">
                                            <img id="fav_<?= $message['id'] ?>" src="assets/img/<?= ($message['favorite'] == 1) ? 'stary.svg' : 'star.svg'; ?>" width="25" alt="*"></a>
                                    </div>

                                </div>
                                <div class="hr"></div>

                                <center style="font-size: 14px;direction: rtl;" class="kill_long_text"><?= $message['content']; ?>


                                </center>
                                <div class="hr"></div>

                                <div class="textBottom">
                                    <a id="del_<?= $message['id'] ?>" onclick="delmsg('<?= $message['id'] ?>');" class="sbutton bc-red"> <img src="assets/img/delete-button.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> حذف </a>


                                    <?php
                                    if ($message['public'] == 1 && $message['reply'] == "") { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="hidemsg('<?= $message['id'] ?>');" class="sbutton bc-green"> <img src="assets/img/hide.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أخفاء </a>
                                        <a id="reply_msg_<?= $message['id'] ?>" onclick="reply('<?= $message['id'] ?>');" class="sbutton bc-replay"> <img src="assets/img/reply.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> رد </a>
                                    <?php } elseif ($message['public'] == 1 && $message['reply'] !== "") { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="hidemsg('<?= $message['id'] ?>');" class="sbutton bc-green"> <img src="assets/img/hide.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أخفاء </a>
                                        <span class="rmsg" style="width:90%;">
                                            <figcaption>
                                                <div class="replay-title">
                                                    ردك
                                                </div>
                                                <div class="hr" style="border-bottom: .5px solid #00000030;"></div>
                                                <div class="reply-contant">
                                                    <?= $message['reply'] ?>
                                                </div>
                                                <div class="hr" style="border-bottom: .5px solid #00000030;"></div>
                                                <div style="text-align:left;">
                                                    <a onclick="delreply('<?= $message['id'] ?>');" class="btn button-border-highlight" style="cursor: pointer;"><img id="del_reply_<?= $message['id'] ?>" src="assets/img/bdel-replay.svg" width="15" height="auto" alt="#"></a>
                                                    <a onclick="edit_reply('<?= $message['id'] ?>');" class="btn button-border-highlight" style="cursor: pointer;"><img id="edit_reply_<?= $message['id'] ?>" src="assets/img/bedit-replay.svg" width="15" height="auto" alt="#"></a>
                                                </div>
                                            </figcaption>
                                        </span>
                                    <?php } else { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="showmsg('<?= $message['id'] ?>');" class="sbutton bc-blue"> <img src="assets/img/sent.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أظهار</a>
                                    <?php } ?>


                                    <div style="float: right;">
                                        <!--       <a onclick="block_user('365997434');" class="sbutton" style="color: #791c1c;opacity: .6;">  حظر ؟</a>   -->

                                    </div>




                                </div>
                            </div>
                        </div>


                    </article>
                </div>
            </div>
        <?php
        }

        exit();
    } elseif ($_POST['do'] == 'fav') {


        $sort = (empty($_POST['sort_msg'])) ? 'DESC' : $_POST['sort_msg'];

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `user_id` =" . $_SESSION['user']['id'] . " AND `favorite` = 1 AND `is_deleted` = 0 ORDER BY `messages`.`created_at` $sort");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {

            $time_ago = time_ago($message['created_at']);

        ?>
            <div class="timeline-centered" id="<?= $message['id'] ?>">
                <div id="dl-<?= $message['id'] ?>">

                    <article class="timeline-entry">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon bg-secondary" onclick="open_link('#');"><img src="assets/img/s-48.png" class="img_user_not_found">
                                <br><small class="white"> 0 </small>
                                <img src="assets/img/blike.svg" alt="#" style="vertical-align:middle;opacity:.70" width="18" height="auto">
                            </div>
                            <div class="timeline-label">
                                <div class="containe">

                                    <div class="right" onclick="open_link('#')">
                                        مجهول : <span class="msg_time"><?= $time_ago; ?><br> </span> </div>

                                    <div class="left" style="text-align:left;cursor: pointer;width: 30px;">
                                        <a onclick="fav('<?= $message['id'] ?>')">
                                            <img id="fav_<?= $message['id'] ?>" src="assets/img/<?= ($message['favorite'] == 1) ? 'stary.svg' : 'star.svg'; ?>" width="25" alt="*"></a>
                                    </div>

                                </div>
                                <div class="hr"></div>

                                <center style="font-size: 14px;direction: rtl;" class="kill_long_text"><?= $message['content']; ?>


                                </center>
                                <div class="hr"></div>

                                <div class="textBottom">
                                    <a id="del_<?= $message['id'] ?>" onclick="delmsg('<?= $message['id'] ?>');" class="sbutton bc-red"> <img src="assets/img/delete-button.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> حذف </a>


                                    <?php
                                    if ($message['public'] == 1 && $message['reply'] == "") { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="hidemsg('<?= $message['id'] ?>');" class="sbutton bc-green"> <img src="assets/img/hide.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أخفاء </a>
                                        <a id="reply_msg_<?= $message['id'] ?>" onclick="reply('<?= $message['id'] ?>');" class="sbutton bc-replay"> <img src="assets/img/reply.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> رد </a>
                                    <?php } elseif ($message['public'] == 1 && $message['reply'] !== "") { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="hidemsg('<?= $message['id'] ?>');" class="sbutton bc-green"> <img src="assets/img/hide.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أخفاء </a>
                                        <span class="rmsg" style="width:90%;">
                                            <figcaption>
                                                <div class="replay-title">
                                                    ردك
                                                </div>
                                                <div class="hr" style="border-bottom: .5px solid #00000030;"></div>
                                                <div class="reply-contant">
                                                    <?= $message['reply'] ?>
                                                </div>
                                                <div class="hr" style="border-bottom: .5px solid #00000030;"></div>
                                                <div style="text-align:left;">
                                                    <a onclick="delreply('<?= $message['id'] ?>');" class="btn button-border-highlight" style="cursor: pointer;"><img id="del_reply_<?= $message['id'] ?>" src="assets/img/bdel-replay.svg" width="15" height="auto" alt="#"></a>
                                                    <a onclick="edit_reply('<?= $message['id'] ?>');" class="btn button-border-highlight" style="cursor: pointer;"><img id="edit_reply_<?= $message['id'] ?>" src="assets/img/bedit-replay.svg" width="15" height="auto" alt="#"></a>
                                                </div>
                                            </figcaption>
                                        </span>
                                    <?php } else { ?>
                                        <a id="show_msg_<?= $message['id'] ?>" onclick="showmsg('<?= $message['id'] ?>');" class="sbutton bc-blue"> <img src="assets/img/sent.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> أظهار</a>
                                    <?php } ?>


                                    <div style="float: right;">
                                        <!--       <a onclick="block_user('365997434');" class="sbutton" style="color: #791c1c;opacity: .6;">  حظر ؟</a>   -->

                                    </div>




                                </div>
                            </div>
                        </div>


                    </article>
                </div>
            </div>
        <?php
        }

        exit();
    } elseif ($_POST['do'] == 'my_send') {


        $sort = (empty($_POST['sort_msg'])) ? 'DESC' : $_POST['sort_msg'];

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `sender_id` =" . $_SESSION['user']['id'] . " AND `is_deleted` = 0 ORDER BY `messages`.`created_at` $sort");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {

            $time_ago = time_ago($message['created_at']);

            $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = :zreceiver");
            $stmt->bindParam(":zreceiver", $message['user_id']);
            $stmt->execute();
            $receiver_user = $stmt->fetch(PDO::FETCH_ASSOC);


            $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = :zsender");
            $stmt->bindParam(":zsender", $message['sender_id']);
            $stmt->execute();
            $sender_user = $stmt->fetch(PDO::FETCH_ASSOC);

        ?>

            <div class="timeline-centered" id="<?= $message['id'] ?>">
                <div id="dl-<?= $message['id'] ?>">
                    <article class="timeline-entry">
                        <div class="timeline-entry-inner">
                            <div class="timeline-icon bg-secondary" style="cursor: pointer;" onclick="open_link('<?= $receiver_user['username'] ?>');">
                                <img src="assets/img/<?= ($receiver_user['profile_pic'] !=='') ? 'profile-images/'.$receiver_user['profile_pic'] : "male-avatar.svg"; ?>" class="img_user_found">
                            </div>
                            <div class="timeline-label">
                                <div class="containe">
                                    <div class="right" style="cursor: pointer;" onclick="open_link('<?= $receiver_user['username'] ?>')">
                                        الى : <?= $receiver_user['name'] ?> <span class="msg_time"><?= $time_ago; ?><br> </span> </div>
                                </div>
                                <div class="hr"></div>
                                <center style="font-size: 14px;direction: rtl;" class="kill_long_text"><?= $message['content']; ?></center>
                                <div class="hr"></div>
                                <div class="textBottom">
                                    <a id="del_send_<?= $message['id'] ?>" onclick="delsend('<?= $message['id'] ?>');" class="sbutton bc-red">
                                        <img src="assets/img/delete-button.svg" width="15" height="auto" alt="#" style="vertical-align:middle;"> ألغاء الأرسال </a>
                                    <span class="seen"><?= ($message['seen']) ? " تمت مشاهدة الرسالة " : " لم تشاهد الرسالة بعد"; ?> <img src="assets/img/<?= ($message['seen']) ? "seen.svg" : "not_seen.svg"; ?>" width="14" alt="*" class="middle"> </span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            
<?php
        }

        exit();
    } elseif ($_POST['do'] == 'delmsg') {

        $stmt = $con->prepare("UPDATE `messages` SET is_deleted = 1 WHERE id = ?");
        $stmt->execute(array($_POST['id']));
        if ($stmt->rowCount() > 0) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit();
    } elseif ($_POST['do'] == 'fav') {

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `id` = ?");
        $stmt->execute([$_POST['id']]);
        $message = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($message['favorite'] == 0) {
            $stmt = $con->prepare("UPDATE `messages` SET favorite = 1 WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            if ($stmt->rowCount() > 0) {
                echo 'true';
            }
        } else {
            $stmt = $con->prepare("UPDATE `messages` SET favorite = 0 WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            if ($stmt->rowCount() > 0) {
                echo 'false';
            }
        }

        exit();
    } elseif ($_POST['do'] == 'showmsg') {

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `id` = ?");
        $stmt->execute([$_POST['id']]);
        $message = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($message['public'] == 0) {
            $stmt = $con->prepare("UPDATE `messages` SET public = 1 WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            if ($stmt->rowCount() > 0) {
                echo 'true';
            }
        }

        exit();
    } elseif ($_POST['do'] == 'hidemsg') {

        $stmt = $con->prepare("SELECT * FROM `messages` WHERE `id` = ?");
        $stmt->execute([$_POST['id']]);
        $message = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($message['public'] == 1) {
            $stmt = $con->prepare("UPDATE `messages` SET public = 0 WHERE id = ?");
            $stmt->execute(array($_POST['id']));
            if ($stmt->rowCount() > 0) {
                echo 'true';
            }
        }

        exit();
    } elseif ($_POST['do'] == 'reply') {

        $stmt = $con->prepare("UPDATE `messages` SET reply = ? WHERE id = ?");
        $stmt->execute(array($_POST['value'], $_POST['id']));
        if ($stmt->rowCount() > 0) {
            echo 'true';
        }
        exit();
    } elseif ($_POST['do'] == 'edit_reply') {

        $stmt = $con->prepare("UPDATE `messages` SET reply = ? WHERE id = ?");
        $stmt->execute(array($_POST['value'], $_POST['id']));
        if ($stmt->rowCount() > 0) {
            echo 'true';
        }
        exit();
    } elseif ($_POST['do'] == 'delreply') {

        $stmt = $con->prepare("UPDATE `messages` SET reply = NULL WHERE id = :zid");
        $stmt->bindParam(":zid", $_POST['id']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo 'true';
        }
        exit();
    } elseif ($_POST['do'] == 'delsend') {

        $stmt = $con->prepare("UPDATE `messages` SET `is_deleted` = 1 WHERE sender_id = :zid");
        $stmt->bindParam(":zid", $_POST['id']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo 'true';
        }
        exit();
    }
}

include $tpl . 'header.php';

?>


<center>
    <div id="top">
        <img onclick="askimg();" style="margin-top: 10px;overflow:hidden;border-radius:50%;border: 3px #ffffff4a solid;" src="https://static.sarhne.com/sarhne.com/profile_photo/sarhny444.jpg?t=1690116757" onerror="this.onerror=null;this.src='assets/img/logo-150.png';" width="111" height="111" alt="#">
        <div class="user">
            <h3 dir="rtl">
                <?= $_SESSION['user']['name'] ?>
            </h3>
        </div>
        <span class="wh" id="sarhne-link">http://sarah-ah.com/<?= $_SESSION['user']['username'] ?></span>
        <div id="sarhne-input" class="input-group input-group-icon" dir="ltr" style="width:90%;max-width:550px;margin: 0px 5px 5px 5px;text-align:center;display:none;">
            <input onclick="select_all(this)" type="text" id="slink" style value="http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>" />
            <div class="input-icon"><i><img src="assets/img/link-form.svg" width="20" alt="*"></i></div>
        </div>
        <span class="normal_text">شارك الرابط وابدأ بتلقي الرسائل والصراحات </span>
        <span dir="rtl" style="display: block;">
            <a onclick="copylink();" class="userbutton" style="background-color:#3282b8;width:90px;border:0;"><img src="assets/img/clipboard.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> نسخ </a>
            <a id="share-btn" class="userbutton" style="background-color:#3282b8;width:90px;"><img src="assets/img/sharethis-logo.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> مشاركة </a>
            <div class="overlayb" style="display:none;" id="overlay"></div>
            <div class="share-btn clicked" id="sharedialog" style="display:none;" dir="rtl">
                <span class="cta">مشاركة</span>
                <div class="close">X</div>
                <ul class="social">
                    <center>
                        <a href="https://www.facebook.com/sharer.php?u=http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>" class="userbutton" style="background-color:#3c5898;width:90%;margin-bottom:5px;"> Facebook <img src="assets/img/share-facebook.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"></a>
                        <a href="https://wa.me/?text=%20أعطني%20رأيك%20عني%20بسرية%20تامة%20وصراحة%20http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>" class="userbutton" style="background-color:#4FCE5D;width:90%;margin-bottom:5px;"> WhastApp <img src="assets/img/share-whatsapp.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> </a>
                        <a data-modal="open" class="userbutton" style="background-color:#3F729B;width:90%;margin-bottom:5px;"> Instagram <img src="assets/img/share-insta.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"></a>
                        <a href="https://twitter.com/intent/tweet?text= أعطني رأيك عني بسرية تامة وصراحة&hashtags=صارحني&url=http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>" class="userbutton" style="background-color:#55ACEE;width:90%;margin-bottom:5px;"> Twitter <img src="assets/img/share-twitter.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> </a>
                    </center>
                </ul>
            </div>
            <div class="modal-wrapper" data-modal="wrapper">
                <div class="modal-content">
                    <div class="relative">
                        <button data-modal="close" class="btn-modal btn-close">&times;</button>
                        <div class="text">
                            <p><img src="assets/img/instaa.jpg" width="100%"></p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="help.php" class="userbutton" style="background-color:#3282b8;width:90px;">
                <img src="assets/img/question.svg" width="20" height="auto" style="vertical-align:middle;padding-right:5px;padding-top:3px;" alt="#"> تعليمات </a>
        </span>
        <br>
    </div>
    <div id="myModal" class="modal">

        <div class="modal-content">
            <span class="closem">&times;</span>
            <p>
                <img src="assets/img/instaa.jpg" width="100%">
            </p>
        </div>
    </div>
    <div class="soical_icon_messages_div">
        <div class style="direction: rtl;font-size:14px;">
            شارك الرابط الخاص بك بنقرة واحدة
        </div>
        <a href="https://www.facebook.com/sharer.php?u=http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>">
            <img src="assets/img/social/facebook_icon.svg" class="soical_icon_messages">
        </a>
        <a href="https://twitter.com/intent/tweet?text= أعطني رأيك عني بسرية تامة وصراحة&hashtags=صارحني&url=http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>">
            <img src="assets/img/social/twitter_icon.svg" class="soical_icon_messages">
        </a>
        <a href="https://wa.me/?text=%20أعطني%20رأيك%20عني%20بسرية%20تامة%20وصراحة%20 http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>">
            <img src="assets/img/social/wa_icon.svg" class="soical_icon_messages">
        </a>
        <a href="https://t.me/share/url?url=?text=%20أعطني%20رأيك%20عني%20بسرية%20تامة%20وصراحة%20 http://sarah-ah.com/<?= $_SESSION['user']['username'] ?>">
            <img src="assets/img/social/telegram.png" class="soical_icon_messages" style="border-radius: 12px;">
        </a>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closem")[0];

        // When the user clicks the button, open the modal
        // btn.onclick = function() {
        //     modal.style.display = "block";
        // }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <div id="center" style="margin-top:10px;">
        <style>
            .tabBar {
                display: table;
                table-layout: fixed;
                box-sizing: border-box;
                width: 100%;
                border-radius: 7px;
                margin-bottom: 0;
                background-color: #00000017;
                overflow: hidden;
                direction: rtl;
            }

            .tabBar a.active {
                color: #FFF;
                background-color: #2D2F31;
                border-bottom: 2px #2D2F31C9 solid;
            }

            .tabBar a {
                display: table-cell;
                vertical-align: middle;
                text-align: center;
                font-size: 12px;
                line-height: 22px;
                padding: 8px;
                color: #2D2F31C9;
            }
        </style>
        <style>
            /* The Modal (background) */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1;
                /* Sit on top */
                padding-top: 100px;
                /* Location of the box */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgb(0, 0, 0);
                /* Fallback color */
                background-color: rgba(0, 0, 0, 0.4);
                /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            /* The Close Button */
            .closem {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .closem:hover,
            .closem:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
        <div class="tabBar">
            <a onclick="tabclick('messages.php', 'my_messages', 'DESC');" id="my_messages" style="cursor: pointer;" class="active">
                <span class="f12"><i class="icofont-ui-messaging" style="font-size: 15px;"></i> رسائل واردة </span>
            </a>
            <a onclick="tabclick('messages.php', 'fav', 'DESC');" id="fav" style="cursor: pointer;" class>
                <span class="f12"><i class="icofont-favourite" style="font-size: 15px;"></i> المفضلة </span>
            </a>
            <a onclick="tabclick('messages.php', 'my_send', 'DESC');" id="my_send" style="cursor: pointer;" class>
                <span class="f12"> مرسلة <i class="icofont-paper-plane" style="font-size: 15px;"></i> </span>
            </a>
        </div>

        <!-- Message Contents  -->

        <div id="tab_contant"> <br>

            <div style="float: left;background: #e8e8e8;cursor: pointer;border-radius: 5px;padding-left: 10px;padding-right: 10px;color: #262626b3;font-size: 14px;direction: ltr;">
                <img src="assets/img/list.svg" class="middle" width="16"> <small id="del_all_messges" onclick="show_op()"> خيارات </small>


                <div id="myDropdown" class="dropdown-content text_right f12 show" style="display: none;">

                    <a style="cursor: pointer;" onclick="switch_sort();"> ترتيب الرسائل <i class="icofont-sort"></i></a>
                    <a style="cursor: pointer;" onclick="close_all();del_all_messges();"><span class="red"> حذف كل الرسائل <i class="icofont-ui-delete"></i></span></a>
                    <a style="cursor: pointer;" onclick="close_all();"> ألغاء <i class="icofont-close"></i></a>
                </div>


                <div id="sort_by" class="dropdown-content text_right f12 show" style="display: none;">

                    <a style="cursor: pointer;" onclick="switch_sort_value('DESC');"> الأحدث اولا <i class="icofont-arrow-up"></i></a>
                    <a style="cursor: pointer;" onclick="switch_sort_value('ASC');"> الأقدم اولا <i class="icofont-arrow-down"></i></a>
                    <a style="cursor: pointer;" onclick="close_all();"> ألغاء <i class="icofont-close"></i></a>
                </div>



                <script>
                    function switch_sort() {
                        $("#myDropdown").hide();
                        $("#sort_by").show();
                    }

                    function switch_sort_value(v) {
                        sort_msg = v;
                        // alert(sort_msg);
                        tabclick('messages.php', 'my_messages', sort_msg);

                    }

                    function show_op() {
                        $("#myDropdown").show();

                    }

                    function close_all() {
                        $("#myDropdown").hide();
                        $("#sort_by").hide();
                    }
                </script>

                <style>
                    .dropdown-content {
                        display: none;
                        position: absolute;
                        background-color: #fff;
                        min-width: 160px;
                        overflow: auto;
                        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                        z-index: 1;
                        text-align: right;
                    }


                    .dropdown-content a {
                        color: black;
                        padding: 12px 16px;
                        text-decoration: none;
                        display: block;
                    }
                </style>

            </div>


            <div style="float: right;direction: ltr;">

                <?php
                $stmt = $con->prepare("SELECT * FROM `messages` WHERE `user_id` =" . $_SESSION['user']['id'] . " AND `is_deleted` = 0");

                $stmt->execute();

                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $num_of_messages = count($messages);
                ?>
                <span> <?= $num_of_messages; ?> : الرسائل </span>
            </div>
            <div style="clear:both;margin-bottom: 10px;"></div>

            <div id="posts_results">

            </div>





            <script>
                // function loade_more() {
                //     var last_id = $('.timeline-centered:last').attr('id');

                //     disabled_button();
                //     $.ajax({
                //         type: 'POST',
                //         url: 'ajax/messages/fetch_messages.html',
                //         data: 'last_id=' + last_id + '&sort=' + sort_msg,
                //         success: function(res) {

                //             activebutton();
                //             if (res == 'nomore') {
                //                 $('#send_button').hide();
                //                 nativeToast({
                //                     message: ' تم عرض جميع الرسائل ',
                //                     type: 'success',
                //                     position: 'center'
                //                 })
                //             } else {
                //                 $('#posts_results').append(res);
                //             }


                //         },
                //         error: function(request, status, error) {
                //             document.getElementById('send_button').disabled = false;
                //             $('#send_button').html('<img src="assets/img/loader.svg" alt="#" style="vertical-align:middle;" width="22" height="auto"> أعادة المحاولة  ');
                //             server_erorr();
                //         }
                //     });

                // }





                function activebutton() {
                    document.getElementById('send_button').disabled = false;
                    $('#send_button').html('<img src="assets/img/scroll_down.gif" alt="#" style="vertical-align:middle;" width="22" height="auto"> عرض المزيد من الرسائل ');
                }

                function disabled_button() {
                    document.getElementById('send_button').disabled = true;
                    $('#send_button').html('  انتظر من فضلك <img src="assets/img/loading.svg" width="27" class="middle" alt="#"> ');

                }
            </script>

        </div> <!-- end tab content -->

        <!-- End Messages Contents -->


    </div> <br>
    <div class="box" dir="rtl">
        <div class="logo">
            <h3 style="    color: #f0786c;
    font-size: 35px;">
                حمل تطبيق صارحني
            </h3>
        </div>
        <img src="assets/img/mobile-app.svg" width="220"> <br>
        <small>
            <font color="#000"> تابع الرسائل التي تصل لحسابك لحظة بلحظة عبر تطبيقنا للهاتف المحمول </font>
        </small> <br>
        <a href="#" title="تنزيل تطبيق صارحني جوجل بلاي" target="_blink"> <img src="assets/img/ar_badge_web_generic.png" width="140" alt="تنزيل تطبيق صارحني"> </a>
        <a href="#" title="هواوي تنزيل تطبيق صارحني" target="_blink"> <img src="assets/img/appgallery-badge-AR.png" width="140" alt="تنزيل تطبيق هواوي صارحني"> </a>
        <a href="javascript:alert('صارحني غير متاح بالوقت الحالي للأيفون')" title="تنزيل صارحني للأيفون"> <img src="assets/img/iphone-store.png" width="140" alt="تنزيل صارحني للأيفون"> </a>
    </div>


    <script src="assets/js/jquery.min.js"></script>

    <script>
        function open_link(link) {
            if (link == '#') {

            } else {
                window.location.href = link;
            }

        }

        tabclick('messages.php', 'my_messages', 'DESC');
        // var sort_msg = 'DESC';

        function tabclick(tabid, doing, sort_msg) {
            // alert(tabid);
            // alert(doing);
            // alert(sort_msg);
            $('#posts_results').html(' ');
            $('#ajax_wait').show();
            $.ajax({
                type: 'POST',
                url: tabid,
                data: {
                    do: doing,
                    sort_msg: sort_msg,
                },
                success: function(res) {
                    $('#ajax_wait').hide();
                    $('#posts_results').html(res);
                },
                error: function(request, status, error) {
                    $('#ajax_wait').hide();
                    server_erorr();
                }
            });

            if (doing.includes('my_messages')) {
                $('#my_messages').removeClass("active");
                $('#my_send').removeClass("active");
                $('#fav').removeClass("active");
                $('#my_messages').addClass("active");
            } else if (doing.includes('my_send')) {
                $('#my_messages').removeClass("active");
                $('#my_send').removeClass("active");
                $('#fav').removeClass("active");
                $('#my_send').addClass("active");
            } else if (doing.includes('fav')) {
                $('#my_messages').removeClass("active");
                $('#my_send').removeClass("active");
                $('#fav').removeClass("active");
                $('#fav').addClass("active");
            }



        }


        $('#share-btn').click(function() {
            document.getElementById("sharedialog").style.display = "block";
            document.getElementById("overlay").style.display = "block";

        });

        $('.close').click(function(e) {
            document.getElementById("sharedialog").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        });

        function screenClass() {
            if ($(window).innerWidth() > 1200) {
                $('.tabs').hide();
                $('.nav').show();
            } else {
                $('.nav').hide();
                $('.tabs').show();
            }
        }
        screenClass();
        $(window).bind('resize', function() {
            screenClass();
        });


        var Modal = (function() {

            var modalOpen = document.querySelector('[data-modal="open"]'),
                modalClose = document.querySelector('[data-modal="close"]'),
                modalWrapper = document.querySelector('[data-modal="wrapper"]');

            return {
                init: function() {
                    this.abrir();
                    this.fechar();
                },

                abrir: function() {
                    modalOpen.onclick = function(e) {
                        e.preventDefault;
                        document.getElementById("sharedialog").style.display = "none";
                        document.getElementById("overlay").style.display = "none";
                        modalWrapper.classList.add("modal-opened");
                    }
                },

                fechar: function() {
                    modalClose.onclick = function(e) {
                        e.preventDefault;
                        modalWrapper.classList.remove("modal-opened");
                    }
                }
            }
        }());

        Modal.init();


        var show_coy_link = '0';

        function copylink() {
            if (show_coy_link == '0') {
                document.getElementById("sarhne-link").style.display = "none";
                document.getElementById("sarhne-input").style.display = "block";
                $("#top").height(390);
                alerty.alert(' تم اظهار صندوق نسخ الرابط الخاص بك , الخطوة التالية انقر فوق النص المحدد واختر نسخ , ثم اذهب الى اي تطبيق ترغب بمشاركة الرابط الخاص بك واختر لصق ', {
                    title: 'تعليمات',
                }, function() {
                    $('#slink').select();
                    $('#slink').focus();
                    $('#slink').prop('readonly', true);
                }, function() {})
                show_coy_link = '1';
            } else {
                document.getElementById("sarhne-link").style.display = "block";
                document.getElementById("sarhne-input").style.display = "none";
                $("#top").height(365);
                show_coy_link = '0';
            }

        }


        function reply(id) {

            alerty.prompt('أكتب رد على هذه الرسالة', {
                    inputType: 'text',
                    inputPlaceholder: 'ردك هنا',
                    inputValue: '',
                    inputDir: 'rtl'
                },
                function(value) {

                    if (value) {

                        $("#reply_msg_" + id).html('<img src="assets/img/ajax_clock_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;"> انتظر ');

                        $.ajax({
                            type: 'POST',
                            url: 'messages.php',
                            data: {
                                do: 'reply',
                                id: id,
                                value: value,
                            },
                            success: function(res) {
                                if (res.includes("true")) {
                                    alerty.alert(' تم أضافة الرد بنجاح سيشاهد الرد زوار الرابط الخاص بك أضغط موافق ليتم تحديث الصفحة ', {
                                            title: 'صارحني',
                                        },
                                        function() {
                                            window.location.replace("messages.php");
                                            try {
                                                setcanback('alerty');
                                            } catch (err) {}
                                        })
                                } else {
                                    $("#reply_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                                    server_erorr();
                                }


                            },
                            error: function(request, status, error) {
                                $("#reply_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                                server_erorr();
                            }
                        });

                    }
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }





        function edit_reply(id) {

            alerty.prompt('تعديل الرد على هذه الرسالة', {
                    inputType: 'text',
                    inputPlaceholder: 'أكتب هنا',
                    inputValue: '',
                    inputDir: 'rtl'
                },
                function(value) {

                    if (value) {

                        document.getElementById("edit_reply_" + id).src = "assets/img/ajax_clock_black.svg";

                        $.ajax({
                            type: 'POST',
                            url: 'messages.php',
                            data: {
                                do: 'edit_reply',
                                id: id,
                                value: value,
                            },
                            success: function(res) {
                                if (res.includes("true")) {
                                    alerty.alert(' تم تعديل الرد بنجاح أضغط موافق ليتم تحديث الصفحة ', {
                                            title: 'صارحني',
                                        },
                                        function() {
                                            window.location.replace("messages.php");
                                            try {
                                                setcanback('alerty');
                                            } catch (err) {}
                                        })
                                } else {
                                    document.getElementById("edit_reply_" + id).src = "assets/img/ajax_err_black.svg";

                                    server_erorr();
                                }


                            },
                            error: function(request, status, error) {
                                document.getElementById("edit_reply_" + id).src = "assets/img/ajax_err_black.svg";
                                server_erorr();
                            }
                        });

                    }
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                }
            )
        }


        function showmsg(id) {
            alerty.confirm(
                ' هل انت متأكد من أضهار هذه الرسالة الى العامة؟  ستكون متاحة للمشاهدة على الرابط الخاص بك', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {

                    $("#show_msg_" + id).html('<img src="assets/img/ajax_clock_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;"> انتظر ');

                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'showmsg',
                            id: id,
                        },
                        success: function(res) {
                            if (res.includes("true")) {
                                alerty.alert(' تم أضهار هذه الرسالة أضغط موافق ليتم تحديث الصفحة ', {
                                        title: 'صارحني',
                                    },
                                    function() {
                                        window.location.replace("messages.php");
                                        try {
                                            setcanback('alerty');
                                        } catch (err) {}
                                    })
                                try {
                                    setcanback('alerty');
                                } catch (err) {}
                            } else {
                                $("#show_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            }
                        },
                        error: function(request, status, error) {
                            $("#show_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            server_erorr();
                        }
                    });

                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }


        function hidemsg(id) {
            alerty.confirm(
                ' هل انت متأكد من أخفاء هذه الرسالة من العرض على الرابط الخاص بك؟  ', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {

                    $("#show_msg_" + id).html('<img src="assets/img/ajax_clock_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;"> انتظر ');

                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'hidemsg',
                            id: id,
                        },
                        success: function(res) {
                            if (res.includes("true")) {
                                alerty.alert(' تم أخفاء هذه الرسالة عن العرض , أضغط موافق ليتم تحديث الصفحة ', {
                                        title: 'صارحني',
                                    },
                                    function() {
                                        window.location.replace("messages.php");
                                        try {
                                            setcanback('alerty');
                                        } catch (err) {}
                                    })
                                try {
                                    setcanback('alerty');
                                } catch (err) {}
                            } else {
                                $("#show_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            }
                        },
                        error: function(request, status, error) {
                            $("#show_msg_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            server_erorr();
                        }
                    });




                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }




        function delsend(id) {
            alerty.confirm(
                ' سيتم حذف هذه المصارحة من رسائل المستلم هل ترغب بالأستمرار ؟  ', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {
                    $("#del_send_" + id).html('<img src="assets/img/ajax_clock_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;"> انتظر ');
                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'delsend',
                            id: id,
                            sender_id: "<?= $_SESSION['user']['id'] ?>",
                        },
                        success: function(res) {
                            if (res.includes("true")) {
                                $('#' + id).hide(1000);
                                nativeToast({
                                    message: ' تم أزالة هذه المصارحة لديك ولدى المستلم ',
                                    type: 'info',
                                    position: 'top'
                                })
                            } else {
                                $("#del_send_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            }
                        },
                        error: function(request, status, error) {
                            $("#del_send_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            server_erorr();
                        }
                    });
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }






        function delmsg(id) {
            alerty.confirm(
                ' هل انت متأكد من حذف هذه الرسالة ؟  ', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {
                    $("#del_" + id).html('<img src="assets/img/ajax_clock_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;"> انتظر ');
                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'delmsg',
                            id: id,
                        },
                        success: function(res) {
                            if (res.includes("true")) {
                                $("#dl-" + id).hide(1000);
                            } else {
                                $("#del_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            }
                        },
                        error: function(request, status, error) {
                            $("#del_" + id).html('<img src="assets/img/ajax_err_white.svg" width="20" height="auto" alt="#" style="vertical-align:middle;">');
                            server_erorr();
                        }
                    });
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }


        function del_all_messges(id) {
            alerty.confirm(
                ' هل انت متأكد من حذف كل الرسائل لايمكن التراجع عن هذا القرار ؟  ', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {
                    $('#del_all_messges').html('<img src="assets/img/ajax_clock_black.svg" width="20">');
                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'del_all_messges',
                        },
                        success: function(res) {
                            if (res.includes("true")) {

                                alerty.alert(' تم حذف كل الرسائل بنجاح , أضغط موافق ليتم تحديث الصفحة ', {
                                        title: 'صارحني',
                                    },
                                    function() {
                                        window.location.replace("messages.php");
                                        try {
                                            setcanback('alerty');
                                        } catch (err) {}
                                    })
                                try {
                                    setcanback('alerty');
                                } catch (err) {}


                            } else {
                                $('#del_all_messges').html('<img src="assets/img/ajax_err_black.svg" width="20">');

                            }
                        },
                        error: function(request, status, error) {
                            $('#del_all_messges').html('<img src="assets/img/ajax_err_black.svg" width="20">');
                            server_erorr();
                        }
                    });
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }


        function delreply(id) {
            alerty.confirm(
                ' هل انت متأكد من حذف هذه الرسالة ؟  ', {
                    title: ' تأكيد ',
                    cancelLabel: 'لا',
                    okLabel: 'نعم'
                },
                function() {
                    document.getElementById("del_reply_" + id).src = "assets/img/ajax_clock_black.svg";
                    $.ajax({
                        type: 'POST',
                        url: 'messages.php',
                        data: {
                            do: 'delreply',
                            id: id,
                        },
                        success: function(res) {
                            if (res.includes("true")) {

                                alerty.alert(' تم حذف الرد بنجاح , أضغط موافق ليتم تحديث الصفحة ', {
                                        title: 'صارحني',
                                    },
                                    function() {
                                        window.location.replace("messages.php");
                                        try {
                                            setcanback('alerty');
                                        } catch (err) {}
                                    })
                                try {
                                    setcanback('alerty');
                                } catch (err) {}


                            } else {
                                document.getElementById("del_reply_" + id).src = "assets/img/ajax_err_black.svg";
                            }
                        },
                        error: function(request, status, error) {
                            document.getElementById("del_reply_" + id).src = "assets/img/ajax_err_black.svg";
                            server_erorr();
                        }
                    });
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                },
                function() {
                    try {
                        setcanback('alerty');
                    } catch (err) {}
                })
        }



        function fav(id) {
            document.getElementById("fav_" + id).src = "assets/img/loader.svg";


            $.ajax({
                type: 'POST',
                url: 'messages.php',
                data: {
                    do: 'fav',
                    id: id
                },
                success: function(res) {

                    if (res.includes("true")) {
                        document.getElementById("fav_" + id).src = "assets/img/stary.svg";
                        nativeToast({
                            message: ' تم أضافة هذه الرسالة الى المفضلة ',
                            type: 'success',
                            position: 'center'
                        })

                    } else if (res.includes("false")) {
                        document.getElementById("fav_" + id).src = "assets/img/star.svg";
                        nativeToast({
                            message: ' تم أزالة هذه الرسالة من المفضلة ',
                            type: 'success',
                            position: 'center'
                        })
                    }


                },
                error: function(request, status, error) {
                    document.getElementById("fav_" + id).src = "assets/img/ajax_err.svg";
                    server_erorr();
                }
            });







        }


        try {
            clearhistory();
        } catch (err) {

        }










        var connected = false;
        const RETRY_INTERVAL = 2500;
        var timeout;
        // var socket = io.connect('https://ws.sarhne.com/', {
        //     transports: ['websocket']
        // });

        // socket.on('connect', function() {
        //     connected = true;
        //     clearTimeout(timeout);
        //     socket.emit('join_update', {
        //         room: 'sarhny444'
        //     });
        //     console.log("connects");
        // });

        // socket.on('disconnect', function() {
        //     connected = false;
        //     retryConnectOnFailure(RETRY_INTERVAL);
        // });

        // var retryConnectOnFailure = function(retryInMilliseconds) {
        //     setTimeout(function() {
        //         if (!connected) {
        //             socket.connect();
        //             retryConnectOnFailure(retryInMilliseconds);
        //         }
        //     }, retryInMilliseconds);
        // }


        // socket.on('get_update', function(data) {
        //     var ty = data.ty;
        //     if (ty.includes("new_msg")) {

        //         alerty.confirm(
        //             ' وصلتك رسالة جديدة الى حسابك , هل ترغب بتحديث الصفحة لمشاهدتها ؟  ', {
        //                 title: ' تأكيد ',
        //                 cancelLabel: 'لا',
        //                 okLabel: 'نعم'
        //             },
        //             function() {
        //                 location.href = 'https://www.sarhne.com/messages.html';
        //                 try {
        //                     setcanback('alerty');
        //                 } catch (err) {}
        //             },
        //             function() {
        //                 try {
        //                     setcanback('alerty');
        //                 } catch (err) {}
        //             })

        //     }


        // })









        (function() {

            var dardacham = $(".fadingm");
            var dardachaIndexm = -1;

            function showNextm() {
                ++dardachaIndexm;
                dardacham.eq(dardachaIndexm % dardacham.length)
                    .fadeIn(1000)
                    .delay(1000)
                    .fadeOut(1000, showNextm);
            }

            showNextm();

        })();
    </script>



    <?php include "includes/templates/footer.php"; ?>