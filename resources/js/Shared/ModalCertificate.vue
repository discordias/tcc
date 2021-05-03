<template>
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
</template>

<script>
export default {
  name: "Pagination",
  props: {
    data: Object,
    certificate: Object,
  },
  data() {
      return {
          modalPDF: false,
      }
  },
  methods: {
    getRouteDownload: function(id) {
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
