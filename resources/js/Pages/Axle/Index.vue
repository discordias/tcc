<template lang="">
    <Layout :title="'Eixos'" :routeButton="'eixo.create'" :textButton="'Cadastro'">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                            <th class="py-3 px-6">Nome</th>
                            <th class="py-3 px-6">Descrição</th>
                            <th class="py-3 px-6">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr v-for="axle in axles.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{axle.name}}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="">
                                    {{axle.description}}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <inertia-link
                                    class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-3 pr-3 py-2 font-bold"
                                    :href="this.route('eixo.edit', axle.id)"
                                    ><font-awesome-icon icon="edit" /></inertia-link>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="px-6 pb-4 bg-white">
                    <pagination :data="axles" />
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
    axles: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
