<script setup>
import {inject} from "vue";

const lang = inject('lang');
</script>

<template>
    <form class="row g-3 needs-validation align-items-end" novalidate>
        <div class="col-md-1">
            <label for="validationCustom01" class="form-label">{{ lang.id }}</label>
            <input type="text" class="form-control" id="validationCustom01" placeholder="1" required>

        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">{{ lang.fullName }}</label>
            <input type="text" class="form-control" id="validationCustom02" :placeholder="lang.templateFullName" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-5">
            <label for="validationCustomUsername" class="form-label">{{ lang.email }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationCustomUsername" :placeholder="lang.templateEmail" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustomUsername" class="form-label">{{ lang.password }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationCustomUsername" :placeholder="lang.password" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustomUsername" class="form-label">{{ lang.confirmedPassword }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationCustomUsername" :placeholder="lang.password" required>
            </div>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">{{ lang.userBanned }}</label>
            <select class="form-select" id="validationCustom04" required>
                <option selected value="0">{{ lang.no }}</option>
                <option value="1">{{ lang.yes }}</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">{{ lang.userRight }}</label>
            <select class="form-select" id="validationCustom04" required>
                <option selected value="1">{{ lang.read }}</option>
                <option value="2">{{ lang.editAndSave }}</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="validationCustomUsername" class="form-label">{{ lang.superAdmin }}</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationCustomUsername" :value="lang.password" disabled>
            </div>
        </div>

    </form>
</template>

<style scoped>

</style>
