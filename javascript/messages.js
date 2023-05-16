// Error message for submitting no values.
document.forms['login-form'].onsubmit = function(event) {
    if(this.username.value.trim() == ""){
        document.querySelector(".error-uid").innerHTML = "&bull; Username field is empty!<br>";
        document.querySelector(".error-uid").style.display = "block";
        event.preventDefault();
        return false;
    }
    if(this.pwd.value.trim() == ""){
        document.querySelector(".error-pwd").innerHTML = "&bull; No Password Provided!";
        document.querySelector(".error-pwd").style.display = "block";
        event.preventDefault();
        return false;
    }
}