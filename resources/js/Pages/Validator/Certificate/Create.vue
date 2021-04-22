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
