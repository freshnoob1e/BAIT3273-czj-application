<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Employee Detail ({{ employee.name }})
            </h2>
        </template>

        <div class="py-12">
            <form class="max-w-5xl mx-auto sm:px-6 lg:px-8" @submit.prevent="submitForm()">
                <div class="bg-white rounded border border-gray-200 p-3">
                    <div class="space-y-2">
                        <div class="text-2xl font-semibold">Job</div>
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
                    </div>
                    <hr class="my-3" />
                    <div>
                        <div class="text-2xl font-semibold">Information</div>
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
                    </div>
                    <hr class="my-3" />
                    <button class="bg-indigo-700 rounded hover:bg-indigo-500 transition
                                    px-2 py-1 text-white font-semibold text-lg" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout';
export default {
    components: {
        AppLayout,
        Link,
    },

    props: {
        employee: Object,
        jobs: Object,
    },

    mounted() {
        this.form = useForm({
            image: null,
            employee_id: this.employee.employee_id,
            job_id: this.employee.job.id,
            work_type: this.employee.work_type,
            basic_salary: this.employee.basic_salary.toFixed(2),
            contact_number: this.employee.contact_number,
            email: this.employee.email,
            birth_date: this.employee.birth_date,
            qualification: this.employee.qualification,
            _method: 'patch'
        });
    },

    data() {
        return {
            submitting: false,
            form : {},
        }
    },

    methods: {
        submitForm(){
            if(this.submitting)
                return;
            this.submitting = true;

            this.form.post(`/employee/${this.employee.id}`, {
                onFinish: () => {
                    this.submitting = false;
                    console.log(this.form);
                }
            });
        }
    }
}
</script>
