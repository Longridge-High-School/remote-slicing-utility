<!DOCTYPE html>
<html>
    <body>
        <?php

            if ($_SERVER ['REQUEST_METHOD'] === 'POST')
            {
                $path = "/var/www/html/files/" . time () . "-" . htmlspecialchars (basename ($_FILES ["uploadFile"]["name"]));

                if (move_uploaded_file ($_FILES ["uploadFile"]["tmp_name"], $path))
                {
                    echo "<br>The file " . htmlspecialchars (basename ($_FILES ["uploadFile"]["name"])) . " has been uploaded.<br>";
                    
                    exec ("/opt/prusa/prusa-slicer -g " . $path . " --load /opt/prusa/resources/profiles/Anycubic.ini", $output, $code); 
                    
                    if ($code == 0)
                    {
                        echo "Slicing successful!<br>";
                        echo "<a href = '/files/" . time () . "-" . substr (basename ($_FILES ["uploadFile"]["name"]), 0, -3) . "gcode'>Download</a><br>";
                        echo "<a href = 'index.html'>Home</a><br>";
                    }
                    else
                    {
                        echo "Slicing failed.<br>";

                        if (count ($output) > 0)
                        {
                            foreach ($output as $line)
                            {
                                echo $line . "<br>";
                            }
                        }
                    }
                }
                else
                {
                    echo "Sorry, there was an error uploading your file.";
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