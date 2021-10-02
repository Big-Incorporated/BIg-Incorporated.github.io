<html>
    <head>
        <title>Post to the forum!</title>
    </head>
    
    <body>
        
        <h2>Post to the forum!</h2>
        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
            <p>Display name:</p>
            <input type="text" name="username"/>
            <p>Message:</p>
            <input type="text" name="message"/>
            <p>Image/video link to attach:</p>
            <input type="text" name="image"/>
            <input type="submit" name="submit">
        </form>
        <a href = "./BRUH" style="position: absolute;left: 1000px;top: 640px;"><img width='5' height='5' src="https://www.solidbackgrounds.com/images/1680x1050/1680x1050-ghost-white-solid-color-background.jpg"></img></a>
        
        <p>
            list of emotes: :cacospin:, :hollow:, :cheeseman:, :komodohype:, :secretspin:
        </p>
        
        <a href="https://big-inc.000webhostapp.com/forum/secretforum">Back to the forum!</a>
        
    </body>
    
</html>
<?php
    
    $emoteReplace = [":cacospin:",":hollow:",":cheeseman:",":komodohype:",":secretspin:"];
    $emoteLinks = ["https://coveryourselfinoil.com/b/src/1610218700061.gif",
    "https://cdn.discordapp.com/attachments/619640069854330922/798210490231816202/emote.png",
    "https://cdn.discordapp.com/attachments/619640069854330922/798210772810727484/emote.png",
    "https://static-cdn.jtvnw.net/emoticons/v2/81273/default/light/2.0",
    "https://media1.giphy.com/media/gLWFIctRy4elNhTmvm/giphy.gif"];
    
    
    
    $name = '';
    $message = '';
    if ( isset( $_GET['submit'] ) ) {
        $name = $_GET['username']; 
        $message = $_GET['message'];
        $image = $_GET['image'];
        
    }
    if($name != '' && $message != ''){
            for($x=0;$x<sizeof($emoteReplace);$x++)
            {
                if (strpos($message, $emoteReplace[$x]) !== false) {
                    $message = str_replace($emoteReplace[$x],"<img width = '15' height='15'src='".$emoteLinks[$x]."'></img>",$message);
                }
            }
            $myfile = fopen("messages.txt", "a+") or die("Unable to open file!");
            $txt = "<p style='border:3px; border-style:solid; border-color:#FF0000; padding: 1em;'>" .$name . ": <br> " . $message . "<br>";
            if($image != '')
            {
                $img = "<img src =" . $image . "></img>";
                $txt.= $img;
            }
            $txt .= "</p>\n";
            fwrite($myfile, $txt);
            fclose($myfile);
    }
?>
