require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import VueEllipseProgress from 'vue-ellipse-progress';
import VueApexCharts from "vue3-apexcharts";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import { library } from "@fortawesome/fontawesome-svg-core";
import icons from './fontawesome';

library.add({...icons});

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

import { useToast } from "vue-toastification";
const toast = useToast();

const el = document.getElementById('app');


createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: {
        route,
        toast,
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
        formatTextErrors(errors) {
            return Object
                .entries(errors)
                .reduce( (accum, curr) => (accum === '') ? curr[1] : `${accum} - ${curr[1]}`, '');
        },
    } })
    .use(InertiaPlugin)
    .use(VueEllipseProgress)
    .use(VueApexCharts)
    .use(Toast, {})
    .component("font-awesome-icon", FontAwesomeIcon)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
