export function languages() {
    const langContainer = document.querySelector('[data-lang-content]');

    return JSON.parse(langContainer.innerText);
}
