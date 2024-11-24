<script setup>

import {inject, ref, watch} from "vue";
import {languages} from "@/utils/languages.js";

const langCommunicate = ref(languages('data-lang-communicates'));

const communicates = inject('communicates');

const srcImages = {
    info: '/assets/info.png',
    success: '/assets/check.png',
    danger: '/assets/waring.png',
}

function getTypeByCodeResponse(code) {
    if (code < 200) {
        return 'info';
    } else if(code >= 200 && code < 400) {
        return 'success';
    } else {
        return 'danger';
    }
}

function getSrcImageByCode(code) {
    let typeImage = getTypeByCodeResponse(code);

    return srcImages[typeImage];
}

function getCommunicate(code) {
    let responseCode = 500;

    if (code < 200) {
        responseCode = 100;
    } else if (code >= 200 && code < 300) {
        responseCode = 200;
    } else if (code >= 300 && code < 400) {
        responseCode = 300;
    } else if (code >= 400 && code < 500) {
        if (code === 401) {
            responseCode = 401;
        } else if (code === 403) {
            responseCode = 403;
        } else if (code === 404) {
            responseCode = 404;
        } else {
            responseCode = 400;
        }
    } else if (code === 503) {
        responseCode = 503
    } else if (code === 504) {
        responseCode = 504;
    }
    else {
        responseCode = 500;
    }

    return langCommunicate.value[responseCode];
}

function removeCommunicat(idCommunicat) {
    let communicat = document.querySelector(`[data-id-communicate="${idCommunicat}"]`);

    if (communicat !== null) {
        communicat.remove();
    }
}

watch(communicates, () => {

    setInterval(() => {
        removeCommunicat(communicates.value[communicates.value.length - 1].id);
    }, 5000);

}, {
    deep: true
})
</script>

<template>
<div class="communicate" v-if="communicates !== null">

    <template v-for="communicate in communicates" :key="communicate.id">

        <div :data-id-communicate="communicate.id" class="alert d-flex justify-content-between d-flex align-items-center" :class="`alert-${getTypeByCodeResponse(communicate.code)}`" role="alert">
            <img loading="lazy" :src="getSrcImageByCode(communicate.code)" width="20" height="20">
            <div class="mx-3">
                <h6 class="m-0">{{ communicate.code }}</h6>
                <p class="m-0">{{ getCommunicate(communicate.code) }}</p>
            </div>
            <img loading="lazy" @click="removeCommunicat(communicate.id)" src="/assets/close-black.png" width="20" height="20" class="pointer">
        </div>

    </template>

</div>
</template>

<style scoped>

</style>
