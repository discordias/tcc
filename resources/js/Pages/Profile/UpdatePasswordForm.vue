
<template>
  <div>
    <sidebar-component></sidebar-component>
    <div class="relative md:ml-64 h-screen">
      <navbar-component></navbar-component>
      <!-- Header -->
      <div class="relative bg-green-uniceplac md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">

        </div>
      </div>
      <!-- Fim do HEADER -->

      <div
        class="px-4 md:px-10 mx-auto w-full bg-gray-200 -m-24 h-full flex flex-col justify-between"
      >
        <div class="w-full flex justify-center">
          <div
            class="mt-4 w-full max-w-7xl relative bg-white p-10 shadow-md rounded-md"
          >
            <div class="flex justify-between mb-20">
              <div class="text-black text-4xl">
                Alterar senha
              </div>
            </div>
            <jet-form-section @submitted="updatePassword">

              <template #description>
                A senha padrão de acesso ao sistema é <b>"password"</b>, mas
                agora que você fez seu primeiro acesso, por segurança, altere
                sua senha.
              </template>

              <template #form>
                <div class="col-span-6 sm:col-span-4">
                  <jet-label for="current_password" value="Senha antiga" />
                  <jet-input
                    id="current_password"
                    type="password"
                    class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md"
                    v-model="form.current_password"
                    ref="current_password"
                    autocomplete="current-password"
                  />
                  <jet-input-error
                    :message="form.errors.current_password"
                    class="mt-2"
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <jet-label for="password" value="Nova senha" />
                  <jet-input
                    id="password"
                    type="password"
                    class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md"
                    v-model="form.password"
                    ref="password"
                    autocomplete="new-password"
                  />
                  <jet-input-error
                    :message="form.errors.password"
                    class="mt-2"
                  />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <jet-label
                    for="password_confirmation"
                    value="Confirme a nova senha"
                  />
                  <jet-input
                    id="password_confirmation"
                    type="password"
                    class="w-full focus:ring-orange-uniceplac focus:border-orange-uniceplac block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md shadow-md"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"
                  />
                  <jet-input-error
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                  />
                </div>
              </template>

              <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                  Saved.
                </jet-action-message>

                <jet-button
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Alterar senha
                </jet-button>
              </template>
            </jet-form-section>
            <!-- <div class="bg-white p-10 shadow-md rounded-md"> -->
            <!--div class="flex justify-between mb-20">
              <div v-if="title" class="text-black text-4xl">
                {{ title }}
              </div>
              <inertia-link
                v-if="routeButton"
                class="text-white text-center text-xl capitalize rounded-md bg-green-500 hover:bg-green-600 pl-2 pr-3 py-3 font-bold"
                :href="this.route(routeButton)"
                ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
                {{ textButton }}</inertia-link
              >
            </div>
            <slot></slot-->
            <!-- </div> -->
          </div>
        </div>

        <!-- FOOTER -->
        <footer class="block py-4">
          <div class="container mx-auto px-4">
            <hr class="mb-4 border-b-1 border-gray-300" />
            <div
              class="flex flex-wrap items-center md:justify-between justify-center"
            >
              <div class="w-full md:w-4/12 px-4">
                <div class="text-sm text-gray-600 font-semibold py-1">
                  Copyright © {{ date }}
                  <a
                    href="https://www.creative-tim.com"
                    class="text-gray-600 hover:text-gray-800 text-sm font-semibold py-1"
                  >
                    Creative Tim
                  </a>
                </div>
              </div>
              <div class="w-full md:w-8/12 px-4">
                <ul
                  class="flex flex-wrap list-none md:justify-end justify-center"
                >
                  <li>
                    <a
                      href="https://www.creative-tim.com"
                      class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3"
                    >
                      Creative Tim
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://www.creative-tim.com/presentation"
                      class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3"
                    >
                      About Us
                    </a>
                  </li>
                  <li>
                    <a
                      href="http://blog.creative-tim.com"
                      class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3"
                    >
                      Blog
                    </a>
                  </li>
                  <li>
                    <a
                      href="https://github.com/creativetimofficial/tailwind-starter-kit/blob/master/LICENSE.md"
                      class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3"
                    >
                      MIT License
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>
<script>
import NavbarComponent from "../../Components/Dashboard/Navbar.vue";
import SidebarComponent from "../../Components/Dashboard/Sidebar.vue";
import LineChartComponent from "../../Components/Dashboard/LineChart.vue";
import BarChartComponent from "../../Components/Dashboard/BarChart.vue";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";

import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  name: "dashboard-page",
  components: {
    NavbarComponent,
    SidebarComponent,
    LineChartComponent,
    BarChartComponent,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },
  props: {
    title: null,
    routeButton: null,
    textButton: "",
  },
  data() {
    return {
      date: new Date().getFullYear(),
      form: this.$inertia.form({
        current_password: "",
        password: "",
        password_confirmation: "",
      }),
    };
  },
  setup() {
    const hasHole = computed(() => usePage().props.value.hasHole);
    return { hasHole };
  },
  methods: {
    updatePassword() {
      this.form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset("password", "password_confirmation");
            this.$refs.password.focus();
          }

          if (this.form.errors.current_password) {
            this.form.reset("current_password");
            this.$refs.current_password.focus();
          }
        },
      });
    },
  },
};
</script>

