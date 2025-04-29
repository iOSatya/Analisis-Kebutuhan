<template>
  <div class="flex h-screen items-center p-20">
    <Navigator />
    <div class="financial-details w-full m-12">
      <div class="detail-item">
        <span class="icon">📅</span>
        <span>Pendapatan Periode {{ periode }}: {{ pendapatanPeriode }}</span>
      </div>
      <div class="detail-item">
        <span class="icon">✏️</span>
        <span>Ekspektasi Pendapatan: {{ ekspektasiPendapatan }}</span>
      </div>
      <div class="detail-item status" :class="statusClass">
        <span>Status: {{ statusMessage }}</span>
      </div>
    </div>
  </div>

</template>

<script setup>

  import Navigator from '@/components/Navigator.vue';
  import { ref, computed } from 'vue';

  const periode = ref('20-3-2025');
  const pendapatanPeriode = ref(11000);
  const ekspektasiPendapatan = ref(100000);

  const statusMessage = computed(() => {
    return pendapatanPeriode.value >= ekspektasiPendapatan.value
      ? 'Memenuhi Ekspektasi Pendapatan'
      : 'Tidak Memenuhi Ekspektasi Pendapatan';
  });

  const statusClass = computed(() => {
    return pendapatanPeriode.value >= ekspektasiPendapatan.value
      ? 'status-met'
      : 'status-not-met';
  });

</script>

<style scoped>

  .financial-details {
    padding: 20px;
    font-family: sans-serif;
  }
  
  .detail-item {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    color: #333;
  }
  
  .icon {
    margin-right: 10px;
    font-size: 1.2em;
  }
  
  .status {
    margin-top: 20px;
    font-weight: bold;
  }
  
  .status-not-met {
    color: #d9534f;
  }
  
  .status-met {
    color: #5cb85c;
  }

</style>
