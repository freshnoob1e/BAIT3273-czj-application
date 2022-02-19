<template>
    <app-layout title="Payments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded border border-gray-200 p-3">
                    <!-- Action bar -->
                    <div class="border rounded bg-gray-100 p-3">
                        <div class="flex justify-between">
                            <form class="flex" @submit.prevent="searchPayment">
                                <div class="my-auto">Search Payment ID: </div>
                                <input type="text" class="rounded ml-1" v-model="searchData">
                                <button type="submit"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                                text-white text-semibold
                                                hover:bg-indigo-500">
                                    Search
                                </button>
                            </form>
                            <div class="my-auto">
                                <Link :href="route('payment.create')"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                            text-white text-semibold
                                            hover:bg-indigo-500">
                                    Add Payment
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Payments table -->
                    <table class="border mt-6 w-full">
                        <thead class="bg-gray-100">
                            <th class="border border-gray-400">Payment ID</th>
                            <th class="border border-gray-400">Employee Name</th>
                            <th class="border border-gray-400">Hours Worked</th>
                            <th class="border border-gray-400">Overtimes</th>
                            <th class="border border-gray-400">Payment Date</th>
                            <th class="border border-gray-400">Evaluation Score</th>
                            <th class="border border-gray-400">Payment Amount</th>
                        </thead>
                        <tbody v-if="showPayments && showPayments.length > 0">
                            <tr v-for="(payment, index) in showPayments" :key="index"
                                :class="index % 2 == 0 ?
                                        {'bg-gray-300': true} :
                                        {'bg-gray-200': true}">
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                        {{ payment.id }}
                                </td>
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                    <Link :href="route('employee.show', {employee: payment.employee.id})">
                                        {{ payment.employee.name }}
                                    </Link>
                                </td>
                                <td class="border border-gray-400 p-1">{{ payment.hours_worked }} Hours</td>
                                <td class="border border-gray-400 p-1">{{ payment.overtime_worked }} Hours</td>
                                <td class="border border-gray-400 p-1">{{ new Date(payment.payment_date) }}</td>
                                <td class="border border-gray-400 p-1">
                                    {{
                                        (payment.evaluation.performance +
                                         payment.evaluation.communication +
                                         payment.evaluation.teamwork +
                                         payment.evaluation.dedication +
                                         payment.evaluation.personality) / 5
                                     }}/10
                                </td>
                                <td class="border border-gray-400 p-1">
                                    <div>RM{{ payment.amount }}</div>
                                    <div class="text-red-400" v-if="payment.bonus > 0">
                                        Bonus: RM{{ payment.bonus }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td colspan="7">
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
        payments: Object
    },

    data(){
        return {
            searchData: '',
            searching: false,
            currentSearch: '',
            showPayments: {},
        }
    },

    mounted(){
        this.showPayments = this.payments;
        console.log(this.payments);
    },

    methods: {
        searchJob() {
            if(this.searching)
                return;

            this.searching = true;

            let searchTerm = this.searchData;
            this.currentSearch = searchTerm;
            if(searchTerm === ''){
                searchTerm = 'all';
                this.currentSearch = '';
            }


            axios.get(`/api/jobs/${searchTerm}`)
                .then(res => {
                    this.showPayments = res.data;
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
