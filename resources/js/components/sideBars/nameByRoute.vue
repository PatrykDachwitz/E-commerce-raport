<script setup>
import {inject} from "vue";
import {useRoute} from "vue-router";

const lang = inject('lang');
const route = useRoute();
const nameRoute = route.name;
const target = route.params.target;


</script>

<template>
    <span>{{ lang[nameRoute][target] }}</span>
</template>

<style scoped>

</style>
