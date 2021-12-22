import Vue from 'vue';
import { POSITION } from 'vue-toastification';

const Notificator = {
  install(Vue) {
    Vue.prototype.$displayNotification = function ({
      message,
      type = 'info',
      duration = 2000,
      position = POSITION.BOTTOM_CENTER,
    }) {
      Vue.$toast(message, {
        timeout: duration,
        type,
        position,
        toastClassName: 'xsn-toast',
        closeButton: false,
        hideProgressBar: true,
      });
    };
  },
};

Vue.use(Notificator);
