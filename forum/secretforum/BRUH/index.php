<?php
    $now = time(); // or your date as well
    $your_date = strtotime("2021-12-2");
    $datediff = $your_date - $now;
?>
<html>
    <head>
        <title>the countdown</title>
    </head>
    
    <body>
        <p style="font-size:14px">
            <h1>You found it!</h1>
            
            
            <h2>What do you get from this?</h2>
            You get nothing. There is no benefit to finding this page.<br>
            You can't do anything special, you don't get anything special.
            <br>
            <br>
            Except the countdown timer.
            <br>
            This timer counts down to a <i>very</i> special event.
            <br>
            I can't tell you what it is, but you <b>will</b> like it.
            <br>
            I guarantee it.
            <br>
            <br>
            <br>
            <p style="font-size:40px;">
                <?php
                if($datediff > 0){
                    echo "There are " . round($datediff / (60 * 60 * 24)) . " days remaining.";
                }else
                {
                    echo "There are 0 days remaining. Here is your surprise: <br> <a href = 'danceelemental.gif'>SURPRISE HERE</a>";
                }    
                ?></p>
            To keep you entertained, have Wolfenstein 3D:
        </p>
        
        <iframe src="https://archive.org/embed/msdos_Wolfenstein_3D_1992" width="560" height="384" frameborder="0" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen></iframe>
        <br>
        
        <br>
        
        
    </body>
</html>