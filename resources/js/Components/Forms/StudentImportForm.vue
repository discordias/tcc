<template lang="">
    <div class="w-full">
        <div class="bg-white rounded my-6">
            <form @submit.prevent="salvar" class="px-4 py-5">

                <div class="grid grid-cols-6 gap-4 mb-4">
                    <div class="col-span-6 lg:col-span-3">
                        <label for="careers">Curso:</label>
                        <select id="careers" @change="setCurrentCourse()" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" required v-model="form.career_id">
                            <option v-for="career in careers" :key="career.id" v-bind:value="career.id" class="">
                                {{ career.name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-span-6 lg:col-span-3">
                        <label for="careers">Grade:</label>
                        <select id="careers" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" required v-model="form.course_curriculum_id">
                            <option v-for="curriculum in currentCouser.course_curricula" :key="curriculum.id" v-bind:value="curriculum.id" class="">
                                {{ curriculum.description }}
                            </option>
                        </select>
                    </div>

                    <div class="col-span-6 lg:col-span-3 2xl:col-span-3">
                        <label for="entry_year">Ano de Entrada:</label>
                        <input type="number" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-4 pr-4 sm:text-sm border-gray-300 rounded-md shadow-md" id="entry_year" maxlength="50" required v-model="form.entry_year" autofocus/>
                    </div>

                    <div class="col-span-6 lg:col-span-3 2xl:col-span-3">
                        <label for="entry_semester">Semestre de Entrada:</label>
                        <select id="entry_semester" class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md" required v-model="form.entry_semester">
                            <option  v-bind:value="'1'" class="">1</option>
                            <option  v-bind:value="'2'" class="">2</option>
                        </select>
                    </div>

                    <div class="col-span-6 flex mt-4 items-center justify-center bg-grey-lighter">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-green-uniceplac rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-green-uniceplac hover:text-white">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span v-if="form.archive === null" class="mt-2 text-base leading-normal">Selecionar um arquivo</span>
                            <span v-if="form.archive !== null" class="mt-2 text-base leading-normal">Arquivo {{ form.archive.name }} Selecionado</span>
                            <input type='file' @input="form.archive = $event.target.files[0]" class="hidden" />
                        </label>
                    </div>
                </div>

                <div class="mt-4 w-full flex justify-center mt-14">
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
    careers: Array,
    errors: Object,
  },
  data() {
    return {
        form: this.$inertia.form({
            career_id: '',
            entry_year: '',
            entry_semester: '',
            archive: null,
            course_curriculum_id: null
        }),
        currentCouser: Object,
    };
  },
  methods: {
    salvar: function() {
        this.form.post(this.route('admin.students.import'), {
            onFinish: () => {
                if (!this.isEmpty(this.errors)) {
                    this.toast(this.formatTextErrors(this.errors), {type: 'error'});
                } else {
                    this.form.reset();
                    if (this.$page.props.flash.success) {
                        this.toast(this.$page.props.flash.success, {type: 'success'});
                    }
                }
            },
        })
    },
    setCurrentCourse: function () {
        const careers = this.careers.filter(c => c.id === this.form.career_id);
        this.currentCouser = careers[0];
    },
    mounted: function () {
      this.currentCouser = this.careers.length > 0 ? this.careers[0] : [];
    }
  },
};
</script>
