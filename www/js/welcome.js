$(document).ready(function () {
    showWelcome();
});

function join() {
    $("#welcome-title").fadeOut('slow');
    $("#sign-in-button").fadeOut('slow');
    $("#smiley").fadeOut("slow", function () {
        // window.location.href = "https://auth.bot-chan.com?token=" + id_token;
    });
    $("#login-form").submit();
}

function showWelcome() {
    $("#spinner").fadeOut('slow', function () {
        if (window.location.hash === "#login") {
            join();
        } else {
            $("#welcome").fadeIn('slow');
        }
    });
}
