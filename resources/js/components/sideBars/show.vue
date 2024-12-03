<script setup>

import NameByRoute from "@/components/sideBars/nameByRoute.vue";
import {useRoute} from "vue-router";
const route = useRoute();
</script>

<template>
    <name-by-route />
    <div class="d-flex justify-content-end align-items-center">
        <router-link :to="{name: 'universal_edit', params: {target: route.params.target, id: route.params.id}}">
            <img src="/assets/edit-element.png" loading="lazy" width="20" height="20">
        </router-link>
    </div>
</template>

<style scoped>

</style>
