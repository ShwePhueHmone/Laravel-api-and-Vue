import Vue from "vue";
import Swal from "sweetalert2";
import ProgressBar from "vuejs-progress-bar";

Vue.use(ProgressBar, {
    color: "#bffaf3",
    failedColor: "#874b4b",
    thickness: "5px",
    height: "5px",
});

import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess,
} from "vform/src/components/bootstrap5";
require("./bootstrap");
window.Vue = require("vue");

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component(
    "product-component",
    require("./components/ProductComponent.vue").default
);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});
window.Swal = Swal;
window.Toast = Toast;

const app = new Vue({
    el: "#app",
});
