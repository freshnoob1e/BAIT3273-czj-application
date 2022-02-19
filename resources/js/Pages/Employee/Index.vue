<template>
    <app-layout title="Manage Employee">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded border border-gray-200 p-3">
                    <!-- Action bar -->
                    <div class="border rounded bg-gray-100 p-3">
                        <div class="flex justify-between">
                            <form class="flex" @submit.prevent="searchEmployee">
                                <div class="my-auto">Search Employee: </div>
                                <input type="text" class="rounded ml-1" v-model="searchData">
                                <button type="submit"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                                text-white text-semibold
                                                hover:bg-indigo-500">
                                    Search
                                </button>
                            </form>
                            <div class="my-auto">
                                <Link :href="route('employee.create')"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                            text-white text-semibold
                                            hover:bg-indigo-500">
                                    Add Employee
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Employee table -->
                    <table class="border mt-6">
                        <thead class="bg-gray-100">
                            <th class="border border-gray-400">#</th>
                            <th class="border border-gray-400">Employee ID</th>
                            <th class="border border-gray-400">Name</th> <!-- name with email -->
                            <th class="border border-gray-400">Job</th>
                            <th class="border border-gray-400">Joined</th>
                            <th class="border border-gray-400">Qualification</th>
                            <th class="border border-gray-400">Work Type</th>
                            <th class="border border-gray-400">Basic</th>
                            <th class="border border-gray-400">Contact Number</th>
                        </thead>
                        <tbody v-if="showEmployees.length > 0">
                            <tr v-for="(employee, index) in showEmployees" :key="index"
                                :class="index % 2 == 0 ?
                                        {'bg-gray-300': true} :
                                        {'bg-gray-200': true}">
                                <td class="text-center p-1 border border-gray-400">{{ employee.id }}</td>
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                    <Link :href="route('employee.show', {employee: employee.id})">
                                        {{ employee.employee_id }}
                                    </Link>
                                </td>
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                    <Link :href="route('employee.show', {employee: employee.id})">
                                        {{ employee.name }}<br />({{ employee.email }})
                                    </Link>
                                </td>
                                <td class="border border-gray-400 p-1">{{ employee.job.title }}</td>
                                <td class="border border-gray-400 p-1">{{ employee.date_joined }}</td>
                                <td class="border border-gray-400 p-1">{{ employee.qualification }}</td>
                                <td class="border border-gray-400 p-1">{{ employee.work_type }}</td>
                                <td class="border border-gray-400 p-1">RM{{ (employee.basic_salary).toFixed(2) }}</td>
                                <td class="border border-gray-400 p-1">{{ employee.contact_number }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td colspan="9">
                                <div class="text-xl text-center">
                                    No item to show...
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Link,
    },

    props: {
        employees: Object
    },

    data(){
        return {
            searchData: '',
            searching: false,
            currentSearch: '',
            showEmployees: {},
        }
    },

    mounted(){
        this.showEmployees = this.employees;
    },

    methods: {
        searchEmployee() {
            if(this.searching)
                return;

            this.searching = true;

            let searchTerm = this.searchData;
            this.currentSearch = searchTerm;
            if(searchTerm === ''){
                searchTerm = 'all';
                this.currentSearch = '';
            }


            axios.get(`/api/employees/${searchTerm}`)
                .then(res => {
                    this.showEmployees = res.data;
                })
                .catch(e => {
                    console.log(e);
                })
                .finally(() => {
                    this.searching = false;
                })

        }
    }
}
</script>
