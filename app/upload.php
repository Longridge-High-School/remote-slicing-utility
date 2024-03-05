<!DOCTYPE html>
<html>
    <body>
        <?php

            if ($_SERVER ['REQUEST_METHOD'] === 'POST')
            {
                $path = "/var/www/html/files/" . time () . "-" . htmlspecialchars (basename ($_FILES ["uploadFile"]["name"]));
                $gcode = time () . "-" . substr (basename ($_FILES ["uploadFile"]["name"]), 0, -3) . "gcode";

                if (move_uploaded_file ($_FILES ["uploadFile"]["tmp_name"], $path))
                {
                    echo "<form name = 'data' action = '/slice.php' method = 'POST'>
                    <include type = 'hidden' name = 'path' value = '" . $path . "'>
                    <include type = 'hidden' name = 'gcode' value = '" . $gcode . "'>
                    </form>
                    <script type = 'text/javascript'>
                    document.data.submit ();
                    </script>";
                }
                else
                {
                    echo "<script type = 'text/javascript'>
                    alert ('Sorry, there was an error uploading your file.');
                    window.location.replace ('/index.html');
                    </script>";
                }
            }
            else
            {
                // Redirect if someone GETs this page.
                header ("/index.html");
            }

        ?>
    </body>
</html>