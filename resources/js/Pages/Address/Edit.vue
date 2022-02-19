<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Address ({{ address.employee.name }})
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-white rounded border border-gray-200 p-3" @submit.prevent="submitForm()">
                    <div class="space-y-2">
                        <div class="text-2xl font-semibold">Address</div>
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
        address: Object
    },

    data() {
        return {
            form: {},
            submitting: false,
        }
    },

    mounted(){
        this.form = useForm({
            street_one: this.address.street_one,
            street_two: this.address.street_two,
            postcode: this.address.postcode,
            state: this.address.state,
            country: this.address.country,
        });
    },

    methods: {
        submitForm(){
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.patch(`/address/${this.address.id}`, {
                onFinish: () => {
                    this.submitting = false;
                }
            })
        }
    }
}
</script>
