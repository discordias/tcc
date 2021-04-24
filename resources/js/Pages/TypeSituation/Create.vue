<template lang="">
    <Layout :title="'Cadastro de Situação'" :routeButton="'typeSituations.index'" :textButton="'Lista'">
        <Type-situation-form :form="form" @salvar="salvar"></Type-situation-form>
    </Layout>
</template>

<script>

import Layout from '../../Layouts/Layout';
import TypeSituationForm from '../../Components/Forms/TypeSituationForm';

export default {
    components: {
        Layout,
        TypeSituationForm,
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
           this.form.post(this.route('typeSituations.store'), {
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
