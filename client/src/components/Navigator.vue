<template>
  
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

</style>
