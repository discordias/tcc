<template lang="">
    <layout>
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
