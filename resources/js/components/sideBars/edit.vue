<script setup>
import NameByRoute from "@/components/sideBars/nameByRoute.vue";
import {inject} from "vue";
import {useRoute} from "vue-router";
import {updateElement} from "@/utils/updateElement.js";
import {setCommunicate} from "@/utils/setCommunicate.js";
import {formDataToJson} from "@/utils/formDataToJson.js";

const route = useRoute();
const apiUrl = (inject('apiUrl') + route.fullPath).replace('/edit', '');
const communicates = inject('communicates');
const nameRoute = route.params.target;

async function updateCurrentElement() {
    const formElement = document.querySelector(`form#${nameRoute}`);
    const formData = new FormData(formElement);
    const dataUpdate = formDataToJson(formData);
    const statusCode = await updateElement(apiUrl, JSON.stringify(
        dataUpdate
    ));

    communicates.value.push(setCommunicate(communicates.value, statusCode))
}
</script>

<template>
    <name-by-route />
    <div class="d-flex justify-content-end align-items-center">
        <img src="/assets/delete.png" loading="lazy" width="20" height="20" class="mx-2">
        <img src="/assets/save.png" @click="updateCurrentElement" loading="lazy" width="20" height="20" class="mx-2">
    </div>
</template>

<style scoped>

</style>
