<script setup>
import {insertSpace} from "../../utils/insertSpace.js";

defineProps([
    'result'
]);
</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column report__col--active-col-country">
        <div class="report__value">{{ insertSpace(result.shopSales.value) }} Eur</div>
        <div class="report__value">{{ insertSpace(result.shopSales.art) }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value" :class="[result.avgComparison.value > 0 ? 'bg-success' : ''] + [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(result.avgComparison.value) }} Eur</div>
        <div class="report__value" :class="[result.avgComparison.art > 0 ? 'bg-success' : ''] + [result.avgComparison.art < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(result.avgComparison.art) }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ insertSpace(result.avgLast30Day.value) }} Eur</div>
        <div class="report__value">{{ insertSpace(result.avgLast30Day.art) }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ insertSpace(result.minValueLast30Day.value) }} Eur</div>
        <div class="report__value">{{ insertSpace(result.minValueLast30Day.art) }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ insertSpace(result.maxValueLast30Day.value) }} Eur</div>
        <div class="report__value">{{ insertSpace(result.maxValueLast30Day.art) }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.costShare.value }} %</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.comparisonClickToCost.value }} %</div>
    </div>
</template>

<style scoped>

</style>
