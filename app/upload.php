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

                    if (htmlspecialchars ($_POST ["supports"]) == "on")
                    {
                        echo "<input type = 'hidden' name = 'supports' value = '" . htmlspecialchars ($_POST ["supports"]) . "'/>";
                    }
                    else
                    {
                        echo "<input type = 'hidden' name = 'supports' value = 'off'/>";
                    }

                    echo "<input type = 'hidden' name = 'infill' value = '" . htmlspecialchars ($_POST ["infill"]) . "'/>";
                    echo "<input type = 'hidden' name = 'brimSeparation' value = '" . htmlspecialchars ($_POST ["brimSeparation"]) . "'/>";
                    echo "<input type = 'hidden' name = 'brimWidth' value = '" . htmlspecialchars ($_POST ["brimWidth"]) . "'/>";
                    echo "<input type = 'hidden' name = 'advanced' value = '" . stripslashes (htmlspecialchars ($_POST ["advanced"])) . "'/>";
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