<?php
include_once('../config.php');
include_once('../php/utils.php');
include_once('../php/header_util.php');
require_once '../php/provider.php';
require_once '../php/login.php';

?>
<!DOCTYPE html>
<html xmlns="">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/palette.css">
    <link rel="stylesheet" href="../css/music.css">

    <title>Bot-chan | Music</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name='viewport' content='width=device-width, initial-scale=0.7, maximum-scale=0.7, user-scalable=0' />

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
    <form onsubmit="play(); return false;">
        <input id="song-input" placeholder="Play a song" value="" autocomplete="off" onkeyup="filter()">
        <h6 id="last-message" class="grey-text"></h6>
        <input type="submit" class="music-stop btn red" value="STOP" onmousedown="stopPlayback()"/>
        <input type="submit" class="music-right btn orange" value="SKIP" onmousedown="skipTrack()"/>
    </form>

    <br/>
    <div id="music-container">

    </div>
</div>

<script type="application/javascript">
    function play() {
        var songInput = document.getElementById('song-input');
        if (songInput.value === '') {
            return;
        }
        showProgress();

        var url = "play_song.php";

        var song = songInput.value.toLowerCase();
        if (song.indexOf("youtube") !== -1 || song.indexOf("youtu.be") !== -1) {
            url = "play_youtube.php";
        }
        $.get(url + "?song=" + songInput.value, function () {
            hideProgress();
            $("input").blur();
        });
        songInput.value = '';
    }

    function stopPlayback() {
        showProgress();
        $.get("stop_playback.php", function () {
            hideProgress();
            $("input").blur();
        });
    }

    function skipTrack() {
        showProgress();
        $.get("skip_track.php", function () {
            hideProgress();
            $("input").blur();
        });
    }

    $(document).ready(function () {
        setTimeout("getLastMessage()", 1000);
    });

    function getLastMessage() {
        $.get("last_message.php", function (message) {
            $("#last-message").text(message);
            setTimeout("getLastMessage()", 1000);
        });
    }

    $(document).ready(function () {
        getMusicList();
    });

    function getMusicList() {
        $.get("list.php", function (messages) {
            $("#music-container").html(messages);
        });
    }

    function playSong(song) {
        showProgress();
        $.get("play_song.php?song=" + song, function () {
            hideProgress();
            $("input").blur();
        });
    }

    function filter() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("song-input");
        filter = input.value.toUpperCase();
        table = document.getElementById("music-list-table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
</body>
