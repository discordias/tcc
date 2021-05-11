<template lang="">
    <div class="w-full">
        <div class="bg-white rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">
                <div class="grid grid-cols-4 gap-4 mb-8 border border-gray-300 p-10 rounded shadow-md">
                    <div class="col-span-2">
                        <label for="total_minutes">Total de Horas</label>
                        <input type="number" v-bind:disabled="levelRegister == 2 ? true : false" step="1" class="w-full" id="total_minutes" required v-model="form.total_minutes" autofocus/>
                    </div>
                    <div class="col-span-2">
                        <label for="description">Descrição</label>
                        <input type="text" v-bind:disabled="levelRegister == 2 ? true : false" class="w-full" id="description" maxlength="50" required v-model="form.description" autofocus/>
                    </div>
                </div>

                <div class="flex justify-center mb-8">
                    <button @click="continueToLevel2()"
                            type="button"
                            class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer">
                                <font-awesome-icon icon="chevron-circle-down" />
                    </button>
                </div>


                <div v-if="levelRegister == 2" class="border border-gray-300 p-10 rounded shadow-md">
                    <div class="text-2xl p-4">
                        Divisão de Horas Por Eixo
                    </div>
                    <hr>

                    <div class="grid grid-cols-10 gap-4 mt-4 mb-4">
                        <div class="col-span-5">
                            <label>Eixo</label>
                            <select class="w-full" v-model="formAxle.axle">
                                <option v-for="axle in getAxles()" v-bind:value="axle" key="axle.id">{{axle.description}}</option>
                            </select>
                        </div>
                        <div class="col-span-5">
                            <label >Total de Horas:</label>
                            <input type="number" step="1" v-model="formAxle.total_minutes" class="w-full" placeholder="Total de Horas"/>
                        </div>
                    </div>
                </div>

                <div v-if="levelRegister == 2" class="flex justify-center mb-8">
                    <button
                        type="button"
                        @click="addAxle()"
                        class="px-3 py-2 text-white rounded-md bg-green-500 mt-6 hover:bg-green-600 cursor-pointer">
                            <font-awesome-icon icon="plus-square" />
                    </button>
                </div>

                <div v-if="levelRegister == 2" class="border border-gray-300 p-10 rounded shadow-md flex flex-col justify-center">
                    <div v-bind:class="id > 0 ? 'border-t border-gray-200' : ''" class="w-full text-center mt-4 pt-4 pb-2 " v-for="(axle, id) in form.axles" key="id">
                        <span> {{ axle.axle.name }} - {{axle.total_minutes}} </span>
                        <button
                            type="button"
                            @click="removeAxle(axle.axle.id)"
                            class="px-2 py-1 text-white rounded-md bg-red-500 ml-4 mt-6 hover:bg-red-600 cursor-pointer">
                                <font-awesome-icon icon="minus-circle" />
                        </button>
                    </div>
                </div>

                <div v-if="levelRegister == 2" class="mt-8 w-full flex justify-center">
                    <input  v-if="form.total_minutes == totalMinutesAdded && form.total_minutes != 0"
                            type="submit"
                            class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer"
                            value="Salvar">
                    <input  v-if="form.total_minutes != totalMinutesAdded || form.total_minutes == 0"
                            class="px-3 py-2 text-white rounded-md bg-gray-500 hover:bg-gray-600 cursor-not-allowed"
                            value="Salvar">
                </div>

            </form>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        form: Object,
        axles: Array,
    },
    data() {
        return {
            career: Object,
            levelRegister: 1,
            formAxle: {
                total_minutes: 0,
                axle: Object,
                id: null,
            },
            totalMinutesAdded: 0,
        }
    },
    methods: {
        salvar() {
            this.$emit('salvar')
        },
        addAxle: function () {
            const total = this.calculateCurrentTotalMinutes() + parseInt(this.formAxle.total_minutes);
            if (total > this.form.total_minutes) {
                this.toast('Não é possivel adicionar total maior que limite de horas', {type: 'error'});
                return;
            }

            this.totalMinutesAdded = total;
            this.formAxle.id = this.formAxle.axle.id;
            this.form.axles.push(this.formAxle);
            this.formAxle = {
                total_minutes: '',
                axle: Object,
                id: null,
            };
        },
        continueToLevel2: function() {
            if (this.form.total_minutes <= 0) {
                this.toast('Necessário informar total de horas', {type: 'error'});
                return;
            }

            if (this.form.description == '') {
                this.toast('Necessário informar descrição', {type: 'error'});
                return;
            }
            this.levelRegister = 2;
        },
        getAxles: function () {
            const axlesIdAdded = this.form.axles.map(a => a.id);
            this.totalMinutesAdded = this.calculateCurrentTotalMinutes();
            return this.axles.filter( axle => !axlesIdAdded.includes(axle.id));
        },
        removeAxle: function (axleId) {
            this.form.axles = this.form.axles.filter(axle => axle.id != axleId);
        },
        calculateCurrentTotalMinutes: function () {
            return this.form.axles.reduce((total, current) => total + parseInt(current.total_minutes), 0);
        },
    },
}
</script>
