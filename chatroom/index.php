<html>
    <head>
        <title>Big Chat</title>
        <link rel="stylesheet" href="chat.css">
    </head>
    <body>
        <iframe name="targeted" style="display:none;"></iframe>
        
        <div id="textdiv" class="messages">
            <p id=text>
            </p>
        </div>
        
        <form id="styledform" action="<?=$_SERVER['PHP_SELF']?>" method = "POST" target="targeted">
            <p>Username:</p><input id="uname" type="text" name="username">  <p>Message:</p> <textarea id="message" name="message"></textarea> <br> <input type="submit" name="submit">
        </form>
        
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
        <script>
            var $text = $("#text");
            $text.load("https://big-inc.000webhostapp.com/chatroom/messages.txt");
            var elem = document.getElementById('text');
            elem.scrollTop = elem.scrollHeight;
            setInterval(function () {
                console.log("a");
                $text.load("https://big-inc.000webhostapp.com/chatroom/messages.txt");
                elem.scrollTop = elem.scrollHeight;
            }, 400);
        </script>
    </body>
</html>
<?php
    
    $emoteReplace = [":cacospin:",":hollow:",":cheeseman:",":komodohype:",":pogchimp:"];
    $emoteLinks = ["https://coveryourselfinoil.com/b/src/1610218700061.gif",
    "https://cdn.discordapp.com/attachments/619640069854330922/798210490231816202/emote.png",
    "https://cdn.discordapp.com/attachments/619640069854330922/798210772810727484/emote.png",
    "https://static-cdn.jtvnw.net/emoticons/v2/81273/default/light/2.0",
    "https://cdn.frankerfacez.com/emoticon/492790/4"];
    
    
    
    $name = '';
    $message = '';
    if ( isset( $_POST['submit'] ) ) {
        $name = $_POST['username'];
        $message = $_POST['message'];
        
    }
    
    $fp = @fopen("./secretforum/accountdata/accounts.txt", 'r'); 
    
    function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
    
    
    if($name!=''&&$message!=''){
            $myfile = fopen("messages.txt", "a+") or die("Unable to open file!");
            
            for($x=0;$x<sizeof($emoteReplace);$x++)
            {
                if (strpos($message, $emoteReplace[$x]) !== false) {
                    $message = str_replace($emoteReplace[$x],"<img width = '20' height='20'src='".$emoteLinks[$x]."'></img>",$message);
                }
            }
            
            $txt = "<p>" . $name . ":<br>" . $message;
            
            $txt .= "</p>\n";
            fwrite($myfile, $txt);
            fclose($myfile);
    }
?>