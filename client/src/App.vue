<!-- <template>

  <RouterView />

</template>

<style>

  .form-control {
    border-bottom: 1px solid var(--secondary);
    padding: 0.5rem;
    outline: none;
  }

  .button {
    display: block;
    cursor: pointer;
  }

</style> -->

<!-- ------------------------------------------------------------------------------------------------------------------------------ -->
 
<template>
  <Navigator v-if="!hideNavbar" />
  <RouterView />
</template>

<script setup>
  import Navigator from '@/components/Navigator.vue';
  import { useRoute } from 'vue-router';
  import { computed } from 'vue';

  const route = useRoute();
  const hideNavbar = computed(() => {
    return  route.name === 'home'           ||
            route.name === 'login'          || 
            route.name === 'register'       ||
            route.name === 'tambahBarang'   ||
            route.name === 'tambahUtang';
  });
</script>