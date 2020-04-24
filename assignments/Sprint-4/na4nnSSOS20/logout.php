***REMOVED***
require_once 'config.php';
 
try {
    if ($adapter->isConnected()) {
        $adapter->disconnect();
        //echo 'Logged out the user';
        //echo '<p><a href="index.php">Login</a></p>';
        //echo '<br><p><a href="../na4nnProjectsS20.html">Return to Projects Page</a></p>';
    }
}
catch( Exception $e ){
    echo $e->getMessage() ;
}
header("Location: ../na4nnProjectsS20.html"); 
exit();