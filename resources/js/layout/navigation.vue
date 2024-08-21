<script setup>
import {inject, ref} from "vue";

const lang = inject('lang');
const menuActive = ref(false);

function changeActiveMenu() {
    if (menuActive.value === true) {
        menuActive.value = false;
    } else {
        menuActive.value = true;
    }
}

</script>

<template>
    <nav class="dashboard__navigation navigation">
        <div class="navigation__header d-flex justify-content-between justify-content-md-start  align-items-center">
            <router-link :to="{name: 'home'}" >
                <img src="/assets/logo.png" height="50" class="ms-3 ms-md-0 mt-3 mb-4">
            </router-link>

            <div @click="changeActiveMenu">
                <picture>
                    <source srcset="/assets/menu.webp" type="image/webp">
                    <img src="/assets/menu.png" width="35" height="35" class="me-3 d-md-none" :class="[menuActive === false ? '' : 'd-none']">
                </picture>
                <picture>
                    <source srcset="/assets/close.webp" type="image/webp">
                    <img src="/assets/close.png" width="35" height="35" class="me-3 d-md-none" :class="[menuActive === false ? 'd-none' : '']">
                </picture>
            </div>
        </div>


        <div class="navigation__menu px-3 py-4 py-md-0 my-4 my-0" :class="[menuActive === false ? 'd-none' : '']">
            <span class="navigation__list--header">{{ lang['dashboard'] }}</span>
            <ul class="navigation__list ps-2">
                <li class="my-1">
                    <router-link :to="{name: 'report-daily'}" class="navigation__subsection">{{ lang['dailyReport'] }}</router-link>
                </li>
                <li class="my-1">
                    <router-link :to="{name: 'weekly'}" class="navigation__subsection">Raport weekendowy</router-link>
                </li>
                <li class="my-1">
                    <router-link :to="{name: 'report-comparison'}" class="navigation__subsection">{{ lang['comparisonReport'] }}</router-link>
                </li>
    <!--            <li class="navigation__subsection my-1">{{ lang['monthlyReport'] }}</li>-->
            </ul>
            <span class="navigation__list--header">{{ lang['setting'] }}</span>
            <ul class="navigation__list ps-2">
                <li class="navigation__subsection my-1">{{ lang['countryAvailability'] }}</li>
                <li class="navigation__subsection my-1">{{ lang['schedule'] }}</li>
                <li class="navigation__subsection my-1">{{ lang['users'] }}</li>
            </ul>
        </div>
    </nav>
</template>

<style scoped>

</style>
