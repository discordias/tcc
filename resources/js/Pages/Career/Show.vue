<template lang="">
    <Layout :title="career.name">
        <div class="flex items-center justify-center">
            <div class="bg-white rounded w-full">
                <h2 class="text-xl">
                    Certificados
                </h2>
                <div class="md:grid md:grid-cols-3 md:gap-4 space-y-4 md:space-y-0 mt-4">
                    <Card-situation v-for="typeSituation in typeSituations" key="typeSituation.id" :career="career" :typeSituation="typeSituation"></Card-situation>
                </div>
            </div>
        </div>

        <div class="w-full mt-10">
            <h2 class="text-xl">
                Alunos
            </h2>
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                            <th class="py-3 px-6">Nome</th>
                            <th class="py-3 px-6">E-mail</th>
                            <th class="py-3 px-6" v-if="$page.props.hasHole.admin">Editar</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr v-for="student in students.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{student.name}}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{student.email}}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center" v-if="$page.props.hasHole.admin">
                                <inertia-link
                                    class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                    :href="this.route('admin.students.edit', student.id)"
                                    ><span class="text-sm">Editar</span></inertia-link>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="px-6 pb-4 bg-white">
                    <pagination :data="students" />
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import Pagination from "../../Shared/Pagination";
import CardSituation from "../../Components/CardSituation";

export default {
  components: { Layout, Pagination, CardSituation },
  props: {
    career: Object,
    students: Object,
    typeSituations: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
