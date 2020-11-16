import Vue from "vue";
import Vuex from "vuex";
import datatable from "@/store/Modules/datatable";
import chart from "@/store/Modules/chart";
import videoStore from "@/store/Modules/videoStore";
Vue.use(Vuex);

const state = {
  sidebarShow: "responsive",
  sidebarMinimize: false,
};

const mutations = {
  toggleSidebarDesktop(state) {
    const sidebarOpened = [true, "responsive"].includes(state.sidebarShow);
    state.sidebarShow = sidebarOpened ? false : "responsive";
  },
  toggleSidebarMobile(state) {
    const sidebarClosed = [false, "responsive"].includes(state.sidebarShow);
    state.sidebarShow = sidebarClosed ? true : "responsive";
  },
  set(state, [variable, value]) {
    state[variable] = value;
  },
};

export default new Vuex.Store({
  state,
  mutations,
  modules: {
    datatable,
    chart,
    videoStore,
  },
});
