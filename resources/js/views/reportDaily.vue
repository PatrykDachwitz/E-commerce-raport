<script setup>

</script>

<template>
    <div class="report d-flex flex-column">
        <div class="report__row--header d-flex">
            <div class="report__header report__header--double">Sklep</div>
            <div class="report__header report__header--double">Sprzedaż sklep</div>
            <template v-for="item in 4">
                <div class="d-flex flex-column">
                    <div class="report__header w-100">Porównanie sprzedaży z poprzednimi dniami</div>
                    <div class="d-flex">
                        <template v-for="jitem in 4">
                            <div class="report__header">Porównanie do średniej</div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="report__content d-flex">
            <div class="report__col d-flex flex-column">
                <div class="report__row" v-for="item in 25">
                    <div class="report__value report__value--double">Szwajcaria</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column">
                <div class="report__row" v-for="item in 25">
                    <div class="report__value report__value--success">210%</div>
                    <div class="report__value report__value--danger">-210%</div>
                </div>
            </div>
            <div class="report__col d-flex flex-column" v-for="jitemJ in 16">
                <div class="report__row" v-for="item in 25">
                    <div class="report__value">€  984</div>
                    <div class="report__value">15 szt</div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
