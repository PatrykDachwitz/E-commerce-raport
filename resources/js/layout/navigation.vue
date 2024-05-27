<script setup>
import {inject} from "vue";

const lang = inject('lang');
</script>

<template>
    <nav class="dashboard__navigation navigation px-3">
        <router-link :to="{name: 'home'}" >
            <img src="/assets/logo.png" height="50" class="mt-3 mb-4">
        </router-link>
        <span class="navigation__header">{{ lang['dashboard'] }}</span>
        <ul class="navigation__list ps-2">
            <li class="my-1">
                <router-link :to="{name: 'report-daily'}" class="navigation__subsection">{{ lang['dailyReport'] }}</router-link>
            </li>
            <li class="my-1">
                <router-link :to="{name: 'report-comparison'}" class="navigation__subsection">{{ lang['comparisonReport'] }}</router-link>
            </li>
<!--            <li class="navigation__subsection my-1">{{ lang['monthlyReport'] }}</li>-->
        </ul>
        <span class="navigation__header">{{ lang['setting'] }}</span>
        <ul class="navigation__list ps-2">
            <li class="navigation__subsection my-1">{{ lang['countryAvailability'] }}</li>
            <li class="navigation__subsection my-1">{{ lang['schedule'] }}</li>
            <li class="navigation__subsection my-1">{{ lang['users'] }}</li>
        </ul>
    </nav>
</template>

<style scoped>

</style>
