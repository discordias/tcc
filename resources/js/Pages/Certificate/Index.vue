<template lang="">
    <Layout :title="'Certificados'" :routeButton="'certificates.create'" :textButton="'Cadastro'">
        <div class="flex items-center justify-center">
            <div class="bg-white rounded w-full">
                <div class="md:grid md:grid-cols-3 md:gap-4 space-y-4 md:space-y-0 mt-4">
                    <Card-situation-student v-for="typeSituation in typeSituations" key="typeSituation.id" :typeSituation="typeSituation"></Card-situation-student>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layouts/Layout";
import CardSituationStudent from "../../Components/CardSituationStudent";

export default {
  components: { Layout, CardSituationStudent },
  props: {
    typeSituations: Array,
  },
  data() {
    return {
    };
  },
  methods: {
  },
};
</script>

<style lang="">
</style>
