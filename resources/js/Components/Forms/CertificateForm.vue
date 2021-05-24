<template lang="">
    <div class="w-full">
        <div class="my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">
                <div class="grid grid-cols-4 gap-4 mb-4">
                    <div class="col-span-4">
                        <label for="certificate_title">Titulo</label>

                        <input type="text" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" id="certificate_title" maxlength="100" required v-model="form.title" autofocus/>
                    </div>
                    <div class="col-span-4">
                        <label for="axle_description">Descrição</label>
                        <textarea   type="text"
                                    class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md"
                                    id="axle_description"
                                    rows="5"
                                    v-model="form.description"></textarea>
                    </div>

                    <div class="col-span-4">


                    <div class="col-span-6 flex mt-4 items-center justify-center bg-grey-lighter">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-green-uniceplac rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-green-uniceplac hover:text-white">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span v-if="form.archive === null" class="mt-2 text-base leading-normal">Selecionar um arquivo</span>
                            <span v-if="form.archive !== null" class="mt-2 text-base leading-normal">Arquivo {{ form.archive?.name }} Selecionado</span>
                            <input class="w-96 flex flex-col items-center px-4 py-6 bg-grey-0 rounded-lg shadow-lg hidden cursor-pointer hover:bg-gray-100" type="file" @input="form.archive = $event.target.files[0]"/>
                        </label>
                    </div>

                        <!--progress class="" v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                        </progress-->
                    </div>

                </div>

                <div class="mt-4 w-full flex justify-end">
                    <input  type="submit"
                            class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer"
                            value="Salvar">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    form: Object,
  },
  data() {
    return {};
  },
  methods: {
    salvar() {
      this.$emit("salvar");
    },
  },
};
</script>
