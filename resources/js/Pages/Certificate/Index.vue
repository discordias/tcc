<template lang="">
    <layout>
        <div class="flex justify-between">
            <div class="text-white text-4xl">
                Cursos
            </div>
            <inertia-link
              class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
              :href="this.route('certificates.create')"
              ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
              Cadastro</inertia-link>
        </div>

        <!-- component -->
            <div class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                                <th class="py-3 px-6">Titulo</th>
                                <th class="py-3 px-6">Descrição</th>
                                <th class="py-3 px-6">Status</th>
                                <th class="py-3 px-6">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="certificate in certificates.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{certificate.title}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{certificate.description}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{certificate.type_situation.name}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <inertia-link
                                        class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                        :href="this.route('certificates.edit', certificate.id)"
                                        ><span class="text-sm">Editar</span></inertia-link>
                                    <a  :href="this.route('certificates.download', certificate.id)"
                                        class="text-white ml-2 text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                    >Download</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="px-6 pb-4 bg-white">
                        <pagination :data="certificates" />
                    </div>
                </div>
            </div>

    </layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import Pagination from "../../Shared/Pagination";

export default {
  components: { Layout, Pagination },
  props: {
    certificates: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
