<script setup>
import {inject} from "vue";

const lang = inject('lang');
console.log(lang);
</script>

<template>
    <nav class="dashboard__navigation navigation px-3">
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
    <section class="dashboard__content p-5">
        <div class="report d-flex">
            <div class="report__container rounded-2 d-flex flex-column">
                <div class="report__tittle pb-2">
                    <span>Raport dzienny: 25.12.2014</span>
                    <div>

                    </div>
                </div>
                <div class="report-table d-flex flex-column">
                    <div class="report-table__row d-flex" v-for="numberElement in 25">
                        <div class="report-table__col" v-for="numberElement in 25">Kolumna {{  numberElement }}</div>
                    </div>
                </div>
            </div>
            <div class="ms-5 report__filters filters rounded-2 overflow-hidden">
                <div class="report__tittle pb-2">
                    <span>Filtry</span>
                    <div>

                    </div>
                </div>

                <div class="filters__form p-2 px-3">
                    <template v-for="item in 25">

                        <div class="form-check mb-1 ">
                            <input class="form-check-input form-check-input--dark" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label form-check-label--grey" for="flexCheckChecked">
                                Udział kosztów
                            </label>
                        </div>

                    </template>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
