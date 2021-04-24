<template lang="">
    <div class="w-full">
        <div class="bg-white rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">
                <div class="grid grid-cols-6 gap-4 mb-4">
                    <div class="col-span-2">
                        <label for="student_name">Nome</label>
                        <input type="text" class="w-full" id="student_name" maxlength="100" required v-model="form.name" autofocus/>
                    </div>
                    <div class="col-span-2">
                        <label for="student_email">E-mail</label>
                        <input type="email" class="w-full" id="student_email" maxlength="50" required v-model="form.email" autofocus/>
                    </div>
                    <div class="col-span-2">
                        <label for="careers">Cursos</label>
                        <select id="careers" class="w-full" required v-model="form.career_id">
                            <option v-for="career in careers" :key="career.id" v-bind:value="career.id">
                                {{ career.name }}
                            </option>
                        </select>
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
