export function setDataToForm(data) {
    if (data === undefined) {
        return false;
    }
    const dataForm = data.value.data;
    const namesInput = Object.keys(dataForm);

    namesInput.forEach(nameInput => {
        setValueToInput(nameInput, dataForm[nameInput]);
    });
}


function setValueToInput(name, value) {
    const inputSearch = document.querySelector(`[name="${name}"]`);
    if (inputSearch === null) return false;

    if (typeof value === 'boolean') {
        value = Number(value);
    }

    inputSearch.value = value;
}
