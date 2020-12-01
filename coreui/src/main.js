import "core-js/stable";
import Vue from "vue";
import App from "./App";
import router from "./router";
import CoreuiVue from "@coreui/vue";
import { iconsSet as icons } from "./assets/icons/icons.js";
import store from "./store";
import "video.js/dist/video-js.css";
import "vue-multiselect/dist/vue-multiselect.min.css";
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.prototype.$apiAdress = "http://127.0.0.1:8000";
Vue.config.performance = true;
Vue.use(CoreuiVue);

new Vue({
  el: "#app",
  router,
  store,
  icons,
  template: "<App/>",
  components: {
    App,
  },
});
