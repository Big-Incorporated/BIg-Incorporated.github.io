<html>
    <head>
        <title>BIG FORUM</title>
        <link rel='stylesheet' href='forum.css'></link>
    </head>
    
    <body>
        
        <p style="font-size:35px;text-align:center;color:white;">
            Welcome to Big Forum! <br><br>
            <button style ="margin-left: auto;
  margin-right: auto; border:none; font-size:20px;font-family:Georgia,serif;" onclick="location.href = 'post.php';">Post to the forum!</button>
        </p>
        <p id="messages">
            <?php
                $fp = @fopen("test.txt", 'r'); 
                // Add each line to an array
                if ($fp) {
                   $array = explode("\n", fread($fp, filesize("test.txt")));
                }
                $reversed= array_reverse($array);
                
                $emoteReplace = [":troll:",":hollow:",":cheeseman:",":komodohype:",":pogchimp:"];
                $emoteLinks = ["https://cdn.discordapp.com/emojis/800242651285815326.png",
                "https://cdn.discordapp.com/attachments/619640069854330922/798210490231816202/emote.png",
                "https://cdn.discordapp.com/attachments/619640069854330922/798210772810727484/emote.png",
                "https://static-cdn.jtvnw.net/emoticons/v2/81273/default/light/2.0",
                "https://cdn.frankerfacez.com/emoticon/492790/4"];
                
                $pfp = "";
                $border = "black";
                $name = "unnamed";
                $message = "";
                $image = "";
                
                $poststext = "";
                
                for($x = 0; $x < sizeof($array)-8; $x+=9)
                {
                    $pfp = $array[$x+1];
                    $name = $array[$x+2];
                    $border = $array[$x+3];
                    $message = "";
                    $z = 5;
                    while(trim($array[$x+$z])!= "]")
                    {
                        $message .= "<br>".$array[$x+$z];
                        $z++;
                    }
                    $image = $array[$z+$x+1];
                    
                    for($y = 0; $y < sizeof($emoteReplace);$y++)
                    {
                        $message = str_replace($emoteReplace[$y],"<img width = '15' height='15'src='".$emoteLinks[$y]."'></img>",$message);
                    }
                    if($image != "")
                    {
                        $imgtype = pathinfo($image, PATHINFO_EXTENSION);
                        print($imgtype);
                        if(trim($imgtype) != "mp4")
                        {
                            $image = "<img src =" . $image . "></img>";
                        }
                        if(trim($imgtype) == "mp4")
                        {
                            $image = 
                            "<video width='320' src=".$image." height='240' autoplay muted controls>
                                Your browser does not support the video tag.
                            </video>";
                        }
                        $temptext = "<div class='post' style='border-style:solid;border-width:3px;border-color:".$border.";padding:0.2em;'><p><b> <img height='16px' width='16px'src='".$pfp."'>  ".$name . ":</b><br><p style='position:relative; left:24px;'>".$message."</p>".$image."</p></div><br>";
                        $poststext = $temptext.$poststext;
                    }
                    else
                    {
                        $temptext =  "<div class='post' style='border-style:solid;border-width:3px;border-color:".$border.";padding:0.2em;'><p><b> <img height='16px' width='16px'src='".$pfp."'>  ".$name . ":</b><br><p style='position:relative; left:24px;'>".$message."</p>"."</p></div><br>";
                        $poststext = $temptext.$poststext;
                    }
                    
                }
                echo $poststext;
            ?>
        </p>
        
    </body>
    
</html>