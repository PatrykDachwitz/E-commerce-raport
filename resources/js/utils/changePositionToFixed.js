export function changePositionToFixed(classTarget) {
    const targetElement = document.querySelector(`.${classTarget}`);
    const targetElementHeight = targetElement.offsetHeight;
    const parentElement = targetElement.parentElement;

    parentElement.addEventListener('scroll', e => {
        if (parentElement.scrollTop > (targetElementHeight - (targetElementHeight / 2))) {
            addFixedPositionElement(targetElement);
        } else {
            removeFixedPositionElement(targetElement);
        }
    })
}

function addFixedPositionElement(targetElement) {
    if (!targetElement.classList.contains('position-fixed')) {
        targetElement.classList.add('position-fixed');
    }
}

function removeFixedPositionElement(targetElement) {
    if (targetElement.classList.contains('position-fixed')) {
        targetElement.classList.remove('position-fixed');
    }
;
}
