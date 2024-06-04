<script setup>
import {inject, onMounted, watch} from "vue";
import {changePositionToFixed} from "@/utils/changePositionToFixed.js";
import {createRouter, useRoute, useRouter} from "vue-router";
import {getContentReport} from "@/utils/getContentReport.js";

const apiUrl = inject('apiUrl');
const route = useRoute();
const lang = inject('lang');

onMounted(() => {
});

const { data, error } = getContentReport(`${apiUrl}${route.path}`)
watch(data, () => {
    console.log(data)
});
</script>

<template>
    <div class="report d-flex flex-column">
        <div class="report__row--header d-flex" v-if="data !== null">
            <div class="report__header report__header--double report__header--google">{{ data.data.names.resultsFromBeginnerMonthCurrentYear ?? "" }}</div>
            <div class="report__header report__header--double report__header--google">{{ data.data.names.resultsFromBeginnerMonthPreviousYear }}</div>
            <div class="report__header report__header--double report__header--google">{{ lang['comparison'] }}</div>
            <div class="report__header report__header--double report__header--global">{{ data.data.names.avgResultMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--global">{{ data.data.names.avgResultMonthPreviousYear }}</div>
            <div class="report__header report__header--double report__header--global">{{ lang['comparison'] }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ data.data.names.resultsFromBeginnerPreviousMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ data.data.names.resultsFromBeginnerMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ lang['comparison'] }}</div>
        </div>

        <div class="report__content d-flex" v-if="data !== null">
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthCurrentYear['value'] }} Eur</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthCurrentYear['art'] }} szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthPreviousYear['value'] }} Eur</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthPreviousYear['art'] }} szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthComparisonYear['value'] }} Eur</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthComparisonYear['art'] }} szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.avgResultMonthCurrentYear['value'] }}</div>
                    <div class="report__value">{{ data.data.avgResultMonthCurrentYear['art'] }}</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.avgResultMonthPreviousYear['value'] }}</div>
                    <div class="report__value">{{ data.data.avgResultMonthPreviousYear['art'] }}</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.avgResultMonthComparisonYear['value'] }}</div>
                    <div class="report__value">{{ data.data.avgResultMonthComparisonYear['art'] }}</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerPreviousMonthCurrentYear['value'] }}</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerPreviousMonthCurrentYear['art'] }}</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthCurrentYear['value'] }}</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerMonthCurrentYear['art'] }}</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ data.data.resultsFromBeginnerComparisonMonth['value'] }}</div>
                    <div class="report__value">{{ data.data.resultsFromBeginnerComparisonMonth['art'] }}</div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
