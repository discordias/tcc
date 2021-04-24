<template lang="">
    <Layout :title="'Atualização da Situação'" :routeButton="'typeSituations.index'" :textButton="'Lista'">
        <Type-situation-form :form="form" @salvar="salvar"></Type-situation-form>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import TypeSituationForm from '../../Components/Forms/TypeSituationForm';

export default {
  components: {
    Layout,
    TypeSituationForm,
  },
  props: {
    errors: Object,
    typeSituation: {},
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    salvar() {
      this.form.put(this.route("typeSituations.update", this.typeSituation.id), {
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
    this.form = this.$inertia.form(this.typeSituation);
  },
};
</script>

<style lang="">
</style>
