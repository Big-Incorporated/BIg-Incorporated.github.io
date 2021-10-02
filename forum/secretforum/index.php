<html>
    <head>
        <title>SECRET FORUM/SITE</title>
    </head>
    
    <body>
        
        <h2>Welcome to the secret forum!</h2>
        <p>This is a secret forum specifically for the secretest of secrety things, including
        <br>:secretspin: and insider trading!</p>
        
        <h3><a href="post.php">Post to the Secret Forum!</a></h3>
        
        
        
        <p id="messages">
            <?php
                $fp = @fopen("messages.txt", 'r'); 

                // Add each line to an array
                if ($fp) {
                   $array = explode("\n", fread($fp, filesize("messages.txt")));
                }
                //$all = fread($myfile,filesize("messages.txt"));
                //$all = explode($all,"</p>");
                $reversed= array_reverse($array);
                $poststext = implode('',$reversed);
                echo $poststext;
            ?>
        </p>
        
    </body>
    
</html>