export function setValidInputs(errors, form) {
    clearCommunicat(form)

    errors
        .then(json => {
            const errorValues = json.errors;
            const errorKeys = Object.keys(errorValues);

            errorKeys.forEach(nameInput => {
                setValidCommunicat(form, nameInput, errorValues[nameInput])
            })
        })
}

function getCommunicat(communicat) {
    let container = document.createElement('div');
    container.classList.add('invalid-feedback');
    container.innerText = communicat;

    return container;
}

function setValidCommunicat(form, nameInput, value) {
    let searchInput = form.querySelector(`[name="${nameInput}"]`);
    searchInput.classList.add('is-invalid');
    const validCommunicat = getCommunicat(value);
    searchInput.parentElement.append(validCommunicat);
}

function clearCommunicat(form) {
    const alertsError = form.querySelectorAll('.invalid-feedback');
    alertsError.forEach(alertError => {
       alertError.remove();
    });
}
