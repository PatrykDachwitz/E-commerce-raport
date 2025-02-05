import {inject, ref, watchEffect} from "vue";
import {getCSRFToken} from "@/utils/getCSRFToken.js";
import {setCommunicate} from "@/utils/setCommunicate.js";


export async function getContentToJson(url, setSuccessCommunicate = true) {
    const communicates = inject('communicates');


    return await fetch(url,
        {
            headers: {
                'X-CSRF-Token': getCSRFToken(),
                'Accept': 'application/json'
            }
        })
        .then(response => {

            if (response.status >= 200 && response.status < 300) {
                if (setSuccessCommunicate === true) communicates.value.push(setCommunicate(communicates.value, response.status));
                return response.json();
            } else {
                communicates.value.push(setCommunicate(communicates.value, response.status));
            }

        })
        .then(json => {
            return json;
        })
        .catch(err => {
            communicates.value.push(setCommunicate(communicates.value, 500));
        })

}




