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

    if ($conn === false) {
        die("Connection failed");
    }

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
    return date("Y-m-d", strtotime("this week")) . " 00:00:00";
}

/** Get the date of the last slot of this week.
 * @return string datetime
 */
function getDateTimeOfLastSlotOfThisWeek(){
    return date("Y-m-d", strtotime("this week + 6 day")) . " 21:00:00";
}

/** This Monday 0:00 to next Monday 0:00
 * @return array arr['start'] / arr['end']
 */
function getDateTimeRangeOfThisWeekSchedule()
{
    $start = getDateOfThisMonday();
    $end = date("Y-m-d", strtotime("this week + 7 day")) . " 00:00:00";

    $arr = array(
        "start" => $start,
        "end"   => $end
    );

    //var_dump($arr);

    return $arr;
}

/** Next Monday 0:00 to Monday 0:00 of the week after next week
 * @return array arr['start'] / arr['end']
 */
function getDateTimeRangeOfNextWeekSchedule()
{
    $start = date("Y-m-d", strtotime("this week + 7 day")) . " 00:00:00";
    $end = date("Y-m-d", strtotime("this week + 14 day")) . " 00:00:00";

    $arr = array(
        "start" => $start,
        "end"   => $end
    );

    //var_dump($arr);

    return $arr;
}


/** Check if next week schedule is available
 * @return bool
 */
function isAvailableForNextWeekSchedule()
{
    //"this week + 6 day" is Sunday
    if (time() >= strtotime("this week + 6 day")) {
        return true;
    } else {
        return false;
    }
}

/** Check if a time in a specific range
 *  @param string $target datetime to be checked
 *  @param string $start  starting time (inclusive)
 *  @param string $end    ending time (exclusive)
 *  @return bool  True if in range, otherwise false.
 */
function isDateTimeInRange($target, $start, $end)
{
    $t_target = strtotime($target);
    $t_start = strtotime($start);
    $t_end = strtotime($end);

    if ($t_target && $t_start && $t_end) {
        if ($t_target >= $t_start && $t_target < $t_end) {
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
function getTimeZoneOffset()
{
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

    return date("Y-m-d H:i:s", $now);
}

/** Create an array that contains slots by a given range
 *  Input datetime must 3 hour align
 *  @param string Starting datetime (inclusive)
 *  @param string Ending datetime  (exclusive)
 */
function generateSlotsByRange($_start, $_end)
{
    $threeHours = 3600 * 3;

    $start = strtotime($_start);
    $end = strtotime($_end);

    $arr = array();

    for ($i = $start; $i < $end; $i += $threeHours) {
        array_push($arr, date("Y-m-d H:i:s", $i));
    }

    //var_dump($arr);

    return $arr;
}

/** array a - array b with datetime list
 * @param array a  datetime list1
 * @param array b  datetime list2
 * @return array  list of diff datetime list
 */
function diffDateTimeList($a, $b)
{
    $arr1 = array();
    $arr2 = array();

    foreach ($a as &$i) {
        array_push($arr1, strtotime($i));
    }

    foreach ($b as &$i) {
        array_push($arr2, strtotime($i));
    }

    $arr3 = array_diff($arr1, $arr2);

    $arr4 = array();

    foreach ($arr3 as &$i) {
        array_push($arr4, date("Y-m-d H:i:s", $i));
    }

    return $arr4;
}

/** Check if the user already schedule THIS week
 *  @return bool
 */
function isUserAlreadyScheduleThisWeek($conn, $username)
{
    $date = getDateTimeRangeOfThisWeekSchedule();

    $sql = "SELECT Date FROM mgr.schedule WHERE Date >= '{$date['start']}' AND Date < '{$date['end']}' AND Username = '{$username}'";
    $query = $conn->query($sql);

    if ($query && $query->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

/** Check if the user already schedule NEXT week
 *  @return bool
 */
function isUserAlreadyScheduleNextWeek($conn, $username)
{
    $date = getDateTimeRangeOfNextWeekSchedule();

    $sql = "SELECT Date FROM mgr.schedule WHERE Date >= '{$date['start']}' AND Date < '{$date['end']}' AND Username = '{$username}'";
    $query = $conn->query($sql);

    if ($query && $query->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

/** Show Navigation Bar
 *  @param string username Username
 *  @param string roomnum  Room Number
 *  @return none
 */
function echoNavBar($username, $roomnum)
{
    echo "<nav>";

    echo "<div title='Username'>
        <ion-icon name='person-circle-outline'></ion-icon>
        <span>{$username}</span>
    </div>";

    echo "<div title='Room Number'>
        <ion-icon name='home-outline'></ion-icon>
        <span>{$roomnum}</span>
    </div>";

    echo "<div class='right'>
    <a href='/shared/logout.php'>
        <ion-icon name='log-out-outline'></ion-icon>
        Logout
    </a>
    </div>";

    echo "</nav>";
}

?>

<?php  ?>