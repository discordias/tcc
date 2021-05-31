<template lang="">
    <Layout :title="`Relatórios`">
        <div class="w-full border border-green-uniceplac pb-4 mt-2 rounded-md">
            <div class="w-full bg-green-uniceplac  grid grid-cols-8 gap-4 p-4">
                {{currentSemester}}
                <!-- <div class="text-2xl text-white py-2 px-2 text-center mb-4">{{career.name}}</div> -->
                <div class="col-span-3">
                    <label class="text-white"> Cursos
                        <select v-on:change="filter()" class="w-full text-black" name="" id="" v-model="currentCareer">
                            <option v-for="career in careers" key="career.id" v-bind:value="career.id">{{career.name}}</option>
                        </select>
                    </label>
                </div>
                <div class="col-span-1">
                    <label class="text-white"> Ano
                        <select v-on:change="filter()" class="w-full text-black" name="" id="" v-model="currentYear">
                            <option v-for="year in years" key="year" v-bind:value="year">{{year}}</option>
                        </select>
                    </label>
                </div>
                <div class="col-span-1">
                    <label class="text-white"> Limite
                        <select v-on:change="filter()" class="w-full text-black" name="" id="" v-model="currentLimit">
                            <option v-for="limit in limits" key="limit" v-bind:value="limit">{{limit}}</option>
                        </select>
                    </label>
                </div>
                <div class="col-start-8 col-span-1 h-full flex justify-end align-center">
                    <a  :href="getRouteExport()"
                        target="_blank"
                        title="Exportar"
                        class="text-white text-center ml-2 flex h-10 capitalize rounded-md bg-green-500 hover:bg-green-600 pl-3 pr-3 py-2 font-bold"
                    ><font-awesome-icon icon="file-excel" /></a>
                </div>
            </div>
            <div class="w-full p-4">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                                <th class="py-3 px-6">Semestre Ingresso</th>
                                <th class="py-3 px-6">Nome</th>
                                <th class="py-3 px-6">Matricula</th>
                                <th class="py-3 px-6">E-mail</th>
                                <th class="py-3 px-6">Total realizada</th>
                                <th class="py-3 px-6">%</th>
                                <th class="py-3 px-6">Quantidade necessário</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="student in students.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-4 px-6 text-center">
                                        {{student.entry_semester}} / {{student.entry_year}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                        {{student.name}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                        {{student.registration_number}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                        {{student.email}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                        {{student.certificates_sum_validated_hours_in_minutes
                                            ? formatTimeByMinutes(student.certificates_sum_validated_hours_in_minutes)
                                            : '--'}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                        {{ student.course_curriculum.minutes_total
                                        ? (student.certificates_sum_validated_hours_in_minutes / student.course_curriculum.minutes_total) * 100
                                        : '--'}}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{student.course_curriculum.minutes_total
                                        ? formatTimeByMinutes(student.course_curriculum.minutes_total)
                                        : '--'}}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="px-6 pb-4 bg-white">
                        <pagination :data="students" />
                    </div>
                </div>
            </div>

        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import Pagination from "../../Shared/Pagination";

export default {
  components: { Layout, Pagination },
  props: {
    career: Object,
    students: Object,
    careers: Array,
    years: Array,
    currentYear: String,
    currentLimit: Number,
  },
  data() {
      return {
        currentCareer: '',
        limits: [10, 50, 100, 500],
    };
  },
  methods: {
      formatTimeByMinutes: function (totalMinutes) {
          const hours = Math.floor(totalMinutes / 60);
          const minutes = totalMinutes % 60;
          return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
      },
      filter: function () {
          this.$inertia.visit(this.route("report.certificates", {career_id: this.currentCareer, year: this.currentYear, limit: this.currentLimit}));
      },
      getRouteExport: function () {
          return this.route("report.certificates.export", {career_id: this.currentCareer, year: this.currentYear, limit: this.currentLimit});
      }
  },
  mounted: function (){
      this.currentCareer = this.career.id;
  }
};
</script>
