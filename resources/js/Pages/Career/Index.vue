<template lang="">
    <Layout :title="'Cursos'" :routeButton="'careers.create'" :textButton="'Cadastro'">
        <div class="flex items-center justify-center">
            <div class="bg-white rounded w-full">
                <div class="md:grid md:grid-cols-3 md:gap-4 space-y-4 md:space-y-0 mt-4">
                    <Card-career v-for="career in careers.data" key="axle.id" :career="career"></Card-career>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import Pagination from "../../Shared/Pagination";
import CardCareer from "../../Components/CardCareer";

export default {
  components: { Layout, Pagination, CardCareer },
  props: {
    careers: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
