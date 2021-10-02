<html>
    <head>
        <title>Post to the forum!</title>
        <link rel="stylesheet" href="post.css">
    </head>
    
    <body>
        <div>
            <h1>Post to the forum!</h2>
            
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                <p class="inlabel">Username:</p>
                <input type="text" name="username"/>
                <p class="inlabel">Password:</p>
                <input type="text" name="passwd"/>
                <p class="inlabel">Message:</p>
                <textarea rows="8" cols="45" name="message"></textarea>
                <p class="inlabel">Image/video link and border color:</p>
                <input type="text" name="image"/>
                <input type="color" name ="border">
                <input type="submit" name="submit">
            </form>
            
            <p>
                list of emotes: :cacospin:, :hollow:, :cheeseman:, :komodohype:, :pogchimp:
            </p>
            
            <a href="https://big-inc.000webhostapp.com/forum">Back to the forum!</a>
            
        </div>
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
        $passwd = $_POST['passwd'];
        $message = $_POST['message'];
        $image = $_POST['image'];
        $border = $_POST['border'];
        
    }
    
    $fp = @fopen("./secretforum/accountdata/accounts.txt", 'r'); 
    
    function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
    // Add each line to an array
    /*
    {
    pfp
    name
    border color
    [
    message
    ]
    media attachment
    }

    */
    if ($fp) {
       $accounts = explode("\n", fread($fp, filesize("./secretforum/accountdata/accounts.txt")));
       for($x=0;$x<sizeof($accounts);$x++){
           $accounts[$x] = explode("|",$accounts[$x]);
       }
       
       $accounts=flatten($accounts);
       $passindex=0;
       $imgindex=0;
       for ($x=0;$x<sizeof($accounts);$x+=1)
       {
           if ($accounts[$x] == $name)
           {
               $passindex = $x+1;
               $imgindex = $x+2;
           }
       }
    }
    
    
    if($name!=''&&$message!=''&&in_array($name,$accounts,true)&&$accounts[$passindex]==$passwd){
            for($x=0;$x<sizeof($emoteReplace);$x++)
            {
                if (strpos($message, $emoteReplace[$x]) !== false) {
                    $message = str_replace($emoteReplace[$x],"<img width = '15' height='15'src='".$emoteLinks[$x]."'></img>",$message);
                }
            }
            $message = str_replace("<","&lt",$message);
            $message = str_replace(">","&gt",$message);
            $pfp= $accounts[$imgindex];
            $myfile = fopen("test.txt", "a+") or die("Unable to open file!");
            
            $txt = "{\n"
                    .$pfp."\n"
                    .$name."\n"
                    .$border."\n"
                    ."[\n"
                    .$message."\n"
                    ."]\n"
                    .$image."\n"
                    ."}\n";
            fwrite($myfile, $txt);
            fclose($myfile);
    }
    else if($name!=''&&$message!=''&&(!in_array($name,$accounts,true)||$accounts[$passindex]!=$passwd)){
        echo"We can't find an account with those credentials<br> You can register an account <a href='https://big-inc.000webhostapp.com/forum/register.php'>here</a>";
    }
?>
