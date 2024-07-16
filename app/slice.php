<!DOCTYPE html>
<html>
    <head>
        <title>Finished!</title>
		<link rel = "stylesheet"  type = "text/css" href = "/style.css">
		<link rel = "icon" href = "/img/icon.png">
		<meta charset = "utf-8">
    </head>
    <body>
        <main>
            <h3>Output:</h3>
            <br>
            <div class = "OutputContainer">
                <i>
                    <?php

                        if ($_SERVER ['REQUEST_METHOD'] === 'POST')
                        {      
                            $options = "";

                            if (htmlspecialchars ($_POST ["supports"]) == "on")
                            {
                                $options = $options . "--support-material ";
                            }
                            
                            $options = $options . "--fill-pattern honeycomb --fill-density " . htmlspecialchars ($_POST ["infill"]) . "% --brim-separation "  . htmlspecialchars ($_POST ["brimSeparation"]) . " --brim-width " . htmlspecialchars ($_POST ["brimWidth"]) . " " . stripslashes (htmlspecialchars ($_POST ["advanced"]));
                            exec ("/opt/prusa/prusa-slicer -g " . htmlspecialchars ($_POST ["path"]) . " --load /opt/prusa/resources/profiles/Anycubic.ini " . $options, $output, $code); 
                                
                            if ($code == 0)
                            {
                                echo "Slicing successful!<br>";
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
                </i>
            </div>
            <br><br>
            <?php
                if ($code == 0)
                {
                    echo "<a href = '/files/" . htmlspecialchars ($_POST ["gcode"]) . "' download><button class = 'Download'>Download</button></a><br>";
                    echo "<br>";
                    echo "<a href = 'index.html'><button>Home</button></a><br>";
                }
            ?>
        </main>
    </body>
</html>