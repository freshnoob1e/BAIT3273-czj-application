<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employee Detail ({{ employee.name }})
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded border border-gray-200 p-3">
                    <div class="flex justify-between">
                        <div class="flex mb-2">
                            <img src="https://via.placeholder.com/150" class="h-24 w-24 object-cover" v-if="employee.image == ''">
                            <img :src="employee.image" v-else class="h-24 w-24 object-cover">
                            <div class="ml-2">
                                <div class="text-xl font-semibold">{{ employee.name }}</div>
                                <div class="text-md text-gray-800 mt-2">Date joined: {{ employee.date_joined }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="flex-col flex space-y-2">
                                <Link class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                                px-2 py-1 text-white font-semibold text-lg"
                                        :href="route('employee.edit', {employee: employee.id})">
                                    Edit Employee Information
                                </Link>
                                <Link class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                                px-2 py-1 text-white font-semibold text-lg"
                                        :href="route('address.edit', {address: employee.address.id})"
                                        v-if="employee.address">
                                    Edit Employee Address
                                </Link>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3" />
                    <!-- Job descriptions -->
                    <div>
                        <div class="text-semibold font-semibold text-xl">Job Descriptions</div>
                        <div class="mt-2">
                            <span>Employee ID: </span>
                            <span class="text-gray-800">{{ employee.employee_id }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Job: </span>
                            <span class="text-gray-800">{{ employee.job.title }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Department: </span>
                            <span class="text-gray-800">{{ employee.job.department.title }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Description: </span><br/>
                            <span class="text-gray-800">{{ employee.job.description }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Work Type: </span>
                            <span class="text-gray-800">{{ employee.work_type }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Basic Salary: </span>
                            <span class="text-gray-800">RM{{ employee.basic_salary }}</span>
                        </div>
                    </div>

                    <hr class="my-3" />
                    <!-- Employee personal information -->
                    <div>
                        <div class="text-semibold font-semibold text-xl">Employee Information</div>
                        <div class="mt-2" v-if="employee.address">
                            <span>Address: </span>
                            <div>
                                {{ employee.address.street_one }}
                            </div>
                            <div>
                                {{ employee.address.street_two }}
                            </div>
                            <div>
                                {{ employee.address.postcode }},
                                {{ employee.address.state }}
                            </div>
                            <div>
                                {{ employee.address.country }}
                            </div>
                        </div>
                        <div class="mt-1">
                            <span>Contact Number: </span>
                            <span class="text-gray-800">{{ employee.contact_number }}</span>
                        </div>
                        <div class="mt-1">
                            <span>E-Mail: </span>
                            <span class="text-gray-800">{{ employee.email }}</span>
                        </div>
                        <div class="mt-1">
                            <span>Birth Date: </span>
                            <span class="text-gray-800">{{ employee.birth_date }}</span>
                        </div>
                        <div class="mt-2">
                            <span>Qualification: </span>
                            <span class="text-gray-800">{{ employee.qualification }}</span>
                        </div>
                    </div>
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
        Link
    },

    props: {
        employee: Object
    },

    mounted() {
        console.log(this.employee);
    }
}
</script>
