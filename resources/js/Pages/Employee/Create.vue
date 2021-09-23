<template>
    <app-header></app-header>
    <form method="post" @submit.prevent="submit" ref="employeeForm" @submit="checkForm">
        <h2 class="text-left">Add Employee</h2>
        <div class="row">
            <div class="col-md-6">
                <errors-and-messages :errors="errors"></errors-and-messages>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" id="email" v-model="employee.email" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" id="phone" v-model="employee.phone" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="status">Status</label>
                    <div class="col-sm-10">
                        <input type="checkbox" class="form-control" name="status" id="status" v-model="employee.status" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label text-right" for="language"><img :src="'https://flagcdn.com/24x18/'+(languages[selectedLang])+'.png'" :srcset="'https://flagcdn.com/48x36/'+(languages[selectedLang])+'.png 2x'" width="24" height="18"></label>
                    <div class="col-sm-10">
                        <select class="form-control" v-model="selectedLang" @change="setEmployeeForm($event.target.value)">
                            <option value="EN">English</option>
                            <option value="DE">Deutsche</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="employee_name">Employee Name</label>
                    <input type="text" class="form-control" id="employee_name" placeholder="Name" v-model="employee.employee_details[selectedLang].employee_name">
                </div>
                <div class="form-group">
                    <label for="street_address">Street Address</label>
                    <textarea class="form-control" id="street_address" placeholder="Address" v-model="employee.employee_details[selectedLang].street_address"></textarea>
                </div>
                <div class="form-group">
                    <label for="about_employee">About Employee</label>
                    <textarea class="form-control" id="about_employee" placeholder="About" v-model="employee.employee_details[selectedLang].about_employee"></textarea>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-block" value="Save" />
    </form>
</template>
<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import { inject, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    name: "Create",
    components: {
        ErrorsAndMessages,
        AppHeader
    },
    data: function() {
        return {
            selectedLang: 'EN',
            languages: {
                'EN': 'us',
                'DE': 'de'
            },
            employee: {
                email: null,
                phone: null,
                status: null,
                employee_details: {

                    'EN': {
                        employee_name: null,
                        street_address: null,
                        about_employee: null,
                    }

                },
            },
            details_form: {
                employee_name: null,
                street_address: null,
                about_employee: null,
            }
        }
    },

    methods: {
        submit() {
            // console.log(this.employee)
            Inertia.post(route('employee.store'), this.employee, {
                forceFormData: true,
                onSuccess: () => this.$refs.employeeForm.reset(),
            });
        },
        setEmployeeForm(lang) {
            if (!this.employee.employee_details[lang]) {
                this.employee.employee_details[lang] = this.details_form;
            }
            console.log(this.employee.employee_details);
        }
    },
}

</script>
<style scoped>
form {
    margin-top: 20px;
}

</style>
