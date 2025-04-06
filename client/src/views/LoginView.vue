<template>

  <form class="flex flex-col">
    <input type="email" v-model="loginForm.email" placeholder="E-Mail" class="form-control">
    <input type="password" v-model="loginForm.password" placeholder="Password" class="form-control">
    <div class="flex">
      <RouterLink :to="{name: 'register'}">Register</RouterLink>
      <button type="submit" class="button">Login</button>
    </div>
  </form>

</template>

<script setup>

  import { ref } from 'vue';

  const loginForm = ref({
    email: "",
    password: ""
  });

</script>