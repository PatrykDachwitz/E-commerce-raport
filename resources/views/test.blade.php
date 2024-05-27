
<div class="report d-flex flex-column">
<div class="d-flex">
    <div class="report__header report__header--double">Sklep</div>
    <div class="report__header report__header--double">Sprzedaż sklep</div>
    @foreach(4 as $item)
        <div>
            <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
            @foreach(4 as $item)
                <div>
                    <div class="report__header">Porównanie do średniej</div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
    <div class="report__content">
        @foreach(4 as $item)
            <div class="report__col">
                @foreach(4 as $item)
                    <div class="report__col" v-for="item in 25">
                        <div class="report__value report__value--danger">219%</div>
                        <div class="report__value report__value--success">219%</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="report__row d-flex flex-column">
        <div class="report__header report__header--double">Sklep</div>
        <div class="report__col" v-for="item in 25">
            <div class="report__value report__value--double">Szwajcaria</div>
        </div>
    </div>
    <div class="report__row d-flex flex-column">
        <div class="report__header report__header--double">Sprzedaż sklep</div>
        <div class="report__col" v-for="item in 25">
            <div class="report__value">€  984</div>
            <div class="report__value">15 szt</div>
        </div>
    </div>
    <div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value report__value--danger">219%</div>
                    <div class="report__value report__value--success">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div><div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">219%</div>
                    <div class="report__value">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div><div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">219%</div>
                    <div class="report__value">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div><div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">219%</div>
                    <div class="report__value">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div><div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">219%</div>
                    <div class="report__value">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div><div class="report__row d-flex flex-column">
        <div class="report__header">Porównanie sprzedaży z poprzednimi dniami</div>
        <div class="d-flex">
            <div class="flex-column">
                <div class="report__header">Porównanie do średniej</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">219%</div>
                    <div class="report__value">219%</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Śr wartość - ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najniższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>
            <div class="flex-column">
                <div class="report__header">Najwyższa wartość - Ostatnie 30 dni</div>
                <div class="report__col" v-for="item in 25">
                    <div class="report__value">€ 450</div>
                    <div class="report__value">7 szt</div>
                </div>
            </div>

        </div>

    </div>
</div>
