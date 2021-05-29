<template lang="">
    <Layout :title="'Atualização do Validador'" :routeButton="'admin.validators.index'" :textButton="'Lista'">
        <div class="border border-gray-300 p-10 rounded shadow-md">
            <Validator-form :formValidator="formValidator" :careers="careers" @salvar="salvar"></Validator-form>
        </div>
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
        careers: Object,
    },
    data() {
        return {
            form: {},
            formValidator: {
                name: '',
                email: '',
                registration_number: '',
                careers_id: [],
            },
        }
    },

    methods: {
        salvar() {
            this.form = this.$inertia.form(this.formValidator);
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
