<template lang="">
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5 shadow">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="axle_name">Nome</label>
                        <input type="text" class="w-full" id="axle_name" maxlength="100" required v-model="form.name" autofocus/>
                    </div>
                </div>
                <div>
                    <label for="axle_description">Descrição</label>
                    <textarea   type="text"
                                class="w-full"
                                id="axle_description"
                                rows="5"
                                required
                                v-model="form.description"></textarea>
                </div>

                <div class="mt-4 w-full flex justify-end">
                    <input  type="submit"
                            class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer"
                            value="Salvar">
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        form: Object
    },
    data() {
        return {

        }
    },
    methods: {
        salvar() {
            // console.log(this.form);
            this.$emit('salvar', { minhaMsg: 'a'})
            // emit('salvar');
            // this.form.post(this.route('eixo.store'), {
            //     onFinish: () => this.form.reset(),
            // })
        }
    },
    // mounted() {
    //     console.log(this.form);
    // }
}
</script>
