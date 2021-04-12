<template lang="">
    <layout>
        <div class="flex justify-between">
            <div class="text-white text-4xl">
                Eixos
            </div>
            <inertia-link
              class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
              href="/eixo/create"
              ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
              Cadastro</inertia-link>
        </div>

        <!-- component -->
            <div class="w-full">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="w-full p-4 text-center">
                        <p>Esta vai ser a página de perfil do usuário</p>
                        <p>{{ user.name }}</p>
                        <p>{{ user.email }}</p>
                    </div>
                </div>
            </div>

    </layout>
</template>

<script>
import Layout from "../../Layouts/Layout";

export default {
  components: { Layout },
  props: {
      user: Object,
  },
  data() {
    return {};
  },
  methods: {},
};
</script>

<style lang="">
</style>
