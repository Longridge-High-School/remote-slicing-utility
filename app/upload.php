<!DOCTYPE html>
<html>
    <head>
        <title>Processing your File...</title>
		<link rel = "stylesheet"  type = "text/css" href = "/style.css">
		<link rel = "icon" href = "/img/icon.png">
		<meta charset = "utf-8">
    </head>
    <body>
        <div class = "ProcessContainer">
            <img src = "/img/spin.gif" alt = "Processing..." class = "Spin"></img>
            <p><b>Slicing your model...</p></b>
        </div>
        <?php

            if ($_SERVER ['REQUEST_METHOD'] === 'POST')
            {
                $path = "/var/www/html/files/" . time () . "-" . htmlspecialchars (basename ($_FILES ["uploadFile"]["name"]));
                $gcode = time () . "-" . substr (basename ($_FILES ["uploadFile"]["name"]), 0, -3) . "gcode";

                if (move_uploaded_file ($_FILES ["uploadFile"]["tmp_name"], $path))
                {
                    echo "<form name = 'data' action = '/slice.php' method = 'POST'>";
                    echo "<input type = 'hidden' name = 'path' value = '" . $path . "'/>";
                    echo "<input type = 'hidden' name = 'gcode' value = '" . $gcode . "'/>";
                    echo "</form>";
                    echo "<script type = 'text/javascript'>document.data.submit ();</script>";
                }
                else
                {
                    echo "<script type = 'text/javascript'>alert ('Sorry, there was an error uploading your file.');window.location.replace ('/index.html');</script>";
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