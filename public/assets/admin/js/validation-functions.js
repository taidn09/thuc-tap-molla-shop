// form validation functions
function validateIsEmpty(value) {
    return value.trim() == ''
}

function validateName(value, min = 0, max = 0) {
    value = value.trim();
    return value.length >= min && value.length <= max && /^([^0-9]*)$/.test(value)
}

function validateEmailAdress(email) {
    return (/\S+@\S+\.\S+/.test(email.trim()))
}

function validatePhoneNumber(phone) {
    return /^[0]([0-9]){9,10}$/.test(phone);
}