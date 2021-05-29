<template lang="">
    <Layout :title="'Detalhes do Aluno'">
        <div class="w-full p-4">
            <div class="text-4xl text-center">{{student.name}}</div>
            <div class="shadow-md p-6">
                <div class="mb-4">
                    <p><b>E-mail</b></p>
                    <p class="text-xl pl-4 text-gray-600">{{student.email}}</p>
                </div>
                <div class="mb-4">
                    <p><b>Matricula</b></p>
                    <p class="text-xl pl-4 text-gray-600">{{student.registration_number}}</p>
                </div>
                <div class="mb-4">
                    <p><b>Curso</b></p>
                    <p class="text-xl pl-4 text-gray-600">{{student.career.name}}</p>
                </div>
                <div class="mb-4">
                    <p><b>Total de Horas Necessárias</b></p>
                    <p class="text-xl pl-4 text-gray-600">{{formatTimeByMinutes(student.course_curriculum.minutes_total)}} hrs</p>
                </div>
            </div>
        </div>
        {{certificates}}
    </Layout>
</template>

<script>
import Layout from '../../../Layouts/Layout';

export default {
  components: {
    Layout,
  },
  props: {
    errors: Object,
    student: {},
    certificates: Object,
  },
  data() {
    return {
      form: {},
    };
  },

  methods: {
    formatTimeByMinutes: function (totalMinutes) {
        const hours = Math.floor(totalMinutes / 60);
        const minutes = totalMinutes % 60;
        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
    },
  },
};
</script>

<style lang="">
</style>
