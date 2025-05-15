<!-- <template>
  
  <div class="flex flex-col w-40 h-60 justify-evenly p-8 bg-gray-200 rounded-lg shadow-md">
    <RouterLink :to="{name: 'keuangan'}">KEUANGAN</RouterLink>
    <RouterLink :to="{name: 'barang'}">BARANG</RouterLink>
    <RouterLink :to="{name: 'utang'}">UTANG</RouterLink>
    <RouterLink :to="{name: 'home'}">KASIR</RouterLink>
    <button @click="sendLogout" class="button text-red-600 self-start">LOG OUT</button>
  </div>

</template>

<script setup>

  import router from '@/router';
  import { useAuthStore } from '@/stores/auth';

  const AuthStore = useAuthStore();

  const sendLogout = async () => {
    try {
      const response = await fetch("http://127.0.0.1:8000/api/logout", {
        method: "POST",
        headers: {"Authorization": `Bearer ${AuthStore.token}`, "accept": "application/json"}
      });

      const responseData = await response.json();

      alert(responseData["message"]);

      if (response.ok) {
        AuthStore.removeToken();
        router.push({name: "home"});
      }
      
    } catch (error) {
      console.log(error);
      alert("Kesalahan Sistem");
    }
  }

</script>

<style scoped>

  a.router-link-active {
    font-weight: bold;
  }

</style> -->

<!-- ------------------------------------------------------------------------------------------------------------------------------ -->

<template>
  
  <div class="fixed top-0 left-0 right-0 z-50 flex justify-between items-center p-4 bg-green-300 text-gray-500 shadow-lg">
    <div class="flex space-x-6">
      <RouterLink 
        :to="{ name: 'keuangan' }" 
        :class="navClass('keuangan')">
        KEUANGAN
      </RouterLink>
      <RouterLink 
        :to="{ name: 'barang' }" 
        :class="navClass('barang')">
        BARANG
      </RouterLink>
      <RouterLink 
        :to="{ name: 'utang' }" 
        :class="navClass('utang')">
        UTANG
      </RouterLink>
      <RouterLink
        :to="{ name: 'kasir' }"
        :class="navClass('kasir')">
        KASIR
      </RouterLink>
      <RouterLink 
        :to="{ name: 'riwayatTransaksi' }"
        :class="navClass('transaksi')">
        RIWAYAT TRANSAKSI
      </RouterLink>
    </div>
    <button 
      @click="sendLogout" 
      class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md transition duration-300">
      LOG OUT
    </button>
  </div>
  
</template>

<script setup>

  import router from '@/router';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const sendLogout = async () => {
    const token = localStorage.getItem("token");
    try {
      await fetch("http://127.0.0.1:8000/api/logout", {
        method: "POST",
        headers: {
          "Authorization": `Bearer ${token}`,
          "Content-Type": "application/json"
        }
      });
    } catch (error) {
      // console.error(error);
      alert("Kesalahan Sistem");
    } finally {
      localStorage.removeItem("token");
      await router.push({name: "login"});
    }
  };

  const navClass = (name) => {
    return [
      "px-4", "py-2", "transition", "duration-300", "font-medium",
      route.name === name ? "text-black underline" : "hover:text-gray-900"
    ];
  };
  
</script>


  
