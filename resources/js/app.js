import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import { ZiggyVue } from 'ziggy-js';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
  title: title => title,
  resolve: name => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    // Membuat aplikasi dan menggunakan ZiggyVue
    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el);
  },
});

window.route = (name, params = {}, absolute = false) => {
  return ZiggyVue.namedRoutes[name](params, absolute);
};
