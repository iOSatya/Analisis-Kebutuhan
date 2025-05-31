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

  <div class="table-container">
    <table class="">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Sisa Stock</th>
        <th>Terjual</th>
        <th>Harga</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(item, index) in barang" :key="item.id">
        <td>{{ index + 1 }}</td>
        <td>{{ item.nama }}</td>
        <td>{{ item.sisa_stock }}</td>
        <td>{{ item.terjual }}</td>
        <td>{{ formatCurrency(item.harga_jual) }}</td>
        <td class="actions">
          <button @click="editItem(item.id)" class="action-button edit-button">✏️</button>
          <button @click="deleteItem(item.id)" class="action-button delete-button">🗑️</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>

  <div class="add-button-container">
    <button @click="addItem" class="add-button">
      <span class="">➕</span> Tambah Data Barang
    </button>
  </div>

</template>

<style scoped>

  .table-container {
    border: 1px solid #ddd;
    font-family: sans-serif;
    margin: 150px auto 20px auto;
    width: fit-content;
    height: 400px;
    overflow: auto;
  }

  table {
    width: 800px;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
  }

  th {
    background-color: #f8f8f8;
    font-weight: bold;
    color: #333;
  }

  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tbody tr:hover {
    background-color: #f1f1f1;
  }

  .actions {
    text-align: center;
  }

  .action-button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.1em;
    padding: 5px;
    margin: 0 4px;
    border-radius: 4px;
    transition: background-color 0.2s ease;
  }

  .action-button:hover {
     background-color: #eee;
  }

  .add-button-container {
    margin: auto;
    width: fit-content;
  }

  .add-button {
    align-items: center;
    padding: 10px 20px;
    background-color: #f0f0f0;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  }

  .add-button:hover {
    background-color: #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.15);
  }

</style>
