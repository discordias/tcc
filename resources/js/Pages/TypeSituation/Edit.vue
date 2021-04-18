<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Situações
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('typeSituations.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Type-situation-form :form="form" @salvar="salvar"></Type-situation-form>
        </layout>
    </div>
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
