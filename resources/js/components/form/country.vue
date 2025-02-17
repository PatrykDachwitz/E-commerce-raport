<script setup>
import {inject} from "vue";

const lang = inject('lang');
</script>

<template>
    <form class="row g-3 needs-validation align-items-start" id="countries" novalidate>
        <div class="col-md-1 form__input">
            <label for="validationCustom01" class="form-label">{{ lang.id }}</label>
            <input type="text" class="form-control" name="id" id="validationCustom01" placeholder="1" required>

        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom02" class="form-label">{{ lang.country }}</label>
            <input type="text" class="form-control" name="name" id="validationCustom02" :placeholder="lang.country" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-5 form__input">
            <label for="validationCustom03" class="form-label">{{ lang.google }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="google" id="validationCustom03" :placeholder="lang.google" required>
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom04" class="form-label">{{ lang.idShop }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="shop" id="validationCustom04" :placeholder="lang.idShop">
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom05" class="form-label">{{ lang.facebook }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="facebook" id="validationCustom05" :placeholder="lang.facebook">
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom05" class="form-label">{{ lang.analytics }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="analytics" id="validationCustom05" :placeholder="lang.analytics">
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom05" class="form-label">{{ lang.googleDailyBudget }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="google_daily_budget" id="validationCustom05" :placeholder="lang.googleDailyBudget">
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom05" class="form-label">{{ lang.facebookDailyBudget }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" name="facebook_daily_budget" id="validationCustom05" :placeholder="lang.facebookDailyBudget">
            </div>
        </div>
        <div class="col-md-3 form__input">
            <label for="validationCustom06" class="form-label">{{ lang.resultSummary }}</label>
            <select class="form-select" id="validationCustom06" name="user_right" required>
                <option selected value="1">{{ lang.yes }}</option>
                <option value="0">{{ lang.no }}</option>
            </select>
        </div>
        <div class="col-md-3 form__input">
            <label for="validationCustom06" class="form-label">{{ lang.active }}</label>
            <select class="form-select" id="validationCustom06" name="active" required>
                <option selected value="1">{{ lang.yes }}</option>
                <option value="0">{{ lang.no }}</option>
            </select>
        </div>

    </form>
</template>

<style scoped>

</style>
