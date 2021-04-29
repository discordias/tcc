<template lang="">
    <!--div class="grid grid-cols-3 2xl:grid-cols-7 gap-2 border border-gray-200 rounded"-->
        <!-- Card Details -->
        <center>
            <div class="object-none object-center">
                <div class="max-w-xl bg-white shadow-lg rounded-lg overflow-hidden my-4 justify-center text-center">
                    <div class="flex items-center px-6 py-3 bg-green-uniceplac justify-center text-center">

                        <h1 class="mx-3 text-white font-semibold text-lg ">{{certificate.title}}</h1>
                    </div>

                    <div class="py-4 px-6">
                        <h1 class="text-2xl font-semibold text-gray-800">{{certificate.user.name}}</h1>

                        <p class="py-2 text-lg text-gray-700">Descrição: <br><span>{{certificate.description}}</span></p>

                        <div class="flex items-center mt-4 text-gray-700">

                            <h1 class="px-2 text-sm">Situação: {{certificate.type_situation.name}}</h1>
                        </div>
                        <div class="flex items-center mt-4 text-gray-700">

                            <h1 class="px-2 text-sm">Eixo: {{certificate.axle?.name}}</h1>
                        </div>
                        <div class="flex items-center mt-4 text-gray-700">
                            <h1 v-if="certificate.validated_hours" class="px-2 text-sm">Horas: {{certificate.validated_hours}}</h1>
                        </div>
                            <div class="flex flex-row justify-end text-center mb-4">
                                <a  :href="getRouteDownload(certificate.id)"
                                    target="_blank"
                                    class="text-white ml-2 text-center capitalize rounded-md bg-green-uniceplac hover:bg-orange-uniceplac pl-2 pr-3 py-2 font-bold"
                                >Visualizar Arquivo</a>
                            </div>

                    </div>
                </div>

            </div>

        </center>
    <!--/div-->
</template>

<script>
export default {
  props: {
    certificate: Object,
  },
  data() {
    return {};
  },
  methods: {
    getRouteDownload(id) {
      if (
        this.$page.props.hasHole.admin ||
        this.$page.props.hasHole.validator
      ) {
        return this.route("validator.certificates.download", id);
      } else {
        return this.route("certificates.download", id);
      }
    },
  },
};
</script>
