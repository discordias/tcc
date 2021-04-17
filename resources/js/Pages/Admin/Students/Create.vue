<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Alunos
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('admin.students.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Student-form :form="form" :careers="careers" @salvar="salvar"></Student-form>
        </layout>
    </div>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import StudentForm from '../../../Components/Forms/StudentForm';

export default {
    components: {
        Layout,
        StudentForm,
    },
    props: {
        errors: Object,
        careers: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                career_id: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('admin.students.store'), {
                onFinish: () => {
                    if (!this.isEmpty(this.errors)) {
                        alert('Erro aqui ' + this.formatTextErrors(this.errors));
                    } else {
                        this.form.reset();
                        alert('Cadastrado com sucesso');
                    }
                },
            })
        }
    },
 }
</script>

<style lang="">

</style>
