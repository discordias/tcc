<template lang="">
    <Layout :title="'Cadastro de Aluno'">
        <div class="border border-gray-300 p-10 rounded shadow-md">
            <div class="w-full flex justify-center space-x-1 -mt-16">
                <button class="px-3 py-2 border-2 font-bold border-green-uniceplac focus:outline-none rounded-l-lg"
                        @click="changeCreateType('individual')"
                        v-bind:class="[type == 'individual' ? 'text-white bg-green-uniceplac' : 'text-green-uniceplac bg-white']">Individual</button>
                <button class="px-3 py-2 border-2 font-bold border-green-uniceplac rounded-r-lg focus:outline-none"
                        @click="changeCreateType('csv')"
                        v-bind:class="[type == 'csv' ? 'text-white bg-green-uniceplac' : 'text-green-uniceplac bg-white']">Importação CSV</button>
            </div>
            <Student-form v-if="type == 'individual'" :form="form" :careers="careers" @salvar="salvar"></Student-form>
            <Student-import-form v-if="type == 'csv'" :errors="errors" :careers="careers"></Student-import-form>
        </div>
    </Layout>
</template>

<script>

import Layout from '../../../Layouts/Layout';
import StudentForm from '../../../Components/Forms/StudentForm';
import StudentImportForm from '../../../Components/Forms/StudentImportForm';

export default {
    components: {
        Layout,
        StudentForm,
        StudentImportForm,
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
                course_curriculum_id: null,
            }),
            type: 'individual',
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
        },
        changeCreateType: function (type) {
            this.type = type;
            console.log(this.type);
        }
    },
 }
</script>

<style lang="">

</style>
