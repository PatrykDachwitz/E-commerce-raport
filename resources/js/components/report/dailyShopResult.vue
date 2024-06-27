<script setup>
defineProps([
    'result'
]);
</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.shopSales.value }} Eur</div>
        <div class="report__value">{{ result.shopSales.art }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value" :class="[result.avgComparison.value > 0 ? 'bg-success' : ''] + [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']">{{ result.avgComparison.value }} Eur</div>
        <div class="report__value" :class="[result.avgComparison.art > 0 ? 'bg-success' : ''] + [result.avgComparison.art < 0 ? 'bg-danger text-white' : '']">{{ result.avgComparison.art }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.avgLast30Day.value }} Eur</div>
        <div class="report__value">{{ result.avgLast30Day.art }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.minValueLast30Day.value }} Eur</div>
        <div class="report__value">{{ result.minValueLast30Day.art }} Szt</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value">{{ result.maxValueLast30Day.value }} Eur</div>
        <div class="report__value">{{ result.maxValueLast30Day.art }} Szt</div>
    </div>
</template>

<style scoped>

</style>
