<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-10">
    <h1 class="text-2xl font-semibold mb-6">REGISTER</h1>
    <form class="flex flex-col w-full max-w-xs">

      <label for="name" class="mb-1 text-sm font-medium text-gray-700">Name</label>
      <input id="name" type="text" v-model="registerForm.name" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300">

      <label for="email" class="mb-1 text-sm font-medium text-gray-700">E-Mail</label>
      <input id="email" type="email" v-model="registerForm.email" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300">

      <label for="password" class="mb-1 text-sm font-medium text-gray-700">Password</label>
      <input id="password" type="password" v-model="registerForm.password" placeholder="" class="mb-4 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300">

      <label for="password_confirmation" class="mb-1 text-sm font-medium text-gray-700">Password Confirmation</label>
      <input id="password_confirmation" type="password" v-model="registerForm.password_confirmation" placeholder="" class="mb-6 px-4 py-2 border border-gray-300 rounded-full shadow-inner bg-gray-200 focus:outline-none focus:ring-2 focus:ring-green-300">

      <button type="submit" class="w-full py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
        REGISTER
      </button>

      <div class="mt-4 text-center">
        <RouterLink :to="{name: 'login'}" class="text-sm text-green-600 hover:text-green-800">Already have an account? Login</RouterLink>
      </div>

    </form>
  </div>
</template>

<script setup>
  import { ref } from 'vue';

  const registerForm = ref({
    username: "",
    email: "",
    password: "",
    password_confirmation: ""
  });

</script>
