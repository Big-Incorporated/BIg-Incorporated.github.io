<html>
    <head>
        <title>Register Account</title>
    </head>
    
    <body>
        
        <h2>Sign up for big forum</h2>
        
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <p>Display name:</p>
            <input type="text" name="username"/>
            <p>Password:</p>
            <input type="text" name="passwd"/>
            <p>Link to profile picture:</p>
            <input type="text" name="pfp"/>
            <input type="submit" name="submit">
        </form>
        <br>
        <a href="post.php">Back to the posting page</a>
    </body>
    
</html>
<?php
    $username = '';
    $passwd = '';
    if ( isset( $_POST['submit'] ) ) {
        $username = $_POST['username']; 
        $passwd = $_POST['passwd'];
        $pfp = $_POST['pfp'];
        
    }
    function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
    // Add each line to an array
    $fp = @fopen("./secretforum/accountdata/accounts.txt", 'r');
    if ($fp) {
       $accounts = explode("\n", fread($fp, filesize("./secretforum/accountdata/accounts.txt")));
       for($x=0;$x<sizeof($accounts);$x++){
           $accounts[$x] = explode("|",$accounts[$x]);
       }
       $accounts=flatten($accounts);
    }
    fclose($fp);
    
    
    if($username != '' && $passwd != ''&&!in_array($username,$accounts)){
        $acct = $username. "|" .$passwd. "|" . $pfp . PHP_EOL;
        $myfile = fopen("./secretforum/accountdata/accounts.txt", "a+") or die("Unable to open file!");
        
        fwrite($myfile, $acct);
        fclose($myfile);
    }
    else if ($username == '' || $passwd == '' || $pfp =='')
    {
        echo "<p style='color:red;'>Please enter a username and password!</p>";
    }
    else if(in_array($username,$accounts))
    {
        echo "<p style='color:red;'>That username is taken!</p>";
    }
?>
