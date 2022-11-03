let nameError = document.getElementById('name-error');
let emailError = document.getElementById('email-error');

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

function validateName() {
    let name = document.getElementById('name').value;

    if (name.length === 0) {
        nameError.innerHTML = 'Name is required <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    if (!name.match(/^[A-zА-я ]+$/)) {
        nameError.innerHTML = 'Incorrect symbols <i class="bi bi-x-circle-fill"></i>';
        return false;
    }

    nameError.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
    return true;

}

function unlockSubmit() {
    let create = document.getElementById('create');
    create.disabled = !(validateEmail() && validateName());
}

function unlockUpdate() {
    let update = document.getElementById('update');
    update.disabled = !(validateEmail() && validateName());
}