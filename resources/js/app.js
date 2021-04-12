require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import VueEllipseProgress from 'vue-ellipse-progress';


import VueApexCharts from "vue3-apexcharts";

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
        isEmpty(obj) {
            return Object.keys(obj).length === 0;
        },
        formatTextErrors(errors) {
            return Object
                .entries(errors)
                .reduce( (accum, curr) => (accum === '') ? curr[1] : `${accum} - ${curr[1]}`, '');
        }
    } })
    .use(InertiaPlugin)
    .use(VueEllipseProgress)
    .use(VueApexCharts)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
