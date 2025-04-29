<template>
  
  <div class="flex flex-col w-40 h-60 justify-evenly p-8 bg-gray-200 rounded-lg shadow-md">
    <RouterLink :to="{name: 'keuangan'}">KEUANGAN</RouterLink>
    <RouterLink :to="{name: 'barang'}">BARANG</RouterLink>
    <RouterLink :to="{name: 'home'}">UTANG</RouterLink>
    <RouterLink :to="{name: 'home'}">KASIR</RouterLink>
  </div>

</template>

<style scoped>

  a.router-link-active {
    font-weight: bold;
  }

</style>
