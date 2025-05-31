<script setup>

import { ref } from 'vue';

const transaksi = ref([]);

(async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/transaksi');
    transaksi.value = await response.json();
  } catch (error) {
    // console.error(error);
    alert('gagal mengambil data transaksi');
  }
})();

const formatCurrency = (value) => {
  return value.toLocaleString('id-ID');
};

</script>

<template>
  <div class="page">
    <h1 class="title">Riwayat Transaksi</h1>
    <div class="table-container">
      <table class="table-design">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama</th>
          <th>Harga</th>
          <th>Jumlah Barang</th>
          <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in transaksi" :key="item.id">
          <td>{{ index + 1 }}</td>
          <td>{{ item.tanggal }}</td>
          <td>{{ item.nama }}</td>
          <td>{{ formatCurrency(item.harga) }}</td>
          <td>{{ item.jumlah_barang }}</td>
          <td>{{ item.total }}</td>
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

</style>
