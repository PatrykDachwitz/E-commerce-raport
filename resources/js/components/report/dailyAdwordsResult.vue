<script setup>
import {insertSpace} from "../../utils/insertSpace.js";

defineProps([
    'result',
    "currency"
]);


</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.countClick.value) }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double" :class="[result.avgComparison.value > 0 ? 'bg-success' : ''] + [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']">{{ insertSpace(result.avgComparison.value) }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.avgLast30Day.value) }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.minValueLast30Day.value) }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ insertSpace(result.maxValueLast30Day.value) }} {{ currency ? 'Eur' : ''}}</div>
    </div>
</template>

<style scoped>

</style>
