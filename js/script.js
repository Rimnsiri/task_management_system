function showError(errorElement, errorMessage){
    document.querySelector("."+errorElement).classList.add("display-error");
    document.querySelector("."+errorElement).innerHTML = errorMessage;
    }



function clearError(){
    let errors = document.querySelectorAll(".error");
    for(let error of errors){
        error.classList.remove("display-error")
    }
}



    let form = document.forms['login-form'];
    form.onsubmit = function(event){

        clearError();


    if(form.username.value === ""){
    showError("username-error", "You have to enter a username");
    return false;
    }


    if(form.email.value === ""){
        showError("email-error", "You have to enter your email");
        return false;
        }

        if(form.password.value === ""){
            showError("password-error", "You have to enter a password");
            return false;
            }
    

    
document.querySelector(".register-success").classList.add("display-success");
document.querySelector(".register-success").innerHTML = "Your registration was successful.";

          

    event.preventDefault();



    }

 