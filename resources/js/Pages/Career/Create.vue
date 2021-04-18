<template lang="">
    <div class="grid-cols-12">
        <layout >
            <div class="flex justify-between">
                    <div class="text-black text-4xl">
                        Cursos
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        href="/cursos"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Career-form :form="form" @salvar="salvar"></Career-form>
        </layout>
    </div>
</template>

<script>

import Layout from '../../Layouts/Layout';
import CareerForm from '../../Components/Forms/CareerForm';

export default {
    components: {
        Layout,
        CareerForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                code: '',
            })
        }
    },

    methods: {
        salvar() {
            // this.flashMessage.show({status: 'error', title: 'Error Message Title', message: 'Oh, you broke my heart! Shame on you!'})
           this.form.post(this.route('careers.store'), {
                onFinish: () => {
                    if (!this.isEmpty(this.errors)) {
                        this.toast(this.formatTextErrors(this.errors), {type: 'error'});
                    } else {
                        this.form.reset();
                        this.toast('Cadastrado com sucesso', {type: 'success'});
                    }
                },
            })
        }
    },
 }
</script>

<style lang="">

</style>
