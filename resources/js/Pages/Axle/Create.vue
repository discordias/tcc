<template lang="">
    <Layout :title="'Eixos'" :routeButton="'eixo.index'" :textButton="'Lista'">
        <Axle-form :form="form" @salvar="salvar"></Axle-form>
    </Layout>
</template>

<script>

import Layout from '../../Layouts/Layout';
import AxleForm from '../../Components/Forms/AxleForm';

export default {
    components: {
        Layout,
        AxleForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                description: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('eixo.store'), {
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
