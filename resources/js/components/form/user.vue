<script setup>
import {inject} from "vue";

const lang = inject('lang');
</script>

<template>
    <form class="row g-3 needs-validation align-items-start" id="users" novalidate>
        <div class="col-md-1 form__input">
            <label for="validationCustom01" class="form-label">{{ lang.id }}</label>
            <input type="text" class="form-control" name="id" id="validationCustom01" placeholder="1" required>

        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom02" class="form-label">{{ lang.fullName }}</label>
            <input type="text" class="form-control" name="name" id="validationCustom02" :placeholder="lang.templateFullName" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-5 form__input">
            <label for="validationCustomUsername" class="form-label">{{ lang.email }}</label>
            <div class="input-group has-validation">
                <input type="email" class="form-control" name="email" id="validationCustomUsername" :placeholder="lang.templateEmail" required>
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustomUsername" class="form-label">{{ lang.password }}</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" name="password" id="validationCustomUsername" :placeholder="lang.password" required>
            </div>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustomUsername" class="form-label">{{ lang.confirmedPassword }}</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" name="password_confirmation" id="validationCustomUsername" :placeholder="lang.password" required>
            </div>
        </div>
        <div class="col-md-3 form__input">
            <label for="validationCustom04" class="form-label">{{ lang.userBanned }}</label>
            <select class="form-select" id="validationCustom04" name="banned" required>
                <option selected value="0">{{ lang.no }}</option>
                <option value="1">{{ lang.yes }}</option>
            </select>
        </div>
        <div class="col-md-3 form__input">
            <label for="validationCustom04" class="form-label">{{ lang.userRight }}</label>
            <select class="form-select" id="validationCustom04" name="user_right" required>
                <option selected value="1">{{ lang.read }}</option>
                <option value="2">{{ lang.editAndSave }}</option>
            </select>
        </div>
        <div class="col-md-6 form__input">
            <label for="validationCustom04" class="form-label">{{ lang.superAdmin }}</label>
            <select class="form-select" id="validationCustom04" name="super_admin" disabled>
                <option selected value="0">{{ lang.no }}</option>
                <option value="1">{{ lang.yes }}</option>
            </select>
        </div>

    </form>
</template>

<style scoped>

</style>
