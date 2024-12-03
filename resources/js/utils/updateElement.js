import {getCSRFToken} from "@/utils/getCSRFToken.js";
import {setValidInputs} from "@/utils/setValidInputs.js";

export async function updateElement(nameRoute, url) {
    const formElement = document.querySelector(`form#${nameRoute}`);
    const formData = new FormData(formElement);

    return await fetch(url, {
        method: "PUT",
        headers: {
            'X-CSRF-Token': getCSRFToken(),
            Accept: 'application/json'
        },
        body: formData
    })
        .then(response => {
           return response.status;
        })
        .catch(err => {
            return 500;
        })
}
