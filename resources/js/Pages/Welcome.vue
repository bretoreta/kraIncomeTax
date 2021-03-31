<template>
    <div class="bg-gray-700 relative pb-10">
        <div class="px-10 md:px-32 py-5 bg-gray-800 shadow-lg">
            <div class="text-white">Income Tax Calculator</div>
        </div>
        <jet-validation-errors class="mb-4" />
        <div class="flex flex-col md:flex-row w-full px-6 md:px-32">
            <div class="w-full md:w-2/3 m-0 md:mr-4">
                <div class="py-5">
                    <div class="bg-gray-800 px-10 py-5">
                        <div class="text-white uppercase text-gray-400">Enter the details below to calculate the gross tax</div>
                        <div class="text-sm text-red-500 font-bold italic pt-3">* All fields are required</div>
                    </div>
                    <div class="form-inputs bg-white px-5 py-6">
                        <form @submit.prevent="submit" id="form">
                            <div>
                                <jet-label for="paye" value="PAYE" />
                                <jet-input id="paye" type="number" class="mt-1 block w-full" v-model="paye" required autofocus />
                            </div>

                            <div class="mt-4">
                                <jet-label for="reliefs" value="Reliefs" />
                                <jet-input id="reliefs" type="number" class="mt-1 block w-full" v-model="reliefs" required/>
                            </div>

                            <div class="mt-4">
                                <jet-label for="allowances" value="Allowances" />
                                <jet-input id="allowances" type="number" class="mt-1 block w-full" v-model="allowances" required/>
                            </div>

                            <div class="mt-4 flex space-x-4">
                                <jet-button>
                                    Calculate
                                </jet-button>
                                <danger-button @click="reset">
                                    Reset Form
                                </danger-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3">
                <div class="py-5">
                    <div class="bg-gray-800 px-10 py-5">
                        <div class="headers">
                            <div class="text-white uppercase text-gray-400" v-if="data">Here are the results for the calculation</div>
                            <div class="text-white uppercase text-gray-400" v-if="! data">Results will appear here after calculation</div>
                        </div>
                        <div v-if="data" class="body py-4">
                            <div class="bg-green-600 text-white px-4 py-2 mb-2">
                                <div class="font-bold">Gross Income : <span>{{ data.grossIncome }}</span></div>
                            </div>
                            <div class="bg-blue-600 text-white px-4 py-2 mb-2">
                                <div class="font-bold">Basic Salary : <span>{{ data.basicSalary }}</span></div>
                            </div>
                            <div class="bg-red-500 text-white px-4 py-2 mb-2">
                                <div class="font-bold">Gross Tax : <span>{{ data.grossTax }}</span></div>
                            </div>
                        </div>
                        <div v-if="! data" class="body pt-2">
                            <img src="/images/waiting.png" class="rounded-lg object-cover w-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    
</style>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import DangerButton from '../Jetstream/DangerButton.vue'

    export default {
        components: {
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
            DangerButton,
        },
        data() {
            return {
                paye: '',
                reliefs: '',
                allowances: '',
                data: null,
            }
        },
        methods: {
            submit() {
                axios.post('/calculate',{
                        paye: this.paye,
                        reliefs: this.reliefs,
                        allowances: this.allowances
                    })
                    .then(response => {
                        this.data = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            reset() {
                const form = document.querySelector('#form');

                form.reset();
                this.data = null;
            }
        }
    }
    
</script>
