<template lang="">
    <div class="grid-cols-12">
        <layout >
            <div class="flex justify-between">
                    <div class="text-black text-4xl">
                        Certificados
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('certificates.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Certificate-form :form="form" @salvar="salvar"></Certificate-form>

        </layout>
    </div>
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
            console.log(this.form);
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
