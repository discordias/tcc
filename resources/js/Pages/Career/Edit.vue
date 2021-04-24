<template lang="">
    <Layout :title="'Atualização do Curso'" :routeButton="'careers.index'" :textButton="'Lista'">
        <Career-form :form="form" @salvar="salvar"></Career-form>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import CareerForm from '../../Components/Forms/CareerForm';

export default {
  components: {
    Layout,
    CareerForm,
  },
  props: {
    career: {},
    errors: Object,
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    salvar() {
      this.form.put(this.route("careers.update", this.career.id), {
        onFinish: () => {
            if (!this.isEmpty(this.errors)) {
                this.toast(this.formatTextErrors(this.errors), {type: 'error'});
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
    this.form = this.$inertia.form(this.career);
  },
};
</script>

<style lang="">
</style>
