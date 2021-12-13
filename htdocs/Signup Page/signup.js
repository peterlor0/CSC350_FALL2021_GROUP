function submitCheck() {
    var username = document.getElementById("username").value;
    var passwd = document.getElementById("password").value;
    var roomnum = document.getElementById("roomnum").value;

    //trim and replace multiple space with single space
    roomnum = roomnum.trim().replace(/  +/g, " ");

    //return false to cancel submit

    var flag_username = false;
    var flag_passwd = false;
    var flag_roomnum = false;

    if (username.includes(' ')) {
        document.getElementById("username_alert").textContent = "Username cannot includes white space";
    } else {
        flag_username = true;
    }

    if (passwd.length < 8) {
        document.getElementById("password_alert").textContent = "Password must have at least 8 characters";
    } else {
        flag_passwd = true;
    }

    if (roomnum.length == 0) {
        document.getElementById("roomnum_alert").textContent = "Invalid Room Number";
    } else {
        document.getElementById("roomnum").value = roomnum;
        flag_roomnum = true;
    }

    return flag_username && flag_passwd && flag_roomnum;

}