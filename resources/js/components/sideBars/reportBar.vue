<script setup>
import {useRouter} from "vue-router";
import {inject, ref, watch} from "vue";
import {getContent} from "@/utils/getContent.js";

const router = useRouter();
const nameRoute = router.currentRoute.value.name;
const lang = inject('lang');
const dateReport = inject('dateReport')
const viewHistory = ref(false);
const currentSearchDateInApi = ref(false);
const optionsReportDate = ref([
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
]);
const apiUrl = inject('apiUrl');

watch(dateReport, () => {
    console.log(dateReport.value)



});

function searchDateReport() {
    const dataReport = getContent(apiUrl + '/histories_report', false);

    console.log(dataReport)
}

searchDateReport();

function setOptionsHistory() {

}
function getSelectHistory() {
    return document.querySelector('div.history__select');
}

function getHeightToSearchNewDate(elementHeight) {
    const scrollHeight = elementHeight.scrollHeight;

    return scrollHeight * 0.8;
}
function isCloseScrollSelectHistoryEnd() {
    const historySelect = getSelectHistory();
    const heightToSearchNewDateReport = getHeightToSearchNewDate(historySelect)

    return (historySelect.scrollTop > heightToSearchNewDateReport);
}

function scrollDateHistory(event) {
    const historySelect = getSelectHistory();

    console.log(historySelect.scrollHeight)

    if (isCloseScrollSelectHistoryEnd()) {
        console.log('test')
    }
}


</script>

<template>
    <div class="d-flex ">
        <span>{{ lang[nameRoute] }}: </span>
        <div>
            <span class="history__title position-relative ms-2 pe-1"  @click="viewHistory = !viewHistory"> {{dateReport}} <img class="history__icon" src="/assets/arrow.png" width="20" height="25">
                <div class="history__select position-absolute" v-show="viewHistory" @mouseleave="viewHistory = false" @scroll="scrollDateHistory">
                    <button class="history__button">{{ dateReport }}</button>
                    <template v-for="optionDate in optionsReportDate">
                        <button class="history__button" :data-value="optionDate">{{ optionDate }}</button>
                    </template>
                </div>
            </span>
        </div>
    </div>
</template>

<style scoped>

</style>
