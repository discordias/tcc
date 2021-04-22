<template lang="">
    <div class="w-full">
        <div class="my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="certificate_type_situation_id">Situação</label>
                        <select id="certificate_type_situation_id" class="w-full" required v-model="form.type_situation_id">
                            <option v-bind:value="typeSituation.id" v-for="typeSituation in typeSituations" key="typeSituation.id">{{typeSituation.name}}</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label for="certificate_exle_id">Eixo</label>
                        <select id="certificate_exle_id" class="w-full" required v-model="form.axle_id">
                            <option v-bind:value="axle.id" v-for="axle in axles" key="axle.id">{{axle.name}}</option>
                        </select>
                    </div>

                    <div class="col-span-4">
                        <label for="certificate_observation">Observação</label>
                        <textarea   type="text"
                                    class="w-full"
                                    id="certificate_observation"
                                    rows="5"
                                    required
                                    v-model="form.observation"></textarea>
                    </div>
                </div>

                <div class="mt-4 w-full flex justify-end">
                    <input  type="submit"
                            class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer"
                            value="Validar">
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
    },
    data() {
        return {

        }
    },
    methods: {
        salvar() {
            this.$emit('salvar')
        }
    },
}
</script>
