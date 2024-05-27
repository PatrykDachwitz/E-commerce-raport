<script setup>

</script>

<template>
    <div class="report d-flex flex-column">
        <div class="report__row--header d-flex">
            <div class="report__header">Sklep</div>
            <div class="report__header">1-15 maj 2024</div>
            <div class="report__header">1-15 maj 2023</div>
            <div class="report__header">Porównanie</div>
            <div class="report__header">Średnie wartości maj 2024</div>
            <div class="report__header">Średnie wartości maj 2023</div>
            <div class="report__header">Porównanie</div>
            <div class="report__header">1-15 kwiecień 2024</div>
            <div class="report__header">1-15 maj 2024</div>
            <div class="report__header">Porównanie</div>

        </div>

        <div class="report__content d-flex">
            <div class="report__col d-flex flex-column">
                <div class="report__row">
                    <div class="report__value report__value--double">Suma</div>
                </div>
                <div class="report__row" v-for="item in 25">
                    <div class="report__value report__value--double">Szwajcaria</div>
                </div>
            </div>
            <template v-for="itemsj in 3">
                <div class="report__row d-flex flex-column" v-for="jitemJ in 2">
                    <div class="report__col" v-for="item in 25">
                        <div class="report__value">€  984</div>
                        <div class="report__value">15 szt</div>
                    </div>
                </div>

                <div class="report__row d-flex flex-column">
                    <div class="report__col" v-for="item in 26">
                        <div class="report__value report__value--success">210%</div>
                        <div class="report__value report__value--danger">-210%</div>
                    </div>
                </div>

            </template>

        </div>

    </div>
</template>

<style scoped>

</style>
