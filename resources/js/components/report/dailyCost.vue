<script setup>
defineProps([
    'result'
]);

</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.cost.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double"
             :class="
            [result.avgComparison.value > 0 ? 'bg-success' : '']
            +
            [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']
            "
        >{{ result.avgComparison.value }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.avgLast30Day.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.minValueLast30Day.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.maxValueLast30Day.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.costFromBeginningMonth.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.budgetMonth.value }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.percentCostFromBeginningMonth.value }}%</div>
    </div>
    <div class="report__col d-flex flex-column">
    </div>
</template>

<style scoped>

</style>
