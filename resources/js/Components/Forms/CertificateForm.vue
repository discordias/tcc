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
                                    required
                                    v-model="form.description"></textarea>
                    </div>
                    
                    <div class="col-span-4">
                        
                        <input class="w-96 flex flex-col items-center px-4 py-6 bg-grey-0 rounded-lg shadow-lg cursor-pointer hover:bg-gray-100" type="file" @input="form.archive = $event.target.files[0]"/>
                        
                            
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
