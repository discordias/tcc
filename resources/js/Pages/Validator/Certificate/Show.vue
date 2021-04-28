<template lang="">
    <Layout :title="'Detalhes Certificado'">
        <Certificate-details :certificate="certificate"></Certificate-details>
    </Layout>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import CertificateDetails from '../../../Components/Details/CertificateDetails';

export default {
    components: {
        Layout,
        CertificateDetails,
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
    },
    mounted() {
    },
 }
</script>

<style lang="">

</style>
