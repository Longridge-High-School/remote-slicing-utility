<!DOCTYPE html>
<html>
    <body>
        <?php

            if ($_SERVER ['REQUEST_METHOD'] === 'POST')
            {        
                exec ("/opt/prusa/prusa-slicer -g " . htmlspecialchars ($_POST ["path"]) . " --load /opt/prusa/resources/profiles/Anycubic.ini", $output, $code); 
                    
                if ($code == 0)
                {
                    echo "Slicing successful!<br>";
                    echo "<a href = '/files/" . htmlspecialchars ($_POST ["gcode"]) . "'>Download</a><br>";
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
                // Redirect if someone GETs this page.
                header ("/index.html");
            }

        ?>
    </body>
</html>