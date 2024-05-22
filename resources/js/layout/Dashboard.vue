<script setup>
import {inject} from "vue";

const lang = inject('lang');
console.log(lang);
</script>

<template>
    <nav class="navigation px-3">
        <span class="navigation__header">{{ lang['dashboard'] }}</span>
        <ul class="navigation__list ps-2">
            <li class="navigation__subsection my-1">{{ lang['dailyReport'] }}</li>
            <li class="navigation__subsection my-1">{{ lang['monthlyReport'] }}</li>
        </ul>
        <span class="navigation__header">{{ lang['setting'] }}</span>
        <ul class="navigation__list ps-2">
            <li class="navigation__subsection my-1">{{ lang['countryAvailability'] }}</li>
            <li class="navigation__subsection my-1">{{ lang['schedule'] }}</li>
            <li class="navigation__subsection my-1">{{ lang['users'] }}</li>
        </ul>
    </nav>
    <section class="dashboard">
        <div class="report d-flex justify-content-between align-items-stretch p-5">
            <div class="report__content shadow-sm d-flex">
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
                <div style="min-width: 100px">test</div>
            </div>
            <div class="report__filters shadow-sm ms-5">
                test
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
