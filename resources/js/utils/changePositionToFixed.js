export function changePositionTableHeader(classTarget, scrollYTargetClass, firstRowContent) {
    const elementScrollY = document.querySelector(`.${scrollYTargetClass}`);
    const targetElement = document.querySelector(`.${classTarget}`);
    const targetElementHeight = targetElement.offsetHeight;
    const parentElement = targetElement.parentElement;
    const menuWidth = document.querySelector("#app > nav").offsetWidth;
    let additionalSizeInLeftReport = 0;
    parentElement.addEventListener('scroll', e => {

        if (parentElement.scrollTop > (targetElementHeight - (targetElementHeight / 4))) {
            addFixedPositionElement(targetElement);
            updateMarginTop(firstRowContent, "100px");
        } else {
            removeFixedPositionElement(targetElement);
            updateMarginTop(firstRowContent, "")
        }

        if (elementScrollY.scrollLeft > 0) {
            additionalSizeInLeftReport = 165;
        } else {
            additionalSizeInLeftReport = 0;
        }

        if (parentElement.scrollLeft > 0) {
            if (parentElement.scrollLeft > menuWidth) {
                console.log("test1");
                let newWidth = parentElement.scrollLeft - menuWidth;
                targetElement.style.left = `-${newWidth}px`;
            } else {
                console.log('test3');
                let newWidth = menuWidth - (parentElement.scrollLeft);
                targetElement.style.left = `${newWidth}px`;
            }
        } else {
            console.log("test4")
            targetElement.style.left = `${menuWidth}px`;
        }
    })
}

function updateMarginTop(classTarget, margin) {
    const elements = document.querySelectorAll(`.${classTarget}`);

    elements.forEach(element => {
        element.style.marginTop = margin;
    });
}

export function changePositionCountryName(className, containerClassName, scrollTargetClassName, targetElementForMarginLeft) {

    const scrollTarget = document.querySelector(`.${scrollTargetClassName}`);
    let currentScrollValue = 0;

    scrollTarget.addEventListener('scroll', e => {
        let targetsElement = document.querySelectorAll(`.${className}`);
        let elementForMarginLeft = document.querySelectorAll(`.${targetElementForMarginLeft}`);
        targetsElement.forEach(targetElement => {


            if (scrollTarget.scrollLeft > 0) {
                let offsetTopElement = targetElement.offsetTop;
                if (scrollTarget.scrollTop < currentScrollValue || currentScrollValue === 0){

                    let newScrollDifference = currentScrollValue - scrollTarget.scrollTop;
                    let newOffsetTopTargetElement = offsetTopElement + newScrollDifference;
                    targetElement.style.top = `${newOffsetTopTargetElement}px`;
                } else if (scrollTarget.scrollTop > currentScrollValue) {

                    let newScrollDifference = scrollTarget.scrollTop - currentScrollValue;
                    let newOffsetTopTargetElement = offsetTopElement - newScrollDifference;
                    targetElement.style.top = `${newOffsetTopTargetElement}px`;
                }
                elementForMarginLeft.forEach(item => {
                   item.style.marginLeft = '165px';
                });
                addFixedPositionElement(targetElement);
            } else {
                removeFixedPositionElement(targetElement);
                elementForMarginLeft.forEach(item => {
                    item.style.marginLeft = '';
                });
                targetElement.style.top = "";
                currentScrollValue = 0;
            }

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
