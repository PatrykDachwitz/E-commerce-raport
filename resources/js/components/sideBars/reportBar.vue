<script setup>
import {useRouter} from "vue-router";
import {inject, onMounted, ref, watch} from "vue";
import {getContentToJson} from "@/utils/getContentToJson.js";

const router = useRouter();
const nameRoute = router.currentRoute.value.name;
const lang = inject('lang');
const dateReport = inject('dateReport')
const viewHistory = ref(false);
const currentPageHistory = ref(0);
const optionsReportDate = ref([]);
const apiUrl = inject('apiUrl');
const selectDateReport = inject('selectDateReport')

function getTypeReport() {
    switch (nameRoute) {
        case "report-daily":
            return "result-day";
            break;
        case "weekly":
            return "result-week";
            break;
        case "report-comparison":
            return "comparison-day";
            break;
        default:
            return "result-day";
            break;
    }
}

function getUrlHistoryPage() {
    let urlApi = apiUrl + '/histories_report?order=desc&type=' + getTypeReport()
    if (currentPageHistory.value !== 0) {
        urlApi += `&page=${currentPageHistory.value}`
    }

    return urlApi;
}

async function searchDateReport() {
    let urlApi = getUrlHistoryPage();

    currentPageHistory.value++;
    setOptionsHistory(await getContentToJson(urlApi, false));

}

function setOptionsHistory(data) {
    data.data.forEach(item => {
        optionsReportDate.value.push(item.date)
    })


}



onMounted(()=>{searchDateReport();})

</script>

<template>
    <div class="d-flex ">
        <span>{{ lang[nameRoute] }}: </span>
        <div>
            <span class="history__title position-relative ms-2 pe-1"  @click="viewHistory = !viewHistory"> {{dateReport}} <img class="history__icon" src="/assets/arrow.png" width="20" height="25">
                <div class="history__select position-absolute" v-show="viewHistory" @mouseleave="viewHistory = false">
                    <button class="history__button">{{ dateReport }}</button>
                    <template v-for="optionDate in optionsReportDate">
                        <button class="history__button" :data-value="optionDate" @click="selectDateReport = optionDate">{{ optionDate }}</button>
                    </template>
                </div>
            </span>
        </div>
    </div>
</template>

<style scoped>

</style>
