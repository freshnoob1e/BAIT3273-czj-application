<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Department
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-white rounded border border-gray-200 p-3" @submit.prevent="submitForm()">
                    <div class="space-y-2">
                        <div class="grid grid-cols-6 my-auto">
                            <div class="col-span-2">Department Title: </div>
                            <input type="text" class="col-span-4" v-model="form.title">
                            <div v-if="form.errors && form.errors.title"
                                class="col-span-6 text-red-500">
                                {{ form.errors.title }}
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

    data() {
        return {
            form: {},
            submitting: false,
        }
    },

    mounted(){
        this.form = useForm({
            title: '',
        });
    },

    methods: {
        submitForm(){
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.post('/department', {
                onFinish: () => {
                    this.submitting = false;
                }
            })
        }
    }
}
</script>
