<template lang="">
    <Layout :title="'Atualização do Validador'" :routeButton="'admin.validators.index'" :textButton="'Lista'">
        <Validator-form :form="form" @salvar="salvar"></Validator-form>
    </Layout>
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
