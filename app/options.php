<!DOCTYPE html>
<html>
    <head>
        <title>Command Line Options</title>
		<link rel = "stylesheet"  type = "text/css" href = "/style.css">
		<link rel = "icon" href = "/img/icon.png">
		<meta charset = "utf-8">
    </head>
    <body>
        <main>
            <h2>Command Line Options:</h2>
            <br>
            <?php
                exec ("/opt/prusa/prusa-slicer --help-fff", $output, $code);

                foreach ($output as $line)
                {
                    if (substr ($line, 0, 3) == " --")
                    {
                        echo "<br>" . $line . "<br>";
                    }
                    else if (substr ($line, -1, 1) == ":" && substr ($line, -8, -1) != "default")
                    {
                        echo "<br><h3>" . $line . "</h3><br>";
                    }
                    else
                    {
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $line . "<br>";
                    }
                }
            ?>
        </main>
    </body>
</html>