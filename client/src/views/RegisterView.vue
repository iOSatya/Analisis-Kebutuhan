<template>

  <form class="flex flex-col">
    <input type="text" v-model="registerForm.name" placeholder="Name" class="form-control">
    <input type="email" v-model="registerForm.email" placeholder="E-Mail" class="form-control">
    <input type="password" v-model="registerForm.password" placeholder="Password" class="form-control">
    <input type="password" v-model="registerForm.password_confirmation" placeholder="Password Confirmation" class="form-control">
    <div class="flex">
      <RouterLink :to="{name: 'login'}">Login</RouterLink>
      <button type="submit" class="button">Register</button>
    </div>
  </form>

</template>

<script setup>

  import { ref } from 'vue';

  const registerForm = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  });

</script>