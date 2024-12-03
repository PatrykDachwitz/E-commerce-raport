<script setup>
import {useRoute} from "vue-router";
import {getForm} from "@/utils/getForm.js";
import {inject, watch} from "vue";
import {getContent} from "@/utils/getContent.js";
import {setDataToForm} from "@/utils/setDataToForm.js";

const route = useRoute();
const nameRoute = route.params.target;

const apiUrl = inject('apiUrl') + route.fullPath;


const { data, error } = getContent(`${apiUrl}`, false);
watch(data, () => {
    setDataToForm(data);
})
</script>

<template>
    <div class="p-4">
        <component :is="getForm(nameRoute)"></component>
    </div>
</template>

<style scoped>

</style>
