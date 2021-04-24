<template lang="">
    <Layout :title="'Certificados'" :routeButton="'certificates.index'" :textButton="'Lista'">
        <Certificate-form :form="form" @salvar="salvar"></Certificate-form>
    </Layout>
</template>

<script>

import Layout from '../../Layouts/Layout';
import CertificateForm from '../../Components/Forms/CertificateForm';

export default {
    components: {
        Layout,
        CertificateForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                description: null,
                archive: null,
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('certificates.store'), {
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
