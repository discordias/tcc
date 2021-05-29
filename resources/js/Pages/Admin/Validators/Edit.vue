<template lang="">
    <Layout :title="'Cadastro de Validador'" :routeButton="'admin.validators.index'" :textButton="'Lista'">
        <div class="border border-gray-300 p-10 rounded shadow-md">
            <Validator-form :formValidator="formValidator" :careers="careers" @salvar="salvar"></Validator-form>
        </div>
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
    careers: Object,
  },
  data() {
    return {
      form: {},
      formValidator: {},
    };
  },

  methods: {
    salvar() {
      this.form = this.$inertia.form(this.formValidator);
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
    // this.form = this.$inertia.form({...{careers: [1, 2]},...this.validator});
    this.formValidator = {...this.validator};
  },
};
</script>

<style lang="">
</style>
