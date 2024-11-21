export function getUrlByData(dataName) {
    return document.querySelector(`[${dataName}]`).innerText;
}
