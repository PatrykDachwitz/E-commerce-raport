import {ref, watchEffect} from "vue";

export function getContentReport(url) {
    const data = ref(null);
    watchEffect(() => {
        data.value = null;
        fetch(url)
            .then(response => {
                if (response.status === 200) {
                    return response.json();
                }
            })
            .then(json => {
                data.value = json;
            })
    })

    return {data}
}
