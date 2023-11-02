import './bootstrap';
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import MainLayout from "@/Layouts/MainLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'ShortenThis';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });

        let page = pages[`./Pages/${name}.vue`];

        if (!page) {
            // Handle the case when the page is not found
            throw new Error(`Page '${name}' not found.`);
        }

        // Check if page.default exists, and if not, assign it
        if (!page.default) {
            page.default = {};
        }

        // Assign the layout property
        page.default.layout = page.default.layout || MainLayout;

        return page;
    },
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
