<script setup>
  import { computed, onMounted, ref } from 'vue';
  import {alertError} from "../../lib/alert.js";

  const infoBarang = ref([]);
  const listBarangTerlaris = ref([]);
  const jumlahBarang = computed(() => infoBarang.value.length);
  const totalModal = computed(() =>
    infoBarang.value.reduce((sum, item) => sum + Number(item.modal), 0)
  );
  const totalPendapatan = computed(() =>
    infoBarang.value.reduce((sum, item) => sum + Number(item.pendapatan), 0)
  );
  const totalLaba = computed(() =>
    infoBarang.value.reduce((sum, item) => sum + Number(item.laba), 0)
  );
  const ringkasanStatus = computed(() => {
    if (totalLaba.value > 0) return 'Untung';
    if (totalLaba.value < 0) return 'Rugi';
    return 'BEP';
  });

  onMounted(async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/keuangan');
      infoBarang.value = await response.json();
    } catch (error) {
      await alertError("Gagal mengambil data barang!");
    }

    try {
      const response = await fetch('http://127.0.0.1:8000/api/barang/terlaris');
      listBarangTerlaris.value = await response.json();
    } catch (error) {
      await alertError("Gagal mengambil data barang terlaris!");
    }
  });
</script>

<template>
  <div class="page">
    <h1 class="title">Keuangan</h1>
    
    <div class="table-container">
      <table class="table-design">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Modal</th>
            <th>Pendapatan</th>
            <th>Laba<br>(Pendapatan - Modal)</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(info, index) in infoBarang" :key="index">
            <td>{{ info.nama }}</td>
            <td>{{ info.modal }}</td>
            <td>{{ info.pendapatan }}</td>
            <td>{{ info.laba }}</td>
            <td>
              <span v-if="info.status === 'untung'" class="text-profit">Untung</span>
              <span v-else-if="info.status === 'rugi'" class="text-loss">Rugi</span>
              <span v-else class="text-neutral">BEP</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <h2 class="summary-title">Barang Terlaris</h2>
    <div class="table-container">
      <table class="table-design">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Total Terjual</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in listBarangTerlaris" :key="index">
            <td>{{ item.nama }}</td>
            <td>{{ item.total_terjual }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <h2 class="summary-title">Ringkasan</h2>
    <div class="table-container">
      <table class="table-design summary">
        <thead>
          <tr>
            <th>Jumlah Barang</th>
            <th>Total Modal</th>
            <th>Total Pendapatan</th>
            <th>Total Laba</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ jumlahBarang }}</td>
            <td>{{ totalModal.toLocaleString() }}</td>
            <td>{{ totalPendapatan.toLocaleString() }}</td>
            <td>{{ totalLaba.toLocaleString() }}</td>
            <td :class="{
              'text-profit': ringkasanStatus === 'Untung',
              'text-loss': ringkasanStatus === 'Rugi',
              'text-neutral': ringkasanStatus === 'BEP'
            }">
              {{ ringkasanStatus }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

.page {
  font-family: 'Open sans', sans-serif;
  padding: 2rem;
  background-color: #FFFDF6;
  border-radius: 20px;
  margin: 140px;
}

.title {
  font-size: 1.8rem;
  text-align: center;
  margin-bottom: 1.5rem;
  color: black;
}

.summary-title {
  margin-top: 2rem;
  margin-bottom: 0.75rem;
  font-weight: 600;
  font-size: 1.2rem;
  color: black;
}

.table-container {
  overflow-x: auto;
  max-height: 400px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: inset 0 0 0 1px #DDEB9D;
}

.table-design {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
}

.table-design th {
  position: sticky;
  top: 0;
  background-color: #A0C878;
  color: black;
  padding: 1rem;
  text-align: center;
  font-weight: 600;
  font-size: 1.1rem;
  border-bottom: 2px solid #DDEB9D;
  z-index: 1;
}

.table-design td {
  text-align: center;
  padding: 0.75rem;
  border-bottom: 1px solid #DDEB9D;
  font-size: 0.95rem;
  color: black;
}

.table-design tr:hover td {
  background-color: #FAF6E9;
}

.text-profit {
  color: #38a169 !important; /* soft green */
  font-weight: bold;
}

.text-loss {
  color: #e53e3e !important; /* red */
  font-weight: bold;
}

.text-neutral {
  color: #d69e2e !important; /* gold */
  font-weight: bold;
}
</style>
