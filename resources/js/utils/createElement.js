import {getCSRFToken} from "@/utils/getCSRFToken.js";
import {setValidInputs} from "@/utils/setValidInputs.js";

export async function createElement(nameRoute, url) {
    const formElement = document.querySelector(`form#${nameRoute}`);
    const formData = new FormData(formElement);

    const createElement = await fetch(url, {
        method: "POST",
        headers: {
            'X-CSRF-Token': getCSRFToken(),
            Accept: 'application/json'
        },
        body: formData
    })
        .then(response => {
            if (response.status === 422) {
                setValidInputs(response.json(), formElement)
            } else if (response.status === 200) {
                return response.json();
            }
        })

    return createElement
}
