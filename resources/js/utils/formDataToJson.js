export function formDataToJson(formData) {

    if (!(formData instanceof FormData)) {
        return {}
    }
    const data = {};

    formData.forEach((item, key) => {
        if (item !== null && item !== "") {
            data[key] = item
        }
    })

    return data;
}
