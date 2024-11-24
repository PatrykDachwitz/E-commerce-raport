import {inject, ref, watchEffect} from "vue";


export function getContent(url, setSuccessCommunicate = true) {
    const data = ref(null);
    const communicates = inject('communicates');


     watchEffect(() => {
        data.value = null;

         fetch(url)
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


function setCommunicate(communicates, code) {

    let nextIdNumber = 1;

    if (communicates.length > 0) {
        nextIdNumber = communicates[communicates.length - 1].id + 1;
    }

    return {
        id: nextIdNumber,
        code: code,
    };
}

