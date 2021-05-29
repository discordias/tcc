<template lang="">
    <Layout :title="`Certificados - Situação: ${currentTypeSituation.name}`" :routeButton="routeButton" :textButton="textButton" v-if="certificates.data.length > 0">
        <!-- component -->
        <div class="w-full overflow-x-scroll">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                            <th class="py-3 px-6">Titulo</th>
                            <!-- <th class="py-3 px-6">Situação</th> -->
                            <th class="py-3 px-6">Detalhes</th>
                            <th class="py-3 px-6" v-if="allowedEditCertificate(currentTypeSituation.id)">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr v-for="certificate in certificates.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{certificate.title}}
                                </div>
                            </td>
                            <!-- <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{certificate.type_situation.name}}
                                </div>
                            </td> -->
                            <td class="py-4 px-6 text-center">
                                <inertia-link
                                    class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                    :href="this.route('certificates.show', certificate.id)"
                                    ><span class="text-sm">Detalhes</span></inertia-link>
                                <a  :href="this.route('certificates.download', certificate.id)"
                                    target="_blank"
                                    class="text-white ml-2 text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                >PDF</a>
                            </td>
                            <td class="py-4 px-6 text-center" v-if="allowedEditCertificate(currentTypeSituation.id)">
                                <inertia-link
                                    class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                    :href="this.route('certificates.edit', certificate.id)"
                                    ><span class="text-sm">Editar</span></inertia-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="px-6 pb-4 bg-white">
                    <pagination :data="certificates" />
                </div>
            </div>
        </div>

    </Layout>

    <Layout :title="`Certificados - Situação: ${currentTypeSituation.name}`" v-if="certificates.data.length == 0">
                <div class="bg-yellow-100 border border-yellow-200 rounded my-6 ">
            <p class="py-3 px-10"> Não foi encontrado nenhum registro de documento em nosso banco de dados, caso queira cadastrar um documento por favor clique no botão "Cadastro" </p>
        </div>
        <div class="text-center py-3">
                <inertia-link
                class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                :href="this.route('certificates.create')"
                ><span fas fa-tv opacity-75 mr-2 text-sm>Cadastro</span>
                </inertia-link>
                </div>
    </Layout>

</template>

<script>
import Layout from "../../Layouts/Layout";
import Pagination from "../../Shared/Pagination";

export default {
  components: { Layout, Pagination },
  props: {
    certificates: Object,
    currentTypeSituation: Object,
  },
  data() {
    return {

         routeButton: "certificates.create", textButton: "Cadastro"

    };
  },
  methods: {
    allowedEditCertificate: function(typeSituationId) {
          return ![2, 3].includes(typeSituationId);
    },
  },
};
</script>

<style lang="">
</style>
