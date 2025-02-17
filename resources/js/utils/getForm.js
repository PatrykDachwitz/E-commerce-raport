import user from "@/components/form/user.vue";
import page404 from "@/views/error/404.vue";
import country from "@/components/form/country.vue";

export function getForm(nameForm) {
    const availableForm = {
        users: user,
        countries: country
    }

    const defaultResponse = page404;

    if (formIsAvailable(availableForm, nameForm)) {
        return availableForm[nameForm]
    }

    return defaultResponse;
}

function formIsAvailable(availableForms, searchForm) {
    const keysForms = Object.keys(availableForms);

    return keysForms.includes(searchForm);
}


