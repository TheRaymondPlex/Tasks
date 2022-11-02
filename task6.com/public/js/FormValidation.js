let emailError = document.getElementById('email-error');
let passError = document.getElementById('pass-error');

function validateEmail() {
    let email = document.getElementById('email').value;

    if (email.length === 0) {
        emailError.innerHTML = 'Email is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.innerHTML = 'Incorrect Email <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    emailError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;

}

function validatePass() {
    let pass = document.getElementById('pass').value;

    if (pass.length === 0) {
        passError.innerHTML = 'Password is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (pass.length < 8) {
        passError.innerHTML =  (8 - pass.length) + ' more characters needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    passError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;

}

function unlockSubmit() {
    let login = document.getElementById('login');
    login.disabled = !(validateEmail() && validatePass());
}

function clearAllFormInputs() {
    passError.innerHTML = '';
    emailError.innerHTML = '';
}