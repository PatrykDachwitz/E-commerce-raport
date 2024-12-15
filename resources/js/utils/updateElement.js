import {getCSRFToken} from "@/utils/getCSRFToken.js";
import {setValidInputs} from "@/utils/setValidInputs.js";
import {inject} from "vue";

export async function updateElement(url, data) {
    return await fetch(url, {
        method: "PUT",
        headers: {
            'X-CSRF-Token': getCSRFToken(),
            Accept: 'application/json',
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(response => {
           return response.status;
        })
        .catch(err => {
            return 500;
        })
}
