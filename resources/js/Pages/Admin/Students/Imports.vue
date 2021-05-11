<template lang="">
    <Layout :title="'Importação de Alunos'" :routeButton="'admin.students.create'" :textButton="'Cadastro'">
        <div class="border border-gray-300 p-10 rounded shadow-md">

            <div class="w-full flex justify-center space-x-1 -mt-16">
                <button class="px-3 py-2 border-2 font-bold border-green-uniceplac focus:outline-none rounded-l-lg"
                        @click="changeType('registred')"
                        v-bind:class="[type == 'registred' ? 'text-white bg-green-uniceplac' : 'text-green-uniceplac bg-white']">Cadastrados</button>
                <button class="px-3 py-2 border-2 font-bold border-green-uniceplac rounded-r-lg focus:outline-none"
                        @click="changeType('errors')"
                        v-bind:class="[type == 'errors' ? 'text-white bg-green-uniceplac' : 'text-green-uniceplac bg-white']">Naõ Cadastrados</button>
            </div>

            <div v-if="type == 'registred'" class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                                <th class="py-3 px-6">Nome</th>
                                <th class="py-3 px-6">Matrícula</th>
                                <th class="py-3 px-6">E-mail</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="user in registred" key="user.id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{user.name}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{user.registration_number}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{user.email}}
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="registred.length == 0">
                                <td colspan="3" class="py-4 px-6 text-center">
                                    <div class="">
                                        Não há registros
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div v-if="type == 'errors'" class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                                <th class="py-3 px-6">Linha CSV</th>
                                <th class="py-3 px-6">Erros</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="(error, id) in errors" key="id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{error.row}}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        <p v-for="(textError, textErrorId) in error.errors" key="textErrorId">
                                            {{textError}}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="errors.length == 0">
                                <td colspan="3" class="py-4 px-6 text-center">
                                    <div class="">
                                        Não há registros
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </Layout>
</template>

<script>
import Layout from "../../../Layouts/Layout";

export default {
  components: { Layout },
  props: {
    errors: Array,
    registred: Array,
  },
  data() {
    return {
        type: 'registred'
    };
  },
  methods: {
    changeType: function (type) {
        this.type = type;
    }
  },
};
</script>

<style lang="">
</style>
