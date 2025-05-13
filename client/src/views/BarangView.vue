<!-- <template>

  <div class="flex h-screen items-center p-20">
    <div>
      <Navigator />
    </div>
    <div class="items-table-container w-full m-12">
      <table class="items-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Stock</th>
            <th>Terjual</th>
            <th>Harga</th>
            <th>Aksi</th> </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in items" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>{{ item.nama }}</td>
            <td>{{ item.stock }}</td>
            <td>{{ item.terjual }}</td>
            <td>{{ formatCurrency(item.harga) }}</td>
            <td class="actions">
               <button @click="editItem(item.id)" class="action-button edit-button">✏️</button>
               <button @click="deleteItem(item.id)" class="action-button delete-button">🗑️</button>
            </td>
          </tr>
        </tbody>
      </table>

      <button @click="addItem" class="add-button">
        <span class="add-icon">+</span> Tambah Barang
      </button>
    </div>
  </div>
  
</template>

<script setup>

  import Navigator from '@/components/Navigator.vue';
  import { ref } from 'vue';

  const items = ref([
    { id: 1, nama: 'Aqua', stock: 28, terjual: 2, harga: 3000 },
    { id: 2, nama: 'Mie Instan', stock: 19, terjual: 1, harga: 2500 },
    { id: 3, nama: 'Pasta Gigi', stock: 18, terjual: 2, harga: 4000 },
  ]);

  const formatCurrency = (value) => {
    return value.toLocaleString('id-ID');
  };

  const addItem = () => {
    console.log('Tambah Barang clicked');
    const newItemId = items.value.length > 0 ? Math.max(...items.value.map(i => i.id)) + 1 : 1;
     items.value.push({ id: newItemId, nama: 'Barang Baru', stock: 10, terjual: 0, harga: 5000 });
  };

  const editItem = (id) => {
    console.log(`Edit item with id: ${id}`);
  };

  const deleteItem = (id) => {
    console.log(`Delete item with id: ${id}`);
    items.value = items.value.filter(item => item.id !== id);
  };
  
</script>

<style scoped>

  .items-table-container {
    padding: 20px;
    font-family: sans-serif;
  }

  .items-table {
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

  .edit-button {
    color: #007bff;
  }

  .delete-button {
    color: #dc3545;
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


<script setup>

  import router from '@/router';
  import { ref } from 'vue';

  const barang = ref([]);

  (async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/barang');
      barang.value = await response.json();
    } catch (error) {
      // console.error(error);
      alert('gagal mengambil data barang');
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
        alert('gagal menghapus data barang');
      }
    } catch (error) {
      // console.error(error);
      alert('gagal menghapus data barang');
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
