<template lang="">
    <Layout :title="'Cadastro de Validador'" :routeButton="'admin.validators.index'" :textButton="'Lista'">
        <Validator-form :form="form" @salvar="salvar"></Validator-form>
    </Layout>
</template>

<script>
import Layout from '../../../Layouts/Layout';
import ValidatorForm from '../../../Components/Forms/ValidatorForm';

export default {
  components: {
    Layout,
    ValidatorForm,
  },
  props: {
    errors: Object,
    validator: {},
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    salvar() {
      this.form.put(this.route("admin.validators.update", this.validator.id), {
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
    this.form = this.$inertia.form(this.validator);
  },
};
</script>

<style lang="">
</style>
