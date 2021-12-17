import AOS from 'aos';
import 'aos/dist/aos.css';

import Vue from 'vue';

AOS.init({
  once: true,
});
Vue.use(AOS);
