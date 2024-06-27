<script setup>
defineProps([
    'result',
    "currency"
]);


</script>

<template v-if="result !== null">
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.countClick.value }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double" :class="[result.avgComparison.value > 0 ? 'bg-success' : ''] + [result.avgComparison.value < 0 ? 'bg-danger text-white' : '']">{{ result.avgComparison.value }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.avgLast30Day.value }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.minValueLast30Day.value }} {{ currency ? 'Eur' : ''}}</div>
    </div>
    <div class="report__col d-flex flex-column">
        <div class="report__value report__value--double">{{ result.maxValueLast30Day.value }} {{ currency ? 'Eur' : ''}}</div>
    </div>
</template>

<style scoped>

</style>
