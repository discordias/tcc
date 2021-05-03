<template lang="">
    <div class="w-full mt-10">
        <div class="my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">


                <div class="border border-gray-300 p-10 rounded shadow-md">

                    <div class="w-full flex justify-center space-x-1 -mt-16">
                        <button class="px-3 py-2 border-2 font-bold border-green-uniceplac focus:outline-none rounded-l-lg"
                                @click="changeValidateType(true)"
                                v-bind:class="[toApprove ? 'text-white bg-green-uniceplac' : 'text-green-uniceplac bg-white']">Validar</button>
                        <button class="px-3 py-2 border-2 font-bold border-orange-uniceplac rounded-r-lg focus:outline-none"
                                @click="changeValidateType(false)"
                                v-bind:class="[toApprove ? 'text-orange-uniceplac bg-white' : 'text-white bg-orange-uniceplac']">Negar</button>
                    </div>

                    <div v-if="toApprove" class="w-full flex justify-center flex-wrap mb-5 mt-16 space-x-1">

                        <div class="mb-4 text-center lg:text-left">
                            <label for="certificate_validated_hours">Horas</label>
                            <input type="number" step="1" min="0" required id="certificate_validated_hours" class="w-full" v-model="form.validated_hours" />
                        </div>

                        <div class="mb-4 text-center lg:text-left">
                            <label for="certificate_validated_minutes">Minutos</label>
                            <input type="number" step="1" min="0" max="59" required id="certificate_validated_minutes" class="w-full" v-model="form.validated_minutes" />
                        </div>

                        <div class="flex-grow mb-4 text-center lg:text-left">
                            <label for="certificate_exle_id">Eixo</label>
                            <select id="certificate_exle_id" class="w-full" required v-model="form.axle_id">
                                <option v-bind:value="axle.id" v-for="axle in axles" key="axle.id">{{axle.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="toApprove" class="grid grid-cols-6 gap-4 mb-4">

                        <div class="col-span-6 text-center lg:text-left">
                            <label for="certificate_observation">Observação</label>
                            <textarea   type="text"
                                        class="w-full"
                                        id="certificate_observation"
                                        rows="5"
                                        v-model="form.observation"></textarea>
                        </div>
                    </div>

                    <div v-if="!toApprove" class="grid grid-cols-6 gap-4 mb-4">
                        <div class="col-span-6 text-center lg:text-left">
                            <label for="certificate_observation">Observação</label>
                            <textarea   type="text"
                                        class="w-full"
                                        id="certificate_observation"
                                        rows="5"
                                        required="required"
                                        v-model="form.observation"></textarea>
                        </div>
                    </div>

                    <div class="mt-4 w-full flex justify-center">
                        <input  type="submit"
                                class="px-3 py-2 text-white rounded-md bg-green-uniceplac hover:bg-green-600 cursor-pointer"
                                value="Salvar">
                    </div>

                </div>
            </form>

        </div>
    </div>
</template>

<script>

export default {
    props: {
        form: Object,
        typeSituations: Array,
        axles: Array,
        errors: Object,
    },
    data() {
        return {
            toApprove: true,
            routeString: 'validator.certificates.accept',
        }
    },
    methods: {
        salvar() {
            this.form.post(this.route(this.routeString, this.form.id), {
                onFinish: () => {
                    if (!this.isEmpty(this.errors)) {
                        this.toast(this.formatTextErrors(this.errors), {type: 'error'});
                    } else {
                        this.form.reset();
                        if (this.$page.props.flash.success) {
                            this.toast(this.$page.props.flash.success, {type: 'success'});
                        }
                    }
                },
            })
        },
        changeValidateType: function (value) {
            this.toApprove = value;
            if (value == true) {
                this.routeString = 'validator.certificates.accept';
            } else {
                this.routeString = 'validator.certificates.deny';
            }
        }
    },
}
</script>
