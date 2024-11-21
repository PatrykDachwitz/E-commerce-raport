export function getCSRFToken() {
    return document.querySelector('[name="_token"]').content;
}
