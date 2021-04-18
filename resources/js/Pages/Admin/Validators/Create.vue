<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Alunos
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('admin.validators.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Validator-form :form="form" @salvar="salvar"></Validator-form>
        </layout>
    </div>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import ValidatorForm from '../../../Components/Forms/ValidatorForm';

export default {
    components: {
        Layout,
        ValidatorForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('admin.validators.store'), {
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
