function submitCheck(){
    var username=document.getElementById("username").value;
    var passwd=document.getElementById("password").value;
    
    //return false to cancel submit

    if(passwd.length < 8){
        alert("password must have at least 8 characters");
        return false;
    }else{
        return true;
    }
}