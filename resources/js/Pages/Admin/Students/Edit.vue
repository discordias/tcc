<template lang="">
    <div class="grid-cols-12">
        <layout>
            <div class="flex justify-between">
                    <div class="text-white text-4xl">
                        Alunos
                    </div>
                    <inertia-link
                        class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                        :href="this.route('admin.students.index')"
                        ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                        Lista</inertia-link>
            </div>
            <Student-form :form="form" :careers="careers" @salvar="salvar"></Student-form>
        </layout>
    </div>
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
