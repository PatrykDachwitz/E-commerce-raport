export function changePositionTableHeader(classTarget) {
    const targetElement = document.querySelector(`.${classTarget}`);
    const targetElementHeight = targetElement.offsetHeight;
    const parentElement = targetElement.parentElement;
    const menuWidth = document.querySelector("#app > nav").offsetWidth;

    parentElement.addEventListener('scroll', e => {

        if (parentElement.scrollTop > (targetElementHeight - (targetElementHeight / 4))) {
            addFixedPositionElement(targetElement);
        } else {
            removeFixedPositionElement(targetElement);
        }

        if (parentElement.scrollLeft > 0) {
            if (parentElement.scrollLeft > menuWidth) {
                let newWidth = parentElement.scrollLeft - menuWidth;
                targetElement.style.left = `-${newWidth}px`;
            } else {
                let newWidth = menuWidth - parentElement.scrollLeft;
                targetElement.style.left = `${newWidth}px`;
            }
        } else {
            targetElement.style.left = `${menuWidth}px`;
        }
    })
}

export function changePositionCountryName(className, containerClassName, scrollTargetClassName) {

    const scrollTarget = document.querySelector(`.${scrollTargetClassName}`);
    let currentScrollValue = 0;

    scrollTarget.addEventListener('scroll', e => {
        let targetsElement = document.querySelectorAll(`.${className}`);

        targetsElement.forEach(targetElement => {


            if (scrollTarget.scrollLeft > 0) {
                let offsetTopElement = targetElement.offsetTop;
                if (scrollTarget.scrollTop < currentScrollValue || currentScrollValue === 0){
                    console.info(1);
                    let newScrollDifference = currentScrollValue - scrollTarget.scrollTop;
                    let newOffsetTopTargetElement = offsetTopElement + newScrollDifference;
                    targetElement.style.top = `${newOffsetTopTargetElement}px`;
                } else if (scrollTarget.scrollTop > currentScrollValue) {
                    console.info(2);
                    let newScrollDifference = scrollTarget.scrollTop - currentScrollValue;
                    let newOffsetTopTargetElement = offsetTopElement - newScrollDifference;
                    targetElement.style.top = `${newOffsetTopTargetElement}px`;
                }
                addFixedPositionElement(targetElement);
            } else {
                removeFixedPositionElement(targetElement);
                targetElement.style.top = "";
                currentScrollValue = 0;
            }



           /* if (scrollTarget.scrollTop <= currentScrollValue){
                let newScrollDifference = currentScrollValue - scrollTarget.scrollTop;
                let newOffsetTopTargetElement = offsetTopElement + newScrollDifference;
                targetElement.style.top = `${newOffsetTopTargetElement}px`;
            } else {
                let newScrollDifference = scrollTarget.scrollTop - currentScrollValue;
                let newOffsetTopTargetElement = offsetTopElement - newScrollDifference;
                targetElement.style.top = `${newOffsetTopTargetElement}px`;
            }*/

        });
        if (scrollTarget.scrollLeft > 0) {

            currentScrollValue = scrollTarget.scrollTop;
        }
    });
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
}
