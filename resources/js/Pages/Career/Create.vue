<template lang="">
    <Layout :title="'Cadastro de Curso'" :routeButton="'careers.index'" :textButton="'Lista'">
        <Career-form :form="form" @salvar="salvar"></Career-form>
    </Layout>
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
                        if (this.$page.props.flash.success) {
                            this.toast(this.$page.props.flash.success, {type: 'success'});
                        }
                    }
                },
            })
        }
    },
 }
</script>

<style lang="">

</style>
