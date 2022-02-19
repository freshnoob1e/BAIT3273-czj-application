<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Job
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-white rounded border border-gray-200 p-3" @submit.prevent="submitForm()">
                    <div class="space-y-2">
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Department: </div>
                            <select class="col-span-2" v-model="form.department_id">
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
                            <input type="text" class="col-span-4" v-model="form.title">
                            <div v-if="form.errors && form.errors.title"
                                class="col-span-6 text-red-500">
                                {{ form.errors.title }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Description: </div>
                            <input type="text" class="col-span-4" v-model="form.description">
                            <div v-if="form.errors && form.errors.description"
                                class="col-span-6 text-red-500">
                                {{ form.errors.description }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Minimum Basic: </div>
                            <input type="text" class="col-span-4" v-model="form.minimum_basic">
                            <div v-if="form.errors && form.errors.minimum_basic"
                                class="col-span-6 text-red-500">
                                {{ form.errors.minimum_basic }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Maximum Basic: </div>
                            <input type="text" class="col-span-4" v-model="form.maximum_basic">
                            <div v-if="form.errors && form.errors.maximum_basic"
                                class="col-span-6 text-red-500">
                                {{ form.errors.maximum_basic }}
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
    },

    data() {
        return {
            form: {},
            submitting: false,
        }
    },

    mounted(){
        this.form = useForm({
            department_id: this.departments[0].id,
            title: '',
            description: '',
            minimum_basic: 0,
            maximum_basic: 0,
        });
    },

    methods: {
        submitForm(){
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.post('/job', {
                onFinish: () => {
                    this.submitting = false;
                }
            })
        }
    }
}
</script>
