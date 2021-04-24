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
        certificate: {},
        errors: Object,
    },
    data() {
        return {
            form: {},
        };
    },

    methods: {
        salvar() {
           this.form.post(this.route('certificates.update', this.certificate.id), {
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
    mounted() {
        const { description, title } =  this.certificate;
        this.form = this.$inertia.form({description, title, archive: null});
    },
 }
</script>

<style lang="">

</style>
