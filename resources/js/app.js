require('./bootstrap');
require('./plugins/vue-toastification');
require('./plugins/notificator');
require('./plugins/file-agent');

import Vue from 'vue';
import {
  App as InertiaApp,
  plugin as InertiaPlugin,
  Link,
} from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress';

Vue.use(InertiaPlugin);
Vue.component('Link', Link);
Vue.mixin({ methods: { route: window.route } });
const app = document.getElementById('app');

new Vue({
  render: (h) =>
    h(InertiaApp, {
      props: {
        title: (title) => `${title} - XSN BUG REPORTS`,
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: (name) => require(`./pages/${name}`).default,
      },
    }),
}).$mount(app);

InertiaProgress.init({ color: '#fff' });
