
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
            <div class="flex flex-wrap">
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                          Traffic
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          350,897
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500"
                        >
                          <i class="far fa-chart-bar"></i>
                        </div>
                      </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                      <span class="text-green-500 mr-2">
                        <i class="fas fa-arrow-up"></i> 3.48%
                      </span>
                      <span class="whitespace-no-wrap"> Since last month </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                          New users
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          2,356
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500"
                        >
                          <i class="fas fa-chart-pie"></i>
                        </div>
                      </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                      <span class="text-red-500 mr-2">
                        <i class="fas fa-arrow-down"></i> 3.48%
                      </span>
                      <span class="whitespace-no-wrap"> Since last week </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                          Sales
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          924
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                      <span class="text-orange-500 mr-2">
                        <i class="fas fa-arrow-down"></i> 1.10%
                      </span>
                      <span class="whitespace-no-wrap"> Since yesterday </span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                <div
                  class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                >
                  <div class="flex-auto p-4">
                    <div class="flex flex-wrap">
                      <div
                        class="relative w-full pr-4 max-w-full flex-grow flex-1"
                      >
                        <h5 class="text-gray-500 uppercase font-bold text-xs">
                          Performance
                        </h5>
                        <span class="font-semibold text-xl text-gray-800">
                          49,65%
                        </span>
                      </div>
                      <div class="relative w-auto pl-4 flex-initial">
                        <div
                          class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500"
                        >
                          <i class="fas fa-percent"></i>
                        </div>
                      </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                      <span class="text-green-500 mr-2">
                        <i class="fas fa-arrow-up"></i> 12%
                      </span>
                      <span class="whitespace-no-wrap"> Since last month </span>
                    </p>
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
  setup() {
    const hasHole = computed(() => usePage().props.value.hasHole);
    return { hasHole };
  },
};
</script>
