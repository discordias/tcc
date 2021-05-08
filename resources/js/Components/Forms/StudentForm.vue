<template lang="">
    <div class="w-full">
        <div class="bg-white rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">

                <div class="border border-gray-300 p-10 rounded shadow-md">
                    <div class="grid grid-cols-6 gap-4 mb-4">
                        <div class="col-span-6 2xl:col-span-4">
                            <label for="student_name">Nome:</label>
                            <input type="text" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" id="student_name" maxlength="100" required v-model="form.name" autofocus/>
                        </div>

                        <div class="col-span-2">
                            <label for="careers">Curso:</label>
                            <select id="careers" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" required v-model="form.career_id">
                                <option v-for="career in careers" :key="career.id" v-bind:value="career.id" class="">
                                    {{ career.name }}
                                </option>
                            </select>
                        </div>

                        <div class="col-span-4 2xl:col-span-2">
                            <label for="student_email">E-mail:</label>
                            <input type="email" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-4 pr-4 sm:text-sm border-gray-300 rounded-md shadow-md" id="student_email" maxlength="50" required v-model="form.email" autofocus/>
                        </div>

                        <div class="col-span-6 lg:col-span-2 ">
                            <label for="registration_number">Matricula:</label>
                            <input type="number" min="1" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-4 pr-4 sm:text-sm border-gray-300 rounded-md shadow-md" id="registration_number" maxlength="50" required v-model="form.registration_number" autofocus/>
                        </div>

                        <div class="col-span-3 lg:col-span-2 2xl:col-span-1">
                            <label for="entry_year">Ano de Entrada:</label>
                            <input type="number" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-4 pr-4 sm:text-sm border-gray-300 rounded-md shadow-md" id="entry_year" maxlength="50" required v-model="form.entry_year" autofocus/>
                        </div>

                        <div class="col-span-3 lg:col-span-2 2xl:col-span-1">
                            <label for="entry_semester">Semestre de Entrada:</label>
                            <select id="entry_semester" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" required v-model="form.entry_semester">
                                <option  v-bind:value="'1'" class="">1</option>
                                <option  v-bind:value="'2'" class="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 w-full flex justify-center mt-14">
                        <input  type="submit"
                                class="px-3 py-2 text-white rounded-md bg-green-500 hover:bg-green-600 cursor-pointer"
                                value="Salvar">
                    </div>

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
