<?php

/** Start a sql connection
* @return conn The sql connection object
*/
function startSQLConnect()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    return $conn;
}

/** Change the current page
* @param string path Path to the target page
* @return None
*/
function redirectPageTo($path){
    header("Location: " . $path);
    exit();
}

/** Check if the user has logged in, if is not, redirect to index page.
 * call session_start() before use this function
 * @return None
 */
function checkLoginState(){
    if(!isset($_SESSION['username'])){
        redirectPageTo("/index.php");
    }
}

?>

<?php  ?>