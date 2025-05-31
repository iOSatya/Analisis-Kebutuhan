<script setup>

  import router from '@/router';
  import { ref } from 'vue';
  import {alertError} from "../../lib/alert.js";

  const barang = ref([]);

  (async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/barang');
      barang.value = await response.json();
    } catch (error) {
      await alertError('Gagal mengambil data barang!');
    }
  })();

  const formatCurrency = (value) => {
    return value.toLocaleString('id-ID');
  };

  const addItem = () => {
    router.push({ name: 'tambahBarang' });
  };

  const editItem = (id) => {
    router.push({ name: 'editBarang', params: { id: id } });
  };

  const deleteItem = async (id) => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/barang/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        },
      });
      if (response.ok) {
        barang.value = barang.value.filter(item => item.id !== id);
      } else {
        await alertError('Gagal menghapus data barang!');
      }
    } catch (error) {
      await alertError('Gagal menghapus data barang!');
    }
  };
  
</script>

<template>
  <div class="page">
    <h1 class="title">Barang</h1>
    <div class="table-container">
      <table class="table-design">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Sisa Stock</th>
          <th>Terjual</th>
          <th>Harga</th>
          <th colspan="2">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in barang" :key="item.id">
          <td>{{ index + 1 }}</td>
          <td>{{ item.nama }}</td>
          <td>{{ item.sisa_stock }}</td>
          <td>{{ item.terjual }}</td>
          <td>{{ formatCurrency(item.harga_jual) }}</td>
          <td @click="editItem(item.id)" class="actions">
            <span>✏️</span>
          </td>
          <td @click="deleteItem(item.id)" class="actions">
            <span>🗑️</span>
          </td>
        </tr>
        </tbody>
        <tfoot>
        <tr @click="addItem" class="row-button">
          <td colspan="7">
            <span>➕</span> Tambah Data Barang
          </td>
        </tr>
        </tfoot>
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

  .actions {
    text-align: center;
  }

  .actions:hover {
    cursor: pointer;
  }

  .row-button {
    cursor: pointer;
    user-select: none;
    transition: background-color .2s;
  }

  .row-button:active td {
    background-color: #EFE9D9;
  }

</style>
