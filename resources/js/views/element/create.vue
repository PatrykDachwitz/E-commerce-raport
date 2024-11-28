<script setup>
import {inject, ref} from "vue";
import User from "@/components/form/user.vue";
import user from "@/components/form/user.vue";
import {getForm} from "@/utils/getForm.js";
import {useRoute} from "vue-router";

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
