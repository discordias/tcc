<template lang="">
    <Layout :title="'Eixos'" :routeButton="'eixo.index'" :textButton="'Lista'">
        <Axle-form :form="form" @salvar="salvar"></Axle-form>
    </Layout>
</template>

<script>

import Layout from '../../Layouts/Layout';
import AxleForm from '../../Components/Forms/AxleForm';

export default {
    components: {
        Layout,
        AxleForm,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                description: '',
                archive: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('eixo.store'), {
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
