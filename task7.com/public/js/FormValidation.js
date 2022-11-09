const PASS_MIN_LENGTH = 6;
const PASS_MAX_LENGTH = 15;

const GREEN_CHECK_SIGN = '<i class="bi bi-check-circle-fill"></i>';
const RED_CROSS_SIGN = '<i class="bi bi-x-circle-fill"></i>';

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#pass');
const passConf = document.querySelector('#pass-confirm');

let firstNameError = document.getElementById('first-name-error')
let secondNameError = document.getElementById('second-name-error')
let emailError = document.getElementById('email-error');
let emailConfError = document.getElementById('email-confirm-error')
let passError = document.getElementById('pass-error');
let passConfError = document.getElementById('pass-confirm-error')

let regularExprForPassWithNumbers =
    new RegExp(`^(?=.*[0-9])[a-zA-Z0-9.!@#$%^&*]{${PASS_MIN_LENGTH},${PASS_MAX_LENGTH+1}}$`);
let regularExprForPassWithSpecialChars =
    new RegExp(`^(?=.*[.!@#$%^&*])[a-zA-Z0-9.!@#$%^&*]{${PASS_MIN_LENGTH},${PASS_MAX_LENGTH+1}}$`);
let regularExprForPassWithCapital =
    new RegExp(`^(?=.*[A-Z])[a-zA-Z0-9.!@#$%^&*]{${PASS_MIN_LENGTH},${PASS_MAX_LENGTH+1}}$`);
let regularExprForPassWithSmall =
    new RegExp(`^(?=.*[a-z])[a-zA-Z0-9.!@#$%^&*]{${PASS_MIN_LENGTH},${PASS_MAX_LENGTH+1}}$`);

function validateFirstName() {
    let firstName = document.getElementById('first-name').value;

    if (firstName.length === 0) {
        firstNameError.innerHTML = 'First name is required ' + RED_CROSS_SIGN;
        return false;
    }

    if (!firstName.match(/^[A-zА-я-]+$/)) {
        firstNameError.innerHTML = 'Incorrect symbols ' + RED_CROSS_SIGN;
        return false;
    }

    firstNameError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function validateSecondName() {
    let secondName = document.getElementById('second-name').value;

    if (secondName.length === 0) {
        secondNameError.innerHTML = 'Second name is required ' + RED_CROSS_SIGN;
        return false;
    }

    if (!secondName.match(/^[A-zА-я-]+$/)) {
        secondNameError.innerHTML = 'Incorrect symbols ' + RED_CROSS_SIGN;
        return false;
    }

    secondNameError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function validateEmail() {
    let email = document.getElementById('email').value;

    if (email.length === 0) {
        emailError.innerHTML = 'Email is required ' + RED_CROSS_SIGN;
        return false;
    }

    if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.innerHTML = 'Email is incorrect ' + RED_CROSS_SIGN;
        return false;
    }

    confirmEmail();

    emailError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function confirmEmail() {
    let email = document.getElementById('email').value;
    let emailConf = document.getElementById('email-confirm').value;

    if (email !== emailConf) {
        emailConfError.innerHTML = 'Email does not match ' + RED_CROSS_SIGN;
        return false;
    }

    emailConfError.innerHTML = GREEN_CHECK_SIGN;
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

    if (!pass.match(regularExprForPassWithCapital)) {
        passError.innerHTML = 'At least one capital character needed ' + RED_CROSS_SIGN;
        return false;
    }

    if (!pass.match(regularExprForPassWithSmall)) {
        passError.innerHTML = 'At least one small character needed ' + RED_CROSS_SIGN;
        return false;
    }

    if (!pass.match(regularExprForPassWithNumbers)) {
        passError.innerHTML = 'At least one number needed ' + RED_CROSS_SIGN;
        return false;
    }

    if (!pass.match(regularExprForPassWithSpecialChars)) {
        passError.innerHTML = 'At least one special char needed ' + RED_CROSS_SIGN;
        return false;
    }

    if (pass.length > PASS_MAX_LENGTH) {
        passError.innerHTML =  'Password max length is '+PASS_MAX_LENGTH+'  ' + RED_CROSS_SIGN;
        return false;
    }

    confirmPass();

    passError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function confirmPass() {
    let pass = document.getElementById('pass').value;
    let passConf = document.getElementById('pass-confirm').value;

    if (pass !== passConf) {
        passConfError.innerHTML = 'Password does not match ' + RED_CROSS_SIGN;
        return false;
    }

    passConfError.innerHTML = GREEN_CHECK_SIGN;
    return true;
}

function validateForm() {
    let register = document.getElementById('register');
    register.disabled = !(
        validateFirstName() &&
        validateSecondName() &&
        validateEmail() &&
        confirmEmail() &&
        validatePass() &&
        confirmPass());
}

function clearAllFormInputs() {
    firstNameError.innerHTML = '';
    secondNameError.innerHTML = '';
    emailError.innerHTML = '';
    emailConfError.innerHTML = '';
    passError.innerHTML = '';
    passConfError.innerHTML = '';

    document.getElementById('register').disabled = true;
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
function autoCompleteRegisterForm() {
    document.getElementById('first-name').value = 'DebugFirstName';
    document.getElementById('second-name').value = 'DebugSecondName';
    document.getElementById('email').value = 'email@debug.com';
    document.getElementById('email-confirm').value = 'email@debug.com';
    document.getElementById('pass').value = 'Debug!23';
    document.getElementById('pass-confirm').value = 'Debug!23';
    validateForm();
    document.getElementById('autocomplete').style = "display: none;";
}

function autoCompleteLoginForm() {
    document.getElementById('email').value = 'email@debug.com';
    document.getElementById('pass').value = 'Debug!23';
    document.getElementById('autocomplete').style = "display: none;";
}