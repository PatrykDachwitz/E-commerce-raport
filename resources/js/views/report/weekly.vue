<script setup>

import {getContent} from "@/utils/getContent.js";
import {useRoute} from "vue-router";
import {inject, onMounted, watch} from "vue";
import DailyShopResult from "@/components/report/dailyShopResult.vue";
import DailyAdwordsResult from "@/components/report/dailyAdwordsResult.vue";
import DailyCost from "@/components/report/dailyCost.vue";
import {
    changePositionCountryName,
    changePositionTableHeader
} from "@/utils/changePositionToFixed.js";
import {getContentToJson} from "@/utils/getContentToJson.js";

const route = useRoute();
const apiUrl = inject('apiUrl');
const lang = inject('lang');

const { data, error } = getContent(`${apiUrl}${route.path}`, false);

const nameHeaderResult = [
  'global',
  'google',
  'facebook',
];
const nameHeaderCost = [
  'google',
  'facebook',
];
const dateReport = inject('dateReport')

const selectDateReport = inject('selectDateReport')

onMounted(() => {
    changePositionTableHeader('report__row--header', "report", 'report__row--first');
    changePositionCountryName('report__value--country-name', 'report__content', "report", 'report__col--active-col-country');
})


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
        <div class="report__row--header d-flex">
            <div class="report__header report__header--double report__header--shop--name">{{ lang['shop'] }}</div>
            <div class="report__header report__header--double report__header--shop">{{ lang['shopSales'] }}</div>
            <div class="d-flex flex-column">
                <div class="report__header w-100 report__header--shop">{{ lang['shopSalesComparison'] }}</div>
                <div class="d-flex">
                    <div class="report__header report__header--shop--secondary">{{ lang['comparisonToAvg'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['avgLast4Week'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['minLast4Week'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['maxLast4Week'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['costShare'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['comparisonClickToCost'] }}</div>
                </div>
            </div>

            <template v-for="nameHeader in nameHeaderResult">
                <div class="d-flex flex-column">
                    <div :class="`report__header w-100 report__header--${nameHeader}`">{{ lang['nameHeader'][nameHeader] }} - {{ lang['moveShop'] }}</div>
                    <div class="d-flex">
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['countClick'] }} - {{ lang['nameHeader'][nameHeader] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['comparisonToAvg'] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['avgLast4Week'] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['minLast4Week'] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['maxLast4Week'] }}</div>
                    </div>
                </div>
            </template>
            <template v-for="nameHeader in nameHeaderCost">
                <div class="d-flex flex-column">
                    <div :class="`report__header w-100 report__header&#45;&#45;${nameHeader}`">{{ lang['nameHeader'][nameHeader] }} - {{ lang['costs'] }}</div>
                    <div class="d-flex">
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['spentAmount'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['comparisonToAvg'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['avgLast4Week'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['minLast4Week'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['maxLast4Week'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['costFromBeginningMonth'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['budgetMonth'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['percentCostFromBeginningMonth'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['percentDaysPassedInCurrentMonth'] }}</div>
                    </div>
                </div>
            </template>
        </div>

        <div class="report__content d-flex flex-column" v-if="data !== null & data !== undefined">
            <template v-for="(result, key) in data.data">
                <div class="report__row  d-flex" :class="[key === 0 ? 'report__row--first' : null]">

                    <div class="report__col d-flex flex-column report__value--country-name">
                        <div class="report__value report__value--double text-center">{{ lang[result.country] ?? result.country }}</div>
                    </div>

                    <daily-shop-result :result="result.shop" />
                    <daily-adwords-result :curency="false" :result="result.global" />
                    <daily-adwords-result :result="result.google" />
                    <daily-adwords-result :result="result.facebook" />
                    <daily-cost :result="result.costGoogle" />
                    <daily-cost :result="result.costFacebook" />
                </div>

            </template>
        </div>

    </div>
</template>

<style scoped>

</style>
