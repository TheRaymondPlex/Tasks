const PASS_MIN_LENGTH = 6;

const GREEN_CHECK_SIGN = '<i class="bi bi-check-circle-fill"></i>';
const RED_CROSS_SIGN = '<i class="bi bi-x-circle-fill"></i>';

let emailError = document.getElementById('email-error');
let passError = document.getElementById('pass-error');
let togglePassword = document.querySelector('#togglePassword');
let password = document.querySelector('#pass');

function validateEmail() {
    let email = document.getElementById('email').value;

    if (email.length === 0) {
        emailError.innerHTML = 'Email is required ' + RED_CROSS_SIGN;
        return false;
    }

    if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.innerHTML = 'Incorrect Email ' + RED_CROSS_SIGN;
        return false;
    }

    emailError.innerHTML = GREEN_CHECK_SIGN;
    return true;

}

function validatePass() {
    let pass = document.getElementById('pass').value;

    if (pass.length === 0) {
        passError.innerHTML = 'Password is required ' + RED_CROSS_SIGN;
        return false;
    }

    if (pass.length < PASS_MIN_LENGTH) {
        passError.innerHTML =  (PASS_MIN_LENGTH - pass.length) + ' more characters needed ' + RED_CROSS_SIGN;
        return false;
    }

    passError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function validateForm() {
    let login = document.getElementById('login');
    login.disabled = !(validateEmail() && validatePass());
}

function clearFields() {
    passError.innerHTML = '';
    emailError.innerHTML = '';
}

togglePassword.addEventListener('click', () => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    if (document.getElementById('pass-confirm')) {
        passConf.setAttribute('type', type);
    }
    togglePassword.classList.toggle('bi-eye');
});

// DEBUG ZONE //
function autoCompleteLoginForm() {
    document.getElementById('email').value = 'email@debug.com';
    document.getElementById('pass').value = 'Debug!23';
    validateForm();
    document.getElementById('autocomplete').style = "display: none;";
}