<template lang="">
    <Layout :title="`${career.name} - ${currentTypeSituation.name}`">
        <!-- component -->
            <div class="w-full">

                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal text-center">
                                <th class="py-3 px-6">Aluno</th>
                                <th class="py-3 px-6">Titulo</th>
                                <!-- <th class="py-3 px-6">Situação</th> -->
                                <th class="py-3 px-6">Detalhes</th>
                                <th class="py-3 px-6" v-if="canChangeTypeSituation(currentTypeSituation.id)">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="certificate in certificates.data" key="axle.id" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-4 px-6 text-center">
                                    <div class="">
                                        {{certificate.user.name}}
                                    </div>
                                </td>
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
                                        :href="this.route('validator.certificates.show', certificate.id)"
                                        ><span class="text-sm">Detalhes</span></inertia-link>
                                    <a  :href="this.route('validator.certificates.download', certificate.id)"
                                        target="_blank"
                                        class="text-white ml-2 text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                    >PDF</a>
                                </td>
                                <td class="py-4 px-6 text-center" v-if="canChangeTypeSituation(currentTypeSituation.id)">
                                    <inertia-link
                                        class="text-white text-center capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-2 font-bold"
                                        :href="this.route('validator.certificates.edit', certificate.id)"
                                        ><span class="text-sm">Avaliar</span></inertia-link>
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
</template>

<script>
import Layout from "../../../Layouts/Layout";
import Pagination from "../../../Shared/Pagination";

export default {
  components: { Layout, Pagination },
  props: {
    certificates: Object,
    typeSituations: Array,
    currentTypeSituation: Object,
    career: Object,
  },
  data() {
    return {
        dropdownPopoverShow: false
    };
  },
  methods: {
    toggleDropdown: function(event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        // new Popper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
        //   placement: "bottom-end"
        // });
      }
    },

    canChangeTypeSituation: function(typeSituationId) {
        return ![2,3].includes(typeSituationId);
    }
  },
};
</script>

<style lang="">
</style>
