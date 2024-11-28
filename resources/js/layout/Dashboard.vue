<script setup>
import {inject, onMounted, provide, ref} from "vue";
import Navigation from "@/layout/navigation.vue";
import Comunicate from "@/components/comunicate.vue";

const lang = inject('lang');

</script>

<template>
    <comunicate></comunicate>
    <navigation></navigation>
    <section class="dashboard__content d-flex flex-column">
        <div class="dashboard__header bg-dark d-flex justify-content-between align-items-center">
            <div class="dashboard__header--tittle py-1 d-flex align-items-center justify-content-between px-3">
                <router-view name="sideBar">

                </router-view>
            </div>
        </div>
        <div class="dashboard__container">
            <router-view></router-view>
        </div>
    </section>
</template>

<style scoped>

</style>
