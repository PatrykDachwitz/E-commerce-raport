<script setup>
import {inject, ref, watch} from "vue";
import {useRouter} from "vue-router";
import {getContent} from "@/utils/getContent.js";
import {updateElement} from "@/utils/updateElement.js";
import {setCommunicate} from "@/utils/setCommunicate.js";
import {fetchDelete} from "@/utils/fetchDelete.js";
import {removeElementInIndexElementByDataSet} from "@/utils/removeElementInIndexElementByDataSet.js";

const baseUrlApi = inject('apiUrl');
const communicates = inject('communicates');
const router = useRouter();
const currentRoute = ref(router.currentRoute);
const apiUrl = ref(`${baseUrlApi}${router.currentRoute.value.fullPath}`);
const nameRoute = router.currentRoute.value.params.target;
const { data, error } = getContent(apiUrl, false);

watch(currentRoute, () => {
    apiUrl.value = `${baseUrlApi}${currentRoute.value.fullPath}`;
});

async function updateCurrentElement(id) {
    const urlApiSuperAdmin = `${baseUrlApi}/users/${id}/super_admin`;
    const statusCode = await updateElement(urlApiSuperAdmin, JSON.stringify({
            super_admin: true
        })
    );

    communicates.value.push(setCommunicate(communicates.value, statusCode))
}
async function deleteSelectElement(id) {
    const urlRemove = `${apiUrl}/${id}`;
    const statusCode = await fetchDelete(urlRemove);

    if (statusCode === 200) {
        removeElementInIndexElementByDataSet(id);
    }

    communicates.value.push(setCommunicate(communicates.value, statusCode))
}
</script>

<template>
<div class="p-0 list d-flex container-fluid flex-column" v-if="data !== null">
    <div class="px-3 list__option d-flex justify-content-between align-items-center py-2" v-for="item in data.data" :data-index="item.id">
        <div class="fs-5">
            <router-link class="text-dark text-decoration-none" :to="{name: 'universal_edit', params: {target: nameRoute, id: item.id}}">
                <span class="fw-bold">#{{ item.id }}</span> {{ item.name}}
            </router-link>
        </div>
        <div class="d-flex align-items-center">

            <router-link :to="{name: 'universal_show', params: {target: nameRoute, id: item.id}}" class="pointer-event">
                <img width="20" height="20" src="/assets/view-black.png" alt="View element"/>
            </router-link>

            <router-link :to="{name: 'universal_edit', params: {target: nameRoute, id: item.id}}" class="mx-2 pointer-event">
                <img width="20" height="20" src="/assets/edit.png" alt="Edit element"/>
            </router-link>

            <img width="20" height="20" src="/assets/delete-black.png" alt="Super admin permission" class="pointer me-2" @click="deleteSelectElement(item.id)"/>

            <template v-if="nameRoute === 'users'">
                <img width="20" height="20" src="/assets/superAdmin.png" alt="Super admin permission" class="pointer" @click="updateCurrentElement(item.id)"/>
            </template>

        </div>
    </div>
</div>
</template>

<style scoped>

</style>
