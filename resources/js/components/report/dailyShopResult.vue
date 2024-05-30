<script setup>
defineProps([
    'result'
]);
</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.shopSales.value }}</div>
        <div class="report__value">{{ result.shopSales.art }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.avgComparison.value }}</div>
        <div class="report__value">{{ result.avgComparison.art }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.avgLast30Day.value }}</div>
        <div class="report__value">{{ result.avgLast30Day.art }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.minValueLast30Day.value }}</div>
        <div class="report__value">{{ result.minValueLast30Day.art }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.maxValueLast30Day.value }}</div>
        <div class="report__value">{{ result.maxValueLast30Day.art }}</div>
    </div>
</template>

<style scoped>

</style>
