<template lang="">
    <Layout :title="'Cadastro de Aluno'">
        <Student-form :form="form" :careers="careers" @salvar="salvar"></Student-form>
    </Layout>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import StudentForm from '../../../Components/Forms/StudentForm';

export default {
    components: {
        Layout,
        StudentForm,
    },
    props: {
        errors: Object,
        careers: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                career_id: '',
                entry_year: '',
                entry_semester: '',
                registration_number: '',
            })
        }
    },

    methods: {
        salvar() {
           this.form.post(this.route('admin.students.store'), {
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
