<?php

//set timezone
date_default_timezone_set("America/new_york");

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

/** Get the date of this Monday.
 * @return string date
 */
function getDateOfThisMonday(){
    return date("Y-m-d H:i:s", strtotime("this week"));
}

/** Get the date of this Sunday.
 * @return string date
 */
function getDateOfThisSunday(){
    return date("Y-m-d H:i:s", strtotime("this week - 1 day"));
}

?>

<?php  ?>