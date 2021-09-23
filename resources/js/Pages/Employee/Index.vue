<template>
    <app-header></app-header>
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px">
            <h2 class="text-left">All Employees <a href="/download/employee">( Download Employee List )</a></h2>
            <errors-and-messages :errors="errors"></errors-and-messages>
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </thead>
                <tbody>
                    <tr v-for="(employee,index) in employees">
                        <td>{{index+1}}</td>
                        <td>{{employee?.employee_name}}</td>
                        <td>{{employee?.email}}</td>
                        <td>{{employee?.phone}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center" v-if="employees?.length == 0">
                No employees found! <inertia-link :href="$route('employee.create')">Add Employee</inertia-link>
            </div>
        </div>
    </div>
</template>
<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import { usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed, inject } from "vue";

export default {
    name: "Posts",
    components: {
        ErrorsAndMessages,
        AppHeader
    },
    props: {
        errors: Object
    },
    setup() {
        const route = inject('$route');

        const employees = computed(() => usePage().props.value.employee);
        console.log(employees);


        return {
            employees
        }
    }
}

</script>
<style scoped>
.action-btn {
    margin-left: 12px;
    font-size: 13px;
}

.article {
    margin-top: 20px;
}

</style>
