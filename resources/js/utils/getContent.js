import {inject, ref, toValue, watchEffect} from "vue";
import {getCSRFToken} from "@/utils/getCSRFToken.js";
import {setCommunicate} from "@/utils/setCommunicate.js";


export function getContent(url, setSuccessCommunicate = true) {
    const data = ref(null);
    const communicates = inject('communicates');


     watchEffect(() => {
        data.value = null;
         fetch(toValue(url),
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
                data.value = json;
            })
            .catch(err => {
                communicates.value.push(setCommunicate(communicates.value, 500));
            })

    })

    return {data}
}




