<?php

function add_reply_scripts() {
    ?>
    <script type="application/javascript">
        $(document).ready(function () {
            getReplies();
        });

        function getReplies() {
            $.get("replies.php", function (messages) {
                var lines = messages.split('\n');
                for (var i = 0; i < lines.length; i++) {
                    var message = lines[i];
                    if (message !== "") {
                        var $toastContent = $('<span>' + message + '</span>').add($('<button class="btn-flat toast-action" onclick="$(this).parent().remove();">DISMISS</button>'));
                        Materialize.toast($toastContent, 3000);
                    }
                }
            });

            setTimeout("getReplies()", 1000);
        }
    </script>
    <?php
}
