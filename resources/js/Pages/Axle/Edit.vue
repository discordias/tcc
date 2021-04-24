<template lang="">
    <Layout :title="'Eixos'" :routeButton="'eixo.index'" :textButton="'Lista'">
        <Axle-form :form="form" @salvar="salvar"></Axle-form>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import AxleForm from "../../Components/Forms/AxleForm";

export default {
  components: {
    Layout,
    AxleForm,
  },
  props: {
    axle: {},
    errors: Object,
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    salvar() {
      this.form.put(this.route("eixo.update", this.axle.id), {
        onFinish: () => {
            if (!this.isEmpty(this.errors)) {
                alert(this.formatTextErrors(this.errors));
            } else {
                alert('Atualizado com sucesso');
            }
        },
      });
    },
  },

  mounted() {
    this.form = this.$inertia.form(this.axle);
  },
};
</script>

<style lang="">
</style>
