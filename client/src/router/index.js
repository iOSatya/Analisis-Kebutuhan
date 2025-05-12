// import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'
// import LoginView from '@/views/LoginView.vue';
// import RegisterView from "@/views/RegisterView.vue";
// import KeuanganView from "@/views/KeuanganView.vue";
// import BarangView from "@/views/BarangView.vue";
// import UtangView from "@/views/UtangView.vue";

// const router = createRouter({
//   history: createWebHistory(import.meta.env.BASE_URL),
//   routes: [
//     { path: '/', name: 'home', meta: { requiresAuth: false }, component: HomeView },
//     { path: "/login", meta: { requiresAuth: false }, name: "login", component: LoginView },
//     { path: "/register", meta: { requiresAuth: false }, name: "register", component: RegisterView },

//     { path: "/keuangan", meta: { requiresAuth: true }, children: [
//       { path: "", name: "keuangan", component: KeuanganView }
//     ] },
//     { path: "/barang", meta: { requiresAuth: true }, children: [
//       { path: "", name: "barang", component: BarangView }
//     ] },
//     { path: "/utang", meta: { requiresAuth: true }, children: [
//       { path: "", name: "utang", component: UtangView }
//     ] }
//   ],
// })

// router.beforeEach((to, from, next) => {

//   const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

//   if (!requiresAuth) {
//     next();
//     return;
//   }

//   const token = localStorage.getItem("token");

//   if (token) {
//     next();
//   } else {
//     next({name: "home"});
//   }

// });

// export default router

// <!-- ------------------------------------------------------------------------------------------------------------------------------ -->

import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import LoginView from '@/views/LoginView.vue';
import RegisterView from "@/views/RegisterView.vue";
import KeuanganView from "@/views/KeuanganView.vue";
import BarangView from "@/views/BarangView.vue";
import UtangView from "@/views/UtangView.vue";
import TransaksiView from '@/views/TransaksiView.vue';

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
      name: "barang", 
      component: BarangView 
    },
    { 
      path: "/utang", 
      name: "utang", 
      component: UtangView
    },
    {
      path: "/transaksi",
      name: "transaksi",
      component: TransaksiView
    }
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

