<script setup>
import {insertSpace} from "../../utils/insertSpace.js";

defineProps([
    'result'
]);

</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.cost.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double"
             :class="
            [result.avgComparison.value > 0 ? 'bg-success' : '']
            +
            [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']
            "
        >{{ insertSpace(result.avgComparison.value) }}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.avgLast30Day.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.minValueLast30Day.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.maxValueLast30Day.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.costFromBeginningMonth.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.budgetMonth.value) }} PLN</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.percentCostFromBeginningMonth.value }}%</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.percentDaysPassedInCurrentMonth.value }}%</div>
    </div>
</template>

<style scoped>

</style>
