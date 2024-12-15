<script setup>
import NameByRoute from "@/components/sideBars/nameByRoute.vue";
import {inject} from "vue";

const communicates = inject('communicates');
</script>

<template>
    <name-by-route />
    <div class="d-flex justify-content-end align-items-center">
        <router-link :to="{name: 'universal_create', target: 'users'}">
            <img src="/assets/add-element.png" loading="lazy" width="20" height="20">
        </router-link>
    </div>
</template>

<style scoped>

</style>
