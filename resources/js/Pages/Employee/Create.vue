<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-white rounded border border-gray-200 p-3" @submit.prevent="submitForm()">
                    <div class="space-y-2">
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Image: </div>
                            <input type="file" class="col-span-4" @input.prevent="form.image = $event.target.files[0]">
                            <div v-if="form.errors && form.errors.image"
                                class="col-span-6 text-red-500">
                                {{ form.errors.image }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Employee ID: </div>
                            <input type="text" class="col-span-4" v-model="form.employee_id">
                            <div v-if="form.errors && form.errors.employee_id"
                                class="col-span-6 text-red-500">
                                {{ form.errors.employee_id }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Employee Name: </div>
                            <input type="text" class="col-span-4" v-model="form.name">
                            <div v-if="form.errors && form.errors.name"
                                class="col-span-6 text-red-500">
                                {{ form.errors.name }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Department: </div>
                            <select class="col-span-2" v-model="form.department_id" @change.prevent="getJobsInDept()">
                                <option :value="dept.id" v-for="dept in this.departments" :key="dept">
                                    {{ dept.title }}
                                </option>
                            </select>
                            <div class="col-span-2 flex space-x-3">
                                <div class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                            px-2 py-1 text-white font-semibold text-lg cursor-pointer"
                                        @click.prevent="refreshDept()">
                                    Refresh
                                </div>
                                <Link class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                                px-2 py-1 text-white font-semibold text-lg"
                                        :href="route('departments')">
                                    Manage Departments
                                </Link>
                            </div>
                            <div v-if="form.errors && form.errors.department_id"
                                class="col-span-6 text-red-500">
                                {{ form.errors.department_id }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Job Title: </div>
                            <select class="col-span-2" v-model="form.job_id">
                                <option :value="job.id" v-for="job in this.jobs" :key="job">
                                    {{ job.title }}
                                </option>
                            </select>
                            <div class="col-span-2 flex space-x-3">
                                <div class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                            px-2 py-1 text-white font-semibold text-lg cursor-pointer"
                                        @click.prevent="refreshJobs()">
                                    Refresh
                                </div>
                                <Link class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                                px-2 py-1 text-white font-semibold text-lg"
                                        :href="route('jobs')">
                                    Manage Jobs
                                </Link>
                            </div>
                            <div v-if="form.errors && form.errors.job_id"
                                class="col-span-6 text-red-500">
                                {{ form.errors.job_id }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Date Joined: </div>
                            <input type="date" class="col-span-4" v-model="form.date_joined">
                            <div v-if="form.errors && form.errors.date_joined"
                                class="col-span-6 text-red-500">
                                {{ form.errors.date_joined }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Work Type: </div>
                            <select class="col-span-4" v-model="form.work_type">
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                            <div v-if="form.errors && form.errors.work_type"
                                class="col-span-6 text-red-500">
                                {{ form.errors.work_type }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Basic Salary: </div>
                            <input type="text" class="col-span-4" v-model="form.basic_salary">
                            <div v-if="form.errors && form.errors.basic_salary"
                                class="col-span-6 text-red-500">
                                {{ form.errors.basic_salary }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Contact Number: </div>
                            <input type="text" class="col-span-4" v-model="form.contact_number">
                            <div v-if="form.errors && form.errors.contact_number"
                                class="col-span-6 text-red-500">
                                {{ form.errors.contact_number }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">E-Mail: </div>
                            <input type="text" class="col-span-4" v-model="form.email">
                            <div v-if="form.errors && form.errors.email"
                                class="col-span-6 text-red-500">
                                {{ form.errors.email }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Birth Date: </div>
                            <input type="date" class="col-span-4" v-model="form.birth_date">
                            <div v-if="form.errors && form.errors.birth_date"
                                class="col-span-6 text-red-500">
                                {{ form.errors.birth_date }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Qualification: </div>
                            <input type="text" class="col-span-4" v-model="form.qualification">
                            <div v-if="form.errors && form.errors.qualification"
                                class="col-span-6 text-red-500">
                                {{ form.errors.qualification }}
                            </div>
                        </div>

                        <div class="text-lg font-semibold">Address</div>
                        <div class="grid grid-cols-6 my-auto gap-x-2">
                            <input type="text" class="col-span-6" v-model="form.street_one" placeholder="Street 1">
                            <div v-if="form.errors && form.errors.street_one"
                                class="col-span-6 text-red-500">
                                {{ form.errors.street_one }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto gap-x-2">
                            <input type="text" class="col-span-6" v-model="form.street_two" placeholder="Street 2">
                            <div v-if="form.errors && form.errors.street_two"
                                class="col-span-6 text-red-500">
                                {{ form.errors.street_two }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto gap-x-2">
                            <input type="text" class="col-span-3" v-model="form.postcode" placeholder="Postcode">
                            <input type="text" class="col-span-3" v-model="form.state" placeholder="State">
                            <div v-if="form.errors && form.errors.postcode"
                                class="col-span-3 text-red-500">
                                {{ form.errors.postcode }}
                            </div>
                            <div v-if="form.errors && form.errors.state"
                                class="col-span-3 text-red-500">
                                {{ form.errors.state }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto gap-x-2">
                            <input type="text" class="col-span-3" v-model="form.country" placeholder="Country">
                            <div v-if="form.errors && form.errors.country"
                                class="col-span-6 text-red-500">
                                {{ form.errors.country }}
                            </div>
                        </div>


                        <hr class="my-3" />
                        <button class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                    px-2 py-1 text-white font-semibold text-lg" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        Link,
    },

    props: {
        departments: Object,
        initialJob: Object,
    },

    data() {
        return {
            form: {},
            jobs: {},
            submitting: false,
        }
    },

    mounted(){
        this.form = useForm({
            image: null,
            department_id: this.departments[0].id,
            employee_id: '',
            name: '',
            job_id: '',
            date_joined: '',
            work_type: 'Full-Time',
            basic_salary: 0,
            contact_number: '',
            email: '',
            birth_date: '',
            qualification: '',
            street_one: '',
            street_two: '',
            postcode: '',
            state: '',
            country: ''
        });
        this.getJobsInDept();
    },

    methods: {
        getJobsInDept() {
            axios.get(`/api/deparment/${this.form.department_id}/jobs`)
                .then(res => {
                    this.jobs = res.data;
                    this.form.job_id = this.jobs[0].id;
                }).catch(e => {
                    console.log(e);
                });
        },

        submitForm(){
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.post('/employee', {
                onFinish: () => {
                    this.submitting = false;
                }
            })
        },
    }
}
</script>
