<script setup>

import {getContentReport} from "@/utils/getContentReport.js";
import {useRoute} from "vue-router";
import {inject, watch} from "vue";
import DailyShopResult from "@/components/report/dailyShopResult.vue";
import DailyAdwordsResult from "@/components/report/dailyAdwordsResult.vue";
import DailyCost from "@/components/report/dailyCost.vue";

const route = useRoute();
const apiUrl = inject('apiUrl');
const lang = inject('lang');

const { data, error } = getContentReport(`${apiUrl}${route.path}?date=2024-06-25`);

const nameHeaderResult = [
  'global',
  'google',
  'facebook',
];
const nameHeaderCost = [
  'google',
  'facebook',
];

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
                    <div class="report__header report__header--shop--secondary">{{ lang['avgLast30Day'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['minLast30Day'] }}</div>
                    <div class="report__header report__header--shop--secondary">{{ lang['maxLast30Day'] }}</div>
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
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['avgLast30Day'] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['minLast30Day'] }}</div>
                        <div :class="`report__header report__header--${nameHeader}--secondary`">{{ lang['maxLast30Day'] }}</div>
                    </div>
                </div>
            </template>
            <template v-for="nameHeader in nameHeaderCost">
                <div class="d-flex flex-column">
                    <div :class="`report__header w-100 report__header&#45;&#45;${nameHeader}`">{{ lang['nameHeader'][nameHeader] }} - {{ lang['costs'] }}</div>
                    <div class="d-flex">
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['spentAmount'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['comparisonToAvg'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['avgLast30Day'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['minLast30Day'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['maxLast30Day'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['costFromBeginningMonth'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['budgetMonth'] }}</div>
                        <div :class="`report__header report__header&#45;&#45;${nameHeader}&#45;&#45;secondary`">{{ lang['percentCostFromBeginningMonth'] }}</div>
                    </div>
                </div>
            </template>
        </div>

        <div class="report__content d-flex flex-column" v-if="data !== null">
            <template v-for="result in data.data">
                <div class="report__row d-flex">

                    <div class="report__col d-flex flex-column">
                        <div class="report__value report__value--double">{{ result.country }}</div>
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
