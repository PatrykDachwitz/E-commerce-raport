import {getCSRFToken} from "@/utils/getCSRFToken.js";

export async function logOut(logOutUrl, loginUrl) {

    const response = await fetch(logOutUrl, {
        method: "PUT",
        headers: {
            'X-CSRF-Token': getCSRFToken()
        }
    })
        .then(response => {
            if (response.status === 301) {
                window.location.href = loginUrl;
            } else {
                console.log(response.status)
            }
        })
        .catch(err => console.log(err))

}

