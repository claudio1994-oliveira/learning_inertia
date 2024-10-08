import './bootstrap';
import '../css/app.css';
import 'vue-toastification/dist/index.css';

import {createApp, h} from 'vue';
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';

import Toast from "vue-toastification";
import {notifications} from './Plugins/notifications';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(Toast)
            .use(notifications)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#5af60b',
    },

});
