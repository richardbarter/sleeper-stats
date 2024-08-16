import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import PrimeVue from "primevue/config";
import Aura from "../css/presets/aura";
import Lara from "../css/presets/lara";
import MainLayout from "./Layouts/MainLayout.vue";
import StyleClass from "primevue/styleclass";
import "primeicons/primeicons.css";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];

        page.default.layout = page.default.layout || MainLayout;
        return page;
        // const page = resolvePageComponent(
        //     `./Pages/${name}.vue`,
        //     import.meta.glob("./Pages/**/*.vue"),
        // );
        // page.default.layout = page.default.layout || MainLayout;
        // return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                unstyled: true,
                pt: Aura,
            })
            .directive("styleclass", StyleClass)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
