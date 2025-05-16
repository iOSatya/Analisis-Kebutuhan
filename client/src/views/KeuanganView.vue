<script setup>
  import { computed, onMounted, ref } from 'vue';

  const infoBarang = ref([]);
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
      const response = await fetch('http://127.0.0.1:8000/api/barang');
      infoBarang.value = await response.json();
    } catch (error) {
      alert('gagal mengambil data keuangan');
    }
  });

</script>

<template>
  <div class="financial-details">
    <h1 class="title">Keuangan</h1>
    
    <div class="table-container">
      <table class="financial-table">
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

    <h2 class="summary-title">Ringkasan</h2>
    <div class="table-container">
      <table class="financial-table summary">
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
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600&display=swap');

.financial-details {
  font-family: 'Quicksand', sans-serif;
  padding: 2rem;
  background-color: #fff0f6;
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(255, 105, 180, 0.2);
  color: #333;
  margin: 140px;
}

.title {
  font-size: 1.8rem;
  text-align: center;
  margin-bottom: 1.5rem;
  color: #d63384;
}

.summary-title {
  margin-top: 2rem;
  margin-bottom: 0.75rem;
  font-weight: 600;
  font-size: 1.2rem;
  color: #c2255c;
}

.table-container {
  overflow-x: auto;
  max-height: 400px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: inset 0 0 0 1px #f8c6d8;
}

.financial-table {
  width: 100%;
  border-collapse: collapse;
  min-width: 600px;
}

.financial-table th {
  position: sticky;
  top: 0;
  background-color: #ffe3ec;
  color: #6f1d1b;
  padding: 1rem;
  text-align: left;
  font-weight: 600;
  font-size: 0.95rem;
  border-bottom: 2px solid #f8c6d8;
  z-index: 1;
}

.financial-table td {
  padding: 1rem;
  border-bottom: 1px solid #f8c6d8;
  font-size: 0.95rem;
  color: #4b1e27;
}

.financial-table tr:hover td {
  background-color: #ffeaf3;
}

.text-profit {
  color: #38a169; /* soft green */
  font-weight: bold;
}

.text-loss {
  color: #e53e3e; /* red */
  font-weight: bold;
}

.text-neutral {
  color: #d69e2e; /* gold */
  font-weight: bold;
}
</style>
