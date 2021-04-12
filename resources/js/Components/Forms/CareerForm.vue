<template lang="">
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5 shadow">
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="career_name">Nome</label>
                        <input type="text" class="w-full" id="career_name" maxlength="100" required v-model="form.name" autofocus/>
                    </div>
                    <div class="col-span-2">
                        <label for="career_code">Código</label>
                        <input type="text" class="w-full" id="career_code" maxlength="50" required v-model="form.code" autofocus/>
                    </div>
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
            this.$emit('salvar', { minhaMsg: 'a'})
        }
    },
}
</script>
