<template lang="">
    <Layout :title="'Certificados'">
        <Certificate-details :certificate="certificate"></Certificate-details>
        <Validate-certificate-form :form="form" @salvar="salvar" :typeSituations="typeSituations" :axles="axles"></Validate-certificate-form>
    </Layout>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import ValidateCertificateForm from '../../../Components/Forms/ValidateCertificateForm';
import CertificateDetails from '../../../Components/Details/CertificateDetails';

export default {
    components: {
        Layout,
        ValidateCertificateForm,
        CertificateDetails,
    },
    props: {
        certificate: {},
        typeSituations: Array,
        axles: Array,
        errors: Object,
    },
    data() {
        return {
            form: {},
        };
    },

    methods: {
        salvar() {
           this.form.post(this.route('validator.certificates.update', this.certificate.id), {
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
        this.form = this.$inertia.form({...this.certificate,  archive: null, validated_hours: 0, validated_minutes: 0});
    },
 }
</script>

<style lang="">

</style>
