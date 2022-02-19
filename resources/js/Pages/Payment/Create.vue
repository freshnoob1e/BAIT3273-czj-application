<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Payment
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-white rounded border border-gray-200 p-3" @submit.prevent="submitForm()">
                    <div>
                        <div class="text-2xl font-semibold">Employee</div>

                        <div class="flex mt-2">
                            <form @submit.prevent="filterSelect()">
                                <input type="text" @change="filterSelect()" placeholder="Filter Employee..."
                                        v-model="searchEmployee">
                            </form>
                            <select v-model="form.employee_id" @change="calcAmount()">
                                <option :value="employee.id" v-for="employee in showEmployees" :key="employee">
                                    {{ employee.name }}
                                </option>
                            </select>
                        </div>

                        <div v-if="employees[form.employee_id]" class="mt-2">
                            <div>
                                <span class="text-semibold">Employee Name: </span>
                                <span class="text-gray-800">{{ employees[form.employee_id].name }}</span>
                            </div>
                            <div>
                                <span class="text-semibold">Employee ID: </span>
                                <span class="text-gray-800">{{ employees[form.employee_id].employee_id }}</span>
                            </div>
                            <div>
                                <span class="text-semibold">Job: </span>
                                <span class="text-gray-800">{{ employees[form.employee_id].job.title }}</span>
                            </div>
                            <div>
                                <span class="text-semibold">Basic Salary: </span>
                                <span class="text-gray-800">RM{{ employees[form.employee_id].basic_salary }}</span>
                            </div>
                        </div>

                        <hr class="my-5" />

                        <div class="text-2xl font-semibold">Payment Details</div>
                        <div class="grid grid-cols-6 my-auto mt-2">
                            <div class="col-span-2">Hours Worked: </div>
                            <input type="text" class="col-span-4" v-model="form.hours_worked" @change="calcAmount()">
                            <div v-if="form.errors && form.errors.hours_worked"
                                class="col-span-6 text-red-500">
                                {{ form.errors.hours_worked }}
                            </div>
                        </div>
                        <div class="grid grid-cols-6 my-auto mt-2">
                            <div class="col-span-2">Overtimes Worked: </div>
                            <input type="text" class="col-span-4" v-model="form.overtime_worked" @change="calcAmount()">
                            <div v-if="form.errors && form.errors.overtime_worked"
                                class="col-span-6 text-red-500">
                                {{ form.errors.overtime_worked }}
                            </div>
                        </div>

                        <hr class="my-5" />

                        <div class="text-2xl font-semibold">Employee Evaluation</div>
                        <div class="mt-4">
                            <div class="text-xl">Performance: </div>
                            <div class="text-lg text-gray-800">Work efficiently and intelligently.</div>
                            <div class="flex justify-between">
                                <div v-for="(score) in 10" :key="score" class="flex flex-col">
                                    <label class="text-center font-semibold" :for="'performance'+(score.toString())">{{ score }}</label>
                                    <input type="radio" :value="score" :id="'performance'+(score.toString())" name="performance" v-model="form.performance" @change="calcAmount()"/>
                                </div>
                            </div>
                            <div v-if="form.errors && form.errors.performance"
                                class=" text-red-500">
                                {{ form.errors.performance }}
                            </div>
                        </div>
                        <div class="mt-10">
                            <div class="text-xl">Communication: </div>
                            <div class="text-lg text-gray-800">Good at communicating and conveying messages to others.</div>
                            <div class="flex justify-between">
                                <div v-for="(score) in 10" :key="score" class="flex flex-col">
                                    <label class="text-center font-semibold" :for="'communication'+(score.toString())">{{ score }}</label>
                                    <input type="radio" :value="score" :id="'communication'+(score.toString())" name="communication" v-model="form.communication" @change="calcAmount()"/>
                                </div>
                            </div>
                            <div v-if="form.errors && form.errors.communication"
                                class=" text-red-500">
                                {{ form.errors.communication }}
                            </div>
                        </div>
                        <div class="mt-10">
                            <div class="text-xl">Teamwork: </div>
                            <div class="text-lg text-gray-800">Works well with fellow emplyees without friction.</div>
                            <div class="flex justify-between">
                                <div v-for="(score) in 10" :key="score" class="flex flex-col">
                                    <label class="text-center font-semibold" :for="'teamwork'+(score.toString())">{{ score }}</label>
                                    <input type="radio" :value="score" :id="'teamwork'+(score.toString())" name="teamwork" v-model="form.teamwork" @change="calcAmount()"/>
                                </div>
                            </div>
                            <div v-if="form.errors && form.errors.teamwork"
                                class=" text-red-500">
                                {{ form.errors.teamwork }}
                            </div>
                        </div>
                        <div class="mt-10">
                            <div class="text-xl">Dedication: </div>
                            <div class="text-lg text-gray-800">Reports to work on time and uses time constructively.</div>
                            <div class="flex justify-between">
                                <div v-for="(score) in 10" :key="score" class="flex flex-col">
                                    <label class="text-center font-semibold" :for="'dedication'+(score.toString())">{{ score }}</label>
                                    <input type="radio" :value="score" :id="'dedication'+(score.toString())" name="dedication" v-model="form.dedication" @change="calcAmount()"/>
                                </div>
                            </div>
                            <div v-if="form.errors && form.errors.dedication"
                                class=" text-red-500">
                                {{ form.errors.dedication }}
                            </div>
                        </div>
                        <div class="mt-10">
                            <div class="text-xl">Personality: </div>
                            <div class="text-lg text-gray-800">Demonstrates pleasant, calm personality when dealing with customers and employees.</div>
                            <div class="flex justify-between">
                                <div v-for="(score) in 10" :key="score" class="flex flex-col">
                                    <label class="text-center font-semibold" :for="'personality'+(score.toString())">{{ score }}</label>
                                    <input type="radio" :value="score" :id="'personality'+(score.toString())" name="personality" v-model="form.personality" @change="calcAmount()"/>
                                </div>
                            </div>
                            <div v-if="form.errors && form.errors.personality"
                                class=" text-red-500">
                                {{ form.errors.personality }}
                            </div>
                        </div>

                        <hr class="my-5" />

                        <div class="text-2xl font-semibold">Amount Payable</div>
                        <div class="mt-4">
                            <span class="text-xl">Average Score: </span>
                            <span class="text-xl font-semibold">{{ avgScore }}/10</span>
                        </div>
                        <div class="mt-4">
                            <span class="text-xl">Elligible for bonus?: </span>
                            <span class="text-xl font-semibold">{{ hasBonus ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="mt-3">
                            <span class="text-xl">Amount (incld. bonus): </span>
                            <span class="text-xl font-semibold">RM{{ payable.toFixed(2) }}</span>
                        </div>
                        <div class="mt-3" v-if="this.hasBonus">
                            <span class="text-xl">Bonus Amount: </span>
                            <span class="text-xl font-semibold">RM{{ bonus.toFixed(2) }}</span>
                        </div>

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
        employees: Object,
        bonusAmount: Number,
        bonusScore: Number,
        bonusHour: Number,
    },

    data() {
        return {
            form: {},
            submitting: false,
            showEmployees: {},
            employeesArray: {},
            searchEmployee: '',
            filtering: false,
            hasBonus: false,
            bonus: 0,
            payable: 0,
            avgScore: 0,
        }
    },

    mounted(){
        this.employeesArray = Object.keys(this.employees).map((index) => {
            return {
                id: this.employees[index].id,
                name: this.employees[index].name,
            }
        });
        this.showEmployees = this.employeesArray;

        this.form = useForm({
            employee_id: this.employees[0].id,
            hours_worked: 0,
            overtime_worked: 0,
            performance: 5,
            communication: 5,
            teamwork: 5,
            dedication: 5,
            personality: 5
        });

        this.calcAmount();
    },

    methods: {
        filterSelect(){
            if(this.filtering)
                return;

            this.filtering = true;

            this.showEmployees = this.employeesArray.filter((employee) => {
                if(employee.name.includes(this.searchEmployee)){
                    console.log('yes');
                    return employee;
                }
            })

            console.log(this.form.employee_id);

            setTimeout(()=>{this.filtering = false;}, 250)
        },

        calcAmount(){
            let avg = (this.form.performance + this.form.communication + this.form.personality
                        + this.form.dedication + this.form.teamwork) / 5;
            this.avgScore = avg;
            if(!this.employees[this.form.employee_id]){
                this.hasBonus = false;
                this.payable = 0;
                this.bonus = 0;
                return;
            }

            let basic = this.employees[this.form.employee_id].basic_salary;
            if(parseInt(this.form.hours_worked) < 1 || parseInt(this.form.overtime_worked) < 1){
                this.hasBonus = false;
                this.payable = basic;
                this.bonus = 0;
                return;
            }


            let totalHour = parseInt(this.form.overtime_worked) + parseInt(this.form.hours_worked);
            if(this.avgScore >= this.bonusScore && totalHour >= this.bonusHour){
                this.hasBonus = true;
            } else {
                this.hasBonus = false;
            }

            if(this.hasBonus){
                let total = basic * this.bonusAmount;
                this.bonus = total-basic;
                this.payable = total;
            } else {
                this.bonus = 0;
                this.payable = basic;
            }
        },

        submitForm(){
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.post('/pay', {
                onFinish: () => {
                    this.submitting = false;
                    console.log(this.form);
                }
            });
        }
    }
}
</script>
