import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue';
import RegisterView from "@/views/RegisterView.vue";
import KeuanganView from "@/views/KeuanganView.vue";
import BarangView from "@/views/BarangView.vue";
import UtangView from "@/views/UtangView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: "/login", name: "login", component: LoginView },
    { path: "/register", name: "register", component: RegisterView },
    { path: "/keuangan", children: [
      { path: "", name: "keuangan", component: KeuanganView }
    ] },
    { path: "/barang", children: [
      { path: "", name: "barang", component: BarangView }
    ] },
    { path: "/utang", children: [
      { path: "", name: "utang", component: UtangView }
    ] }
  ],
})

export default router
