<script setup>
import {inject, onMounted, watch} from "vue";
import {useRoute} from "vue-router";
import {getContent} from "@/utils/getContent.js";
import {insertSpace} from "../../utils/insertSpace.js";
import {getContentToJson} from "@/utils/getContentToJson.js";

const apiUrl = inject('apiUrl');
const route = useRoute();
const lang = inject('lang');
const dateReport = inject('dateReport')
const selectDateReport = inject('selectDateReport')
const { data, error } = getContent(`${apiUrl}${route.path}`, false);

watch(data, () => {
    dateReport.value = data.value.date;
});

watch(selectDateReport, () => {
    changeDataReport();
});

async function changeDataReport() {
    let dataReport = await getContentToJson(`${apiUrl}${route.path}?date=` + selectDateReport.value, false);
    data.value.data = dataReport.data;
    data.value.date = dataReport.date;
}
</script>

<template>
    <div class="report d-flex flex-column">
        <div class="report__row--header d-flex" v-if="data !== null & data !== undefined">
            <div class="report__header report__header--double report__header--google">{{ data.data.names.resultsFromBeginnerMonthCurrentYear ?? "" }}</div>
            <div class="report__header report__header--double report__header--google">{{ data.data.names.resultsFromBeginnerMonthPreviousYear }}</div>
            <div class="report__header report__header--double report__header--google">{{ lang['comparison'] }}</div>
            <div class="report__header report__header--double report__header--global">{{ data.data.names.avgResultMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--global">{{ data.data.names.avgResultMonthPreviousYear }}</div>
            <div class="report__header report__header--double report__header--global">{{ lang['comparison'] }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ data.data.names.resultsFromBeginnerMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ data.data.names.resultsFromBeginnerPreviousMonthCurrentYear }}</div>
            <div class="report__header report__header--double report__header--facebook">{{ lang['comparison'] }}</div>
        </div>

        <div class="report__content d-flex" v-if="data !== null & data !== undefined">
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthCurrentYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthCurrentYear['art']) }} szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthPreviousYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthPreviousYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value" :class="[data.data.resultsFromBeginnerMonthComparisonYear['value'] > 0 ? 'bg-success' : ''] + [data.data.resultsFromBeginnerMonthComparisonYear['value'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.resultsFromBeginnerMonthComparisonYear['value']) }} Eur</div>
                    <div class="report__value" :class="[data.data.resultsFromBeginnerMonthComparisonYear['art'] > 0 ? 'bg-success' : ''] + [data.data.resultsFromBeginnerMonthComparisonYear['art'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.resultsFromBeginnerMonthComparisonYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.avgResultMonthCurrentYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.avgResultMonthCurrentYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.avgResultMonthPreviousYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.avgResultMonthPreviousYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value" :class="[data.data.avgResultMonthComparisonYear['value'] > 0 ? 'bg-success' : ''] + [data.data.avgResultMonthComparisonYear['value'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.avgResultMonthComparisonYear['value']) }} Eur</div>
                    <div class="report__value" :class="[data.data.avgResultMonthComparisonYear['art'] > 0 ? 'bg-success' : ''] + [data.data.avgResultMonthComparisonYear['art'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.avgResultMonthComparisonYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthCurrentYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerMonthCurrentYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerPreviousMonthCurrentYear['value']) }} Eur</div>
                    <div class="report__value">{{ insertSpace(data.data.resultsFromBeginnerPreviousMonthCurrentYear['art']) }} Szt</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value" :class="[data.data.resultsFromBeginnerComparisonMonth['value'] > 0 ? 'bg-success' : ''] + [data.data.resultsFromBeginnerComparisonMonth['value'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.resultsFromBeginnerComparisonMonth['value']) }} Eur</div>
                    <div class="report__value" :class="[data.data.resultsFromBeginnerComparisonMonth['art'] > 0 ? 'bg-success' : ''] + [data.data.resultsFromBeginnerComparisonMonth['art'] < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(data.data.resultsFromBeginnerComparisonMonth['art']) }} Szt</div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
