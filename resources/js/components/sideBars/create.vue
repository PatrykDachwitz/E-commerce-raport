<script setup>
import NameByRoute from "@/components/sideBars/nameByRoute.vue";
import {useRoute, useRouter} from "vue-router";
import {createElement} from "@/utils/createElement.js";
import {inject} from "vue";

const route = useRoute();
const router = useRouter();
const apiUrl = (inject('apiUrl') + route.fullPath).replace('/create', '');

async function createNewElement() {
    const newElement = await createElement(route.params.target, apiUrl);

    router.push({name: 'universal_show', params: {target: route.params.target, id: newElement.data.id}})
}
</script>

<template>
    <name-by-route />
    <div class="d-flex justify-content-end align-items-center">
        <img @click="createNewElement" src="/assets/save.png" loading="lazy" width="20" height="20" class="mx-2">
    </div>
</template>

<style scoped>

</style>
