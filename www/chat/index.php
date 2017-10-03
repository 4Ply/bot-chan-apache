<?php
include_once('../config.php');
include_once('../php/utils.php');
include_once('../php/header_util.php');
require_once '../php/login.php';

?>
<!DOCTYPE html>
<html xmlns="">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/palette.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/chat.css">

    <title>Bot-chan | Chat</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=0.6, maximum-scale=1.0, user-scalable=0'/>

    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/loadingoverlay.min.js"></script>
    <script src="../js/loadingoverlay_progress.min.js"></script>
    <script src="../js/progress_helper.js"></script>
</head>

<body>

<?php
body_header();
?>

<div class="container">
    <form onsubmit="sendMessage(); return false;">
        <input id="message-input" placeholder="Send a message" value="" autocomplete="false">
    </form>

    <h5>Message History</h5>
    <div id="message-container" class="row">

    </div>
</div>

<script type="application/javascript">
    function sendMessage() {
        var messageInput = document.getElementById('message-input');
        if (messageInput.value === '') {
            return;
        }
        showProgress();
        $.get("send_message.php?message=" + messageInput.value, function () {
            hideProgress();
        });
        messageInput.value = '';
    }

    $(document).ready(function () {
        setTimeout("getMessages()", 1000);
    });

    function getMessages() {
        $.get("history.php", function (messages) {
            $("#message-container").html(messages);
            setTimeout("getMessages()", 1000);
        });
    }
</script>
</body>
