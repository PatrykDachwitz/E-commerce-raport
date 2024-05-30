<script setup>
defineProps([
    'result'
]);

</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.cost.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.avgComparison.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.avgLast30Day.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.minValueLast30Day.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.maxValueLast30Day.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.costFromBeginningMonth.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.budgetMonth.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.percentCostFromBeginningMonth.value }}</div>
    </div>
</template>

<style scoped>

</style>
