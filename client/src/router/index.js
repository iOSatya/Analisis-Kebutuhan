import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import LoginView from '@/views/LoginView.vue';
import RegisterView from "@/views/RegisterView.vue";
import KeuanganView from "@/views/KeuanganView.vue";
import BarangView from "@/views/BarangView.vue";
import UtangView from "@/views/UtangView.vue";
import RiwayatTransaksiView from '@/views/RiwayatTransaksiView.vue';
import KasirView from '@/views/KasirView.vue';
import TambahUtangView from '@/views/TambahUtangView.vue';
import TambahBarangView from '@/views/TambahBarangView.vue';
import EditBarangView from "@/views/EditBarangView.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { 
      path: '/', 
      name: 'home',
      component: HomeView 
    },
    { 
      path: "/login", 
      name: "login", 
      component: LoginView 
    },
    { 
      path: "/register", 
      name: "register", 
      component: RegisterView 
    },
    { 
      path: "/keuangan", 
      name: "keuangan", 
      component: KeuanganView 
    },
    { 
      path: "/barang",
      children: [
        {
          path: "",
          name: "barang",
          component: BarangView
        },
        {
          path: "tambah-barang",
          name: "tambahBarang",
          component: TambahBarangView
        },
        {
          path: ":id",
          name: "editBarang",
          component: EditBarangView
        }
      ]
    },
    { 
      path: "/utang", 
      children: [
        {
          path: "",
          name: "utang",
          component: UtangView
        },
        {
          path: "tambah-utang",
          name: "tambahUtang",
          component: TambahUtangView
        }
      ],
    },
    {
      path: '/kasir',
      name: 'kasir',
      component: KasirView
    },
    {
      path: "/riwayat-transaksi",
      name: "riwayatTransaksi",
      component: RiwayatTransaksiView
    },
  ],
})

router.beforeEach((to, from, next) => {
  const publicPages = ['home', 'login', 'register'];
  const authRequired = !publicPages.includes(to.name);
  const token = localStorage.getItem("token");

  if (authRequired && !token) {
    return next({ name: 'login' });
  }

  if ((to.name === 'login' || to.name === 'register') && token) {
    return next({ name: 'barang' });
  }

  next();
});


export default router

