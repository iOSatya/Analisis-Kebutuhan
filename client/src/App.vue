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
    return  route.name === 'home' ||
            route.name === 'login'||
            route.name === 'register' ||
            route.name === 'tambahBarang'||
            route.name === 'editBarang' ||
            route.name === 'tambahUtang';
  });
</script>