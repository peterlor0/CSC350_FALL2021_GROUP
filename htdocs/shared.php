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
function redirectPageTo($path)
{
    header("Location: " . $path);
    exit();
}

/** Check if the user has logged in, if is not, redirect to index page.
 * call session_start() before use this function
 * @return None
 */
function checkLoginState()
{
    if (!isset($_SESSION['username'])) {
        session_unset();
        session_destroy();
        redirectPageTo("/index.php");
    }
}

/** Get the date of this Monday.
 * @return string datetime
 */
function getDateOfThisMonday()
{
    return date("Y-m-d H:i:s", strtotime("this week"));
}

/** Get the date of this Sunday.
 * @return string datetime
 */
function getDateOfThisSunday()
{
    return date("Y-m-d H:i:s", strtotime("this week - 1 day"));
}

/** Check if a time in a specific range
 *  @param string $target datetime to be checked
 *  @param string $start  starting time (inclusive)
 *  @param string $end    ending time (inclusive)
 *  @return bool  True if in range, otherwise false.
 */
function isDateTimeInRange($target, $start, $end)
{
    $t_target = strtotime($target);
    $t_start = strtotime($start);
    $t_end = strtotime($end);

    if ($t_target && $t_start && $t_end) {
        if ($t_target >= $t_start && $t_target <= $t_end) {
            //echo "true" . "<br>";
            return true;
        }
    }

    //echo "false" . "<br>";
    return false;
}

/** Gets the current time zone offset (in second)
 * @return int
 */
function getTimeZoneOffset(){
    return date("Z", time());
}

/** Gets the datetime of the next slot (from now)
 *  @return string The datetime of the next slot
 */
function getNextSlotDateTime()
{
    $now = strtotime("now");
    $off = getTimeZoneOffset();

    $threeHours = 3600 * 3;
    $now += $off;

    $now = (int)(($now + $threeHours) / $threeHours) * $threeHours;

    $now -= $off;

    return date("Y-m-d h:i:s", $now);
}

?>

<?php  ?>