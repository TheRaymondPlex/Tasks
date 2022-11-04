const PASS_MIN_LENGTH = 6;
const PASS_MAX_LENGTH = 15;

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
        firstNameError.innerHTML = 'First name is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!firstName.match(/^[A-zА-я ]+$/)) {
        firstNameError.innerHTML = 'Incorrect symbols <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    firstNameError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function validateSecondName() {
    let secondName = document.getElementById('second-name').value;

    if (secondName.length === 0) {
        secondNameError.innerHTML = 'Second name is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!secondName.match(/^[A-zА-я ]+$/)) {
        secondNameError.innerHTML = 'Incorrect symbols <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    secondNameError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function validateEmail() {
    let email = document.getElementById('email').value;

    if (email.length === 0) {
        emailError.innerHTML = 'Email is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    confirmEmail();

    if (!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        emailError.innerHTML = 'Incorrect Email <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    emailError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function confirmEmail() {
    let email = document.getElementById('email').value;
    let emailConf = document.getElementById('email-confirm').value;

    if (email !== emailConf) {
        emailConfError.innerHTML = 'Email does not match <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    emailConfError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function validatePass() {
    let pass = document.getElementById('pass').value;

    if (pass.length === 0) {
        passError.innerHTML = 'Password is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    confirmPass();

    if (pass.length < PASS_MIN_LENGTH) {
        passError.innerHTML =  (PASS_MIN_LENGTH - pass.length) + ' more characters needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (pass.length > PASS_MAX_LENGTH) {
        passError.innerHTML =  'Password max length is '+PASS_MAX_LENGTH+'  <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!pass.match(regularExprForPassWithCapital)) {
        passError.innerHTML = 'At least one capital character needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!pass.match(regularExprForPassWithSmall)) {
        passError.innerHTML = 'At least one small character needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!pass.match(regularExprForPassWithNumbers)) {
        passError.innerHTML = 'At least one number needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!pass.match(regularExprForPassWithSpecialChars)) {
        passError.innerHTML = 'At least one special char needed <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    passError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function confirmPass() {
    let pass = document.getElementById('pass').value;
    let passConf = document.getElementById('pass-confirm').value;

    if (pass !== passConf) {
        passConfError.innerHTML = 'Password does not match <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    passConfError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;
}

function unlockSubmit() {
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
}

togglePassword.addEventListener('click', () => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    if (document.getElementById('pass-confirm')) {
        passConf.setAttribute('type', type);
    }
    togglePassword.classList.toggle('bi-eye');
});