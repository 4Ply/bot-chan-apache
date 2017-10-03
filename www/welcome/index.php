<!DOCTYPE html>
<html>

<head>
    <title>Bot-chan | At your service.</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" type="text/css" href="../css/palette.css">
    <link rel="stylesheet" type="text/css" href="../css/welcome.css">
    <link rel="stylesheet" type="text/css" href="../css/font.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name='viewport' content='width=device-width, initial-scale=0.7, maximum-scale=1.0, user-scalable=0' />
    <meta name="google-signin-client_id"
          content="914669485111-da1dk2lhmsir5do7o6v47jmvkb3mue58.apps.googleusercontent.com">

    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id"
          content="914669485111-tii33g4mm98bc4cjur6dscm4lkbottcp.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>

<div id="spinner" class="container">

</div>

<div id="welcome" class="container" hidden>
    <div>
        <h1>
            <span id="welcome-title" class="h1 header red-text">I am a bot</span>
            <span id="smiley" class="smiley header orange-text"> :)</span>
        </h1>
    </div>

    <div id="google-sign-in-button" class="g-signin2" data-onsuccess="onSignIn" data-onerror="onSingInFail"
         data-theme="dark"></div>

    <form id="login-form" action="https://auth.bot-chan.com" method="post">
        <a id="sign-in-button" class="waves-effect waves-light btn red" style="display: none;" onclick="join()">Use
            me</a>
        <input type="hidden" id="token" name="token"/>
    </form>
</div>

<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/material.spinner.min.js"></script>
<script type="text/javascript" src="../js/ui.js"></script>
<script type="text/javascript" src="../js/welcome.js"></script>

<script>
    function onSingInFail() {
        console.log("Errr");
    }

    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        $("#token").val(id_token);

        $("#google-sign-in-button").hide();
        $("#sign-in-button").show();
    }
</script>

</body>
</html>
