<!-- <template>

  <div class="flex h-screen items-center p-20">
    <div>
      <Navigator />
    </div>
    <div class="debts-table-container w-full m-12">
      <table class="debts-table">
        <thead>
          <tr>
            <th>Tanggal Berhutang</th>
            <th>Tanggal Lunas</th>
            <th>Nama</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Nominal Utang</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="debt in debts" :key="debt.id">
            <td>{{ debt.tanggalBerhutang }}</td>
            <td>{{ debt.tanggalLunas || '-' }}</td>
            <td>{{ debt.nama }}</td>
            <td>{{ debt.namaBarang }}</td>
            <td>{{ debt.jumlahBarang }}</td>
            <td>{{ formatCurrency(debt.nominalUtang) }}</td>
            <td :class="getStatusClass(debt.status)">{{ debt.status }}</td>
            <td class="actions">
                <button @click="deleteDebt(debt.id)" class="action-button delete-button">🗑️</button>
                <button v-if="debt.status === 'Belum Lunas'" @click="markAsPaid(debt.id)" class="action-button paid-button" title="Tandai Lunas">
                  ✔️
                </button>
                <span v-else class="action-placeholder">✅</span>
            </td>
          </tr>
        </tbody>
      </table>

      <button @click="addDebt" class="add-button">
        <span class="add-icon">+</span> Tambah Data Utang
      </button>
    </div>
  </div>

</template>

<script setup>

  import Navigator from '@/components/Navigator.vue';
  import { ref } from 'vue';

  const debts = ref([
    { id: 1, tanggalBerhutang: '20-3-2025', tanggalLunas: '20-3-2025', nama: 'Bedil', namaBarang: 'Pasta Gigi', jumlahBarang: 2, nominalUtang: 8000, status: 'Lunas' },
    { id: 2, tanggalBerhutang: '20-3-2025', tanggalLunas: '20-3-2025', nama: 'Wisang', namaBarang: 'Aqua', jumlahBarang: 2, nominalUtang: 3000, status: 'Lunas' },
    { id: 3, tanggalBerhutang: '19-3-2025', tanggalLunas: null, nama: 'Kalpin', namaBarang: 'Pasta Gigi', jumlahBarang: 1, nominalUtang: 4000, status: 'Belum Lunas' },
  ]);

  const formatCurrency = (value) => {
    return value.toLocaleString('id-ID');
  };

  const getStatusClass = (status) => {
    return status === 'Lunas' ? 'status-lunas' : 'status-belum-lunas';
  };

  const addDebt = () => {
    console.log('Tambah Data Utang clicked');
      const newDebtId = debts.value.length > 0 ? Math.max(...debts.value.map(d => d.id)) + 1 : 1;
      const today = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/\//g, '-');
      debts.value.push({
        id: newDebtId,
        tanggalBerhutang: today,
        tanggalLunas: null,
        nama: 'Orang Baru',
        namaBarang: 'Barang X',
        jumlahBarang: 1,
        nominalUtang: 5000,
        status: 'Belum Lunas'
      });
  };

  const deleteDebt = (id) => {
    console.log(`Delete debt with id: ${id}`);
    debts.value = debts.value.filter(debt => debt.id !== id);
  };

  const markAsPaid = (id) => {
    console.log(`Mark debt as paid with id: ${id}`);
    const debtIndex = debts.value.findIndex(debt => debt.id === id);
    if (debtIndex !== -1) {
      debts.value[debtIndex].status = 'Lunas';
      debts.value[debtIndex].tanggalLunas = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/\//g, '-');
    }
  };

</script>

<style scoped>

  .debts-table-container {
    padding: 20px;
    font-family: sans-serif;
  }

  .debts-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    white-space: nowrap;
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

  .status-lunas {
    color: #28a745;
    font-weight: bold;
  }

  .status-belum-lunas {
    color: #dc3545;
    font-weight: bold;
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
    vertical-align: middle;
  }

  .action-button:hover {
      background-color: #eee;
  }

  .delete-button {
    color: #dc3545;
  }

  .paid-button {
    color: #28a745;
  }

  .action-placeholder {
      display: inline-block;
      padding: 5px;
      margin: 0 4px;
      font-size: 1.1em;
      color: #bbb;
      vertical-align: middle;
  }

  .add-button {
    display: inline-flex;
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

  .add-icon {
    display: inline-block;
    width: 20px;
    height: 20px;
    line-height: 18px;
    text-align: center;
    border: 1px solid #aaa;
    border-radius: 50%;
    margin-right: 8px;
    font-weight: bold;
    color: #555;
  }

</style> -->

<!-- ------------------------------------------------------------------------------------------------------------------------------ -->

<template>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Tanggal Berhutang</th>
          <th>Tanggal Lunas</th>
          <th>Nama</th>
          <th>Nama Barang</th>
          <th>Jumlah Barang</th>
          <th>Nominal Utang</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="debt in debts" :key="debt.id">
          <td>{{ debt.tanggal_berhutang }}</td>
          <td>{{ debt.tanggal_lunas || '-' }}</td>
          <td>{{ debt.nama }}</td>
          <td>{{ debt.nama_barang }}</td>
          <td>{{ debt.jumlah_barang }}</td>
          <td>{{ formatCurrency(debt.nominal_utang) }}</td>
          <td :class="getStatusClass(debt.status)">{{ debt.status }}</td>
          <td class="actions">
              <button v-if="!debt.tanggal_lunas" @click="markAsPaid(debt.id)" style="cursor: pointer;" title="Tandai Lunas">
                ✔️
              </button>
              <span v-else>✅</span>
              <button @click="deleteDebt(debt.id)" class="action-button delete-button">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="add-button-container">
    <button @click="addDebt" class="add-button">
      <span class="">➕</span> Tambah Data Utang
    </button>
  </div>

</template>

<script setup>

  import router from '@/router';
import { ref } from 'vue';

  const debts = ref([]);

  (async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/utang');
      debts.value = await response.json();
    } catch (error) {
      // console.error(error);
      alert('gagal mengambil data utang');
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
        alert('gagal hapus utang');
      }
    } catch (error) {
      // console.error(error);
      alert('gagal hapus utang');
    }
  };

  const markAsPaid = async (id) => {
    try {
      const tanggalLunas = new Date().toISOString().split('T')[0];
      const response = await fetch(`http://127.0.0.1:8000/api/utang/${id}`, {
        method: "PUT",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
          "tanggal_lunas": tanggalLunas,
        })
      });
      if (response.ok) {
        const debtIndex = debts.value.findIndex(debt => debt.id === id);
        if (debtIndex !== -1) {
          debts.value[debtIndex].status = 'Lunas';
          debts.value[debtIndex].tanggal_lunas = tanggalLunas;
        }
      } else {
        alert('gagal menandai lunas utang');
      }
    } catch (error) {
      // console.error(error);
      alert('gagal menandai lunas utang');
    }
  };

</script>

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
    width: 1100px;
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
    margin-left: 15px;
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