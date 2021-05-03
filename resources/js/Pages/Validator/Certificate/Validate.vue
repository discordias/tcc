<template lang="">
    <Layout :title="'Certificados'">
        <Certificate-details :certificate="certificate"></Certificate-details>
            <Validate-certificate-form :errors="errors" :form="form" @salvar="salvar" :typeSituations="typeSituations" :axles="axles"></Validate-certificate-form>
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

    },
    mounted() {
        this.form = this.$inertia.form({...this.certificate,  archive: null, validated_hours: 0, validated_minutes: 0});
    },
 }
</script>

<style lang="">

</style>
