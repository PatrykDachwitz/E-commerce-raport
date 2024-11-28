<script setup>
import {useRoute} from "vue-router";
import {getForm} from "@/utils/getForm.js";


const route = useRoute();
const nameRoute = route.params.target;

</script>

<template>
    <div class="p-4">
        <component :is="getForm(nameRoute)"></component>
    </div>
</template>

<style scoped>

</style>
