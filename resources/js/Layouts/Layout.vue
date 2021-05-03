
<template>
  <div>
    <sidebar-component></sidebar-component>
    <div class="relative md:ml-64 h-screen">
      <navbar-component></navbar-component>
      <!-- Header -->
      <div class="relative bg-green-uniceplac md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
          <div>
            <!-- Card stats -->
            <div class="flex flex-wrap justify-center">
              <div class="w-full lg:w-4/12 xl:w-2/12 px-4" v-for="situation in $page.props.axleWithCount" v-bind:key="situation.id">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <div class="text-gray-500 w-full uppercase border-b border-gray-200 text-center font-bold text-md">
                          {{situation.name}}
                        </div>
                        <div class="font-semibold text-xl w-full text-gray-800 text-center">
                          {{ formatTimeByMinutes(situation.total_validated_minutes) }} / 50:00
                        </div>
                      </div>

                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                      <span class="whitespace-no-wrap"> {{ ((situation.total_validated_minutes / 3000) * 100).toFixed(2) }}%</span>
                    </p>

                    <div class="shadow w-full bg-white">
                        <div class="bg-orange-uniceplac py-2 text-xs leading-none py-1 text-center text-white" :style="{width: `${ ((situation.total_validated_minutes / 3000) * 100)}%`}"></div>
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>
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
            <!-- <div class="bg-white p-10 shadow-md rounded-md"> -->
            <div class="flex justify-between mb-20">
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
            <slot></slot>
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
import NavbarComponent from "../Components/Dashboard/Navbar.vue";
import SidebarComponent from "../Components/Dashboard/Sidebar.vue";
import LineChartComponent from "../Components/Dashboard/LineChart.vue";
import BarChartComponent from "../Components/Dashboard/BarChart.vue";

import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
  name: "dashboard-page",
  components: {
    NavbarComponent,
    SidebarComponent,
    LineChartComponent,
    BarChartComponent,
  },
  props: {
    title: null,
    routeButton: null,
    textButton: "",
  },
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
  methods: {
      formatTimeByMinutes: function (totalMinutes) {
          const hours = Math.floor(totalMinutes / 60);
          const minutes = totalMinutes % 60;
          return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
      }
  },
  setup() {
    const hasHole = computed(() => usePage().props.value.hasHole);
    return { hasHole };
  },
};
</script>
