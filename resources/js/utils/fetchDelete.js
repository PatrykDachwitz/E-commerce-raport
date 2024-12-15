import {getCSRFToken} from "@/utils/getCSRFToken.js";

export async function fetchDelete(url) {

    console.log(url)
    return await fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-Token': getCSRFToken(),
        }
    })
        .then(response => {
            return response.status;
        })
        .catch(err => {
            return 500;
        })

}
