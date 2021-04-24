<template lang="">
    <Layout :title="'Atualização do Aluno'" :routeButton="'admin.students.index'" :textButton="'Lista'">
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
    student: {},
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    salvar() {
      this.form.put(this.route("admin.students.update", this.student.id), {
        onFinish: () => {
            if (!this.isEmpty(this.errors)) {
                alert(this.formatTextErrors(this.errors));
            } else {
                if (this.$page.props.flash.success) {
                    this.toast(this.$page.props.flash.success, {type: 'success'});
                }
            }
        },
      });
    },
  },

  mounted() {
    this.form = this.$inertia.form(this.student);
  },
};
</script>

<style lang="">
</style>
