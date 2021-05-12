<template lang="">
    <Layout :title="'Cadastro Matriz Curricular'">
        <div class="text-2xl mb-4">
            {{career.name}}
        </div>
        <hr>
        <Course-Curriculum-form :form="form" :axles="axles" @salvar="salvar"></Course-Curriculum-form>
    </Layout>
</template>

<script>

import Layout from '../../Layouts/Layout';
import CourseCurriculumForm from '../../Components/Forms/CourseCurriculumForm';

export default {
    components: {
        Layout,
        CourseCurriculumForm,
    },
    props: {
        errors: Object,
        career: Object,
        axles: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                total_minutes: 0,
                description: '',
                axles: [],
                career_id: this.career.id,
            })
        }
    },

    methods: {
        salvar() {
            // this.flashMessage.show({status: 'error', title: 'Error Message Title', message: 'Oh, you broke my heart! Shame on you!'})
           this.form.post(this.route('admin.curriculum.store'), {
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
