<template>
    <app-layout title="Manage Job">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Job
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded border border-gray-200 p-3">
                    <!-- Action bar -->
                    <div class="border rounded bg-gray-100 p-3">
                        <div class="flex justify-between">
                            <form class="flex" @submit.prevent="searchJob">
                                <div class="my-auto">Search Job: </div>
                                <input type="text" class="rounded ml-1" v-model="searchData">
                                <button type="submit"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                                text-white text-semibold
                                                hover:bg-indigo-500">
                                    Search
                                </button>
                            </form>
                            <div class="my-auto">
                                <Link :href="route('job.create')"
                                        class="rounded px-2 py-2 bg-indigo-700 ml-2
                                            text-white text-semibold
                                            hover:bg-indigo-500">
                                    Add Job
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Job table -->
                    <table class="border mt-6 w-full">
                        <thead class="bg-gray-100">
                            <th class="border border-gray-400">#</th>
                            <th class="border border-gray-400">Job Title</th>
                            <th class="border border-gray-400">Department</th>
                            <th class="border border-gray-400">Description</th>
                            <th class="border border-gray-400">Min Basic</th>
                            <th class="border border-gray-400">Max Basic</th>
                        </thead>
                        <tbody v-if="showJob.length > 0">
                            <tr v-for="(job, index) in showJob" :key="index"
                                :class="index % 2 == 0 ?
                                        {'bg-gray-300': true} :
                                        {'bg-gray-200': true}">
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                    <Link :href="route('job.edit', {job: job.id})">
                                        {{ job.id }}
                                    </Link>
                                </td>
                                <td class="border border-gray-400 p-1 underline hover:text-stone-800 transition">
                                    <Link :href="route('job.edit', {job: job.id})">
                                        {{ job.title }}
                                    </Link>
                                </td>
                                <td class="border border-gray-400 p-1">{{ job.department.title }}</td>
                                <td class="border border-gray-400 p-1">{{ job.description }}</td>
                                <td class="border border-gray-400 p-1">RM{{ job.minimum_basic.toFixed(2) }}</td>
                                <td class="border border-gray-400 p-1">RM{{ job.maximum_basic.toFixed(2) }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <td colspan="6">
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
        jobs: Object
    },

    data(){
        return {
            searchData: '',
            searching: false,
            currentSearch: '',
            showJob: {},
        }
    },

    mounted(){
        this.showJob = this.jobs;
        console.log(this.jobs);
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
                    this.showJob = res.data;
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
