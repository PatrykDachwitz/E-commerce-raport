export function languages(dataNameElement) {
    const langContainer = document.querySelector(`[${dataNameElement}]`);

    return JSON.parse(langContainer.innerText);
}
