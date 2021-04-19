<template lang="">
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5 shadow">
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="col-span-4">
                        <label for="certificate_title">Titulo</label>
                        <input type="text" class="w-full" id="certificate_title" maxlength="100" required v-model="form.title" autofocus/>
                    </div>
                    <div class="col-span-4">
                        <label for="axle_description">Descrição</label>
                        <textarea   type="text"
                                    class="w-full"
                                    id="axle_description"
                                    rows="5"
                                    required
                                    v-model="form.description"></textarea>
                    </div>
                    <div class="col-span-4">
                        <input type="file" @input="form.archive = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                            {{ form.progress.percentage }}%
                        </progress>
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
        form: Object,
        careers: Array,
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
