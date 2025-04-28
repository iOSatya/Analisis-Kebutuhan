<template>
  <div id="app" class="flex p-8">
    <Navigator />

    <div class="flex-1 ml-8 p-4 bg-white rounded-lg shadow-md">
      <h1 class="text-xl font-bold mb-4">Financial Overview</h1>

      <div class="mb-4 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p>Pendapatan Periode 20-3-2025 : 11000</p>
      </div>

      <div class="mb-4 flex items-center">
         <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
        </svg>
        <p>Ekspektasi Pendapatan : 100000</p>
      </div>

      <div>
        <p class="text-red-600">Status : Tidak Memenuhi Ekspektasi Pendapatan</p>
      </div>
    </div>
  </div>
</template>

<script>
import Navigator from '@/components/Navigator.vue'; // Import the Navigator component

export default {
  name: 'App',
  components: {
    Navigator, // Register the Navigator component
  },
  // You can add data or methods here for the main app
};
</script>

<style>
/* Add global styles here if needed */
/* Ensure Tailwind CSS is included in your project for these classes to work */
/* For example, in your main.js or equivalent: */
/* import './assets/css/tailwind.css'; */

/* Basic styling for the body to remove default margin */
body {
  margin: 0;
  font-family: 'Inter', sans-serif; /* Using Inter font as per instructions */
}
</style>
