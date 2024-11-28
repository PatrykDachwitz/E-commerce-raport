<script setup>
import {inject, ref} from "vue";
import {useRouter} from "vue-router";
import {getContent} from "@/utils/getContent.js";

const router = useRouter();
const apiUrl = inject('apiUrl') + router.currentRoute.value.fullPath;
const nameRoute = router.currentRoute.value.params.target;


const { data, error } = getContent(`${apiUrl}`, false);

</script>

<template>
<div class="p-0 list d-flex container-fluid flex-column" v-if="data !== null">
    <div class="px-3 list__option d-flex justify-content-between align-items-center py-2" v-for="item in data.data">
        <div class="fs-5"><span class="fw-bold">#{{ item.id }}</span> {{ item.name}}</div>
        <div>
            <img width="20" height="20" src="/assets/banned.png" alt="Banned user"/>
            <img class="mx-2" width="20" height="20" src="/assets/superAdmin.png" alt="Super admin permission"/>
            <router-link :to="{name: 'universal_edit', params: {target: nameRoute, id: item.id}}"><img width="20" height="20" src="/assets/edit.png" alt="Edit element"/></router-link>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>
