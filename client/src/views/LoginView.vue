<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-2xl font-semibold mb-6">LOGIN</h1>
    <form class="flex flex-col w-full max-w-xs">
      <label for="username" class="mb-1 text-sm font-medium text-gray-700">Username</label>
      <input
        id="username"
        type="text"
        v-model="loginForm.username"
        placeholder=""
        class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300"
      >

      <label for="password" class="mb-1 text-sm font-medium text-gray-700">Password</label>
      <input
        id="password"
        type="password"
        v-model="loginForm.password"
        placeholder=""
        class="mb-6 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300"
      >

      <button
        type="submit"
        class="w-full py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
      >
        LOGIN
      </button>
    </form>
  </div>
</template>

<script setup>

  import { ref } from 'vue';

  const loginForm = ref({
    username: "",
    password: ""
  });

</script>
