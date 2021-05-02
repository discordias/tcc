<template lang="">
    <!--div class="grid grid-cols-3 2xl:grid-cols-7 gap-2 border border-gray-200 rounded"-->
        <!-- Card Details -->
        <center>
            <div class="object-none object-center">
                <div class="max-w-xl bg-white shadow-lg rounded-lg overflow-hidden my-4 justify-center">
                    <div class="flex items-center px-6 py-3 bg-green-uniceplac justify-center">

                        <h1 class="mx-3 text-white font-semibold text-lg text-center">{{certificate.title}}</h1>
                    </div>

                    <div class="py-4 px-6">
                        <div class="mt-3 border-b border-gray-200 pb-4">
                            <h1 class="text-2xl font-semibold text-gray-800 text-center">{{certificate.user.name}}</h1>
                        </div>

                        <div class="flex items-center mt-6 text-gray-700">
                            <p class="px-2 text-sm"><span><b>Descrição:</b></span> {{certificate.description}}</p>
                        </div>

                        <div class="flex items-center mt-3 text-gray-700">

                            <p class="px-2 text-sm"><span><b>Situação:</b></span> {{certificate.type_situation.name}}</p>
                        </div>

                        <div    v-if="certificate.type_situation_id == 2"
                                class="flex items-center mt-3 text-gray-700">

                            <p class="px-2 text-sm"><span><b>Eixo:</b></span> {{certificate.axle?.name}}</p>
                        </div>

                        <div  v-if="certificate.type_situation_id == 2"
                              class="flex items-center mt-3 text-gray-700">
                            <p class="px-2 text-sm"><span><b>Horas:</b></span> {{certificate.validated_hours}}</p>
                        </div>

                        <div class="flex items-center mt-3 text-gray-700">
                            <p v-if="certificate.observation" class="px-2 text-sm"><span><b>Observação:</b></span> {{certificate.observation}}</p>
                        </div>

                        <div class="flex flex-row justify-end text-center mb-4 mt-10">
                            <button  @click="toggleModal()"
                                class="text-white ml-2 text-center capitalize rounded-md cursor-pointer bg-green-uniceplac hover:bg-orange-uniceplac pl-2 pr-3 py-2 font-bold"
                            >Visualizar Arquivo</button>
                        </div>
                    </div>
                </div>

            </div>

        </center>

        <div v-if="modalPDF" class="fixed overflow-x-hidden overflow-y-auto inset-0 flex justify-center items-center z-50">
            <div class="relative  min-w-full h-4/6 flex justify-center item-start rounded-md">
                <div class="bg-white w-full rounded shadow-2xl flex flex-col max-w-2xl pb-3 rounded-md">
                    <div class="flex justify-between bg-green-uniceplac justify-items-end mb-5 p-3 rounded-t-md">
                        <div class="text-xl text-white">{{certificate.title}}</div>
                        <button @click="toggleModal()" class="rounded-full py-1 px-3 text-white bg-orange-uniceplac focus:outline-none">x</button>
                    </div>

                    <div class="w-full h-full px-4">
                        <embed :src="getRouteDownload(certificate.id)" class="w-full h-full" type='application/pdf'>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="modalPDF"
             class="fixed z-40 inset-0 opacity-25 bg-black">
        </div>




    <!--/div-->
</template>

<script>
export default {
  props: {
    certificate: Object,
  },
  data() {
    return {
        modalPDF: false,
    };
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
    toggleModal: function (){
        this.modalPDF = !this.modalPDF;
    },
  },
};
</script>
