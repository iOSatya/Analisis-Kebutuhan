<script setup>

import router from '@/router';
import { ref } from 'vue';
import {alertError} from "../../lib/alert.js";

const debts = ref([]);

(async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/utang');
    debts.value = await response.json();
  } catch (error) {
    // console.error(error);
    await alertError('Gagal mengambil data utang!');
  }
})();

const formatCurrency = (value) => {
  return value.toLocaleString('id-ID');
};

const getStatusClass = (status) => {
  return status === 'Lunas' ? 'status-lunas' : 'status-belum-lunas';
};

const addDebt = () => {
  router.push({ name: 'tambahUtang' });
};

const deleteDebt = async (id) => {
  try {
    const response = await fetch(`http://127.0.0.1:8000/api/utang/${id}`, {
      method: "DELETE",
      headers: {"Content-Type": "application/json"},
    });
    if (response.ok) {
      debts.value = debts.value.filter(debt => debt.id !== id);
    } else {
      await alertError('Gagal menghapus data utang!');
    }
  } catch (error) {
    // console.error(error);
    await alertError('Gagal menghapus data utang!');
  }
};

const markAsPaid = async (id) => {
  try {
    const tanggalLunas = new Date().toISOString().split('T')[0];
    const response = await fetch(`http://127.0.0.1:8000/api/utang/${id}`, {
      method: "PUT",
      headers: {"Content-Type": "application/json"},
      body: JSON.stringify({
        tanggal_lunas: tanggalLunas,
      })
    });
    if (response.ok) {
      const debtIndex = debts.value.findIndex(debt => debt.id === id);
      if (debtIndex !== -1) {
        debts.value[debtIndex].status = 'Lunas';
        debts.value[debtIndex].tanggal_lunas = tanggalLunas;
      }
    } else {
      await alertError('Gagal mengubah status utang!');
    }
  } catch (error) {
    // console.error(error);
    await alertError('Gagal mengubah status utang!');
  }
};

</script>

<template>
  <div class="page">
    <h1 class="title">Utang</h1>
    <div class="table-container">
      <table class="table-design">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Berhutang</th>
          <th>Tanggal Lunas</th>
          <th>Nama</th>
          <th>Nama Barang</th>
          <th>Jumlah Barang</th>
          <th>Nominal Utang</th>
          <th>Status</th>
          <th colspan="2">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(debt, index) in debts" :key="debt.id">
          <td>{{ index + 1 }}</td>
          <td>{{ debt.tanggal_berhutang }}</td>
          <td>{{ debt.tanggal_lunas || '-' }}</td>
          <td>{{ debt.nama }}</td>
          <td>{{ debt.nama_barang }}</td>
          <td>{{ debt.jumlah_barang }}</td>
          <td><b>{{ formatCurrency(debt.nominal_utang) }}</b></td>
          <td :class="getStatusClass(debt.status)">{{ debt.status }}</td>
          <td v-if="!debt.tanggal_lunas" @click="markAsPaid(debt.id)" class="actions">
            <span>✔️</span>
          </td>
            <td v-else class="status-lunas">
              <span>✅</span>
            </td>
          <td @click="deleteDebt(debt.id)" class="actions">
            <span>🗑️</span>
          </td>
        </tr>
        </tbody>
        <tfoot>
          <tr @click="addDebt" class="row-button">
            <td colspan="10">
              <span>➕</span> Tambah Data Utang
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

  .status-lunas {
    cursor: not-allowed;
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