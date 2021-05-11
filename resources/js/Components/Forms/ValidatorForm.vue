<template lang="">
    <div class="w-full">
        <div class="bg-white rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">
                <div class="grid grid-cols-6 gap-4 mb-4">
                    <div class="col-span-6 lg:col-span-2">
                        <label for="validator_name">Nome</label>
                        <input type="text" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-3 pr-3 sm:text-sm border-gray-300 rounded-md shadow-md" id="validator_name" maxlength="100" required v-model="form.name"/>
                    </div>
                    <div class="col-span-6 lg:col-span-2">
                        <label for="validator_email">E-mail</label>
                        <input type="email" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-3 pr-3 sm:text-sm border-gray-300 rounded-md shadow-md" id="validator_email" maxlength="50" required v-model="form.email"/>
                    </div>
                    <div class="col-span-6 lg:col-span-2">
                        <label for="registration_number">Matricula</label>
                        <input type="number" min="1" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-3 pr-3 sm:text-sm border-gray-300 rounded-md shadow-md" id="registration_number" maxlength="50" required v-model="form.registration_number"/>
                    </div>
                </div>


                <div class="mt-8 w-full flex justify-center">
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
    careers: Array,
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
