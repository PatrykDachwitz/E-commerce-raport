export function removeElementInIndexElementByDataSet(id) {
    const searchElement = document.querySelector(`[data-index="${id}"]`);

    if (searchElement !== undefined) {
        searchElement.parentElement.removeChild(searchElement);
    }
}
