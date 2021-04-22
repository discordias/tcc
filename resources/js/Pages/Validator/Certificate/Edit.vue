<template lang="">
    <div class="grid-cols-12">
        <Layout :title="'Certificados'" :routeButton="'validator.certificates.index'">
            <Certificate-details :certificate="certificate"></Certificate-details>
            <Validate-certificate-form :form="form" @salvar="salvar" :typeSituations="typeSituations" :axles="axles"></Validate-certificate-form>
        </Layout>
    </div>
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
        this.form = this.$inertia.form({...this.certificate,  archive: null});
    },
 }
</script>

<style lang="">

</style>
