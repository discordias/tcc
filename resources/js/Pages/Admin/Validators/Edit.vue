<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Validadores
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('admin.validators.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Validator-form :form="form" @salvar="salvar"></Validator-form>
        </layout>
    </div>
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
                this.toast('Cadastrado com sucesso', {type: 'success'});
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
