<script setup>
  import {onMounted, ref, watchEffect} from "vue";
  import PrimaryButton from "@/components/PrimaryButton.vue";
  import {alertError, alertSuccess, alertWarning} from "../../lib/alert.js";

  const searchInput = ref("");
  const currIndex = ref(null);
  const listIndex = ref([]);
  const listBarang = ref([]);
  const originalListBarang = ref([]); 
  const listTotal = ref([]);
  const listJumlahBarangBelanjaanPelanggan = ref([]);
  const belanjaanPelanggan = ref([]);
  const totalHargaKeseluruhan = ref(0);

    const clearSearchInput = () => {
      searchInput.value = "";
    }

    const prosesTransaksi = async () => {
    for (const i in listIndex.value) {
      belanjaanPelanggan.value.push({
        tanggal: getClientLocalDateTime(),
        barang_id: originalListBarang.value[i].id,
        nama: originalListBarang.value[i].nama,
        harga: originalListBarang.value[i].harga_jual,
        jumlah_barang: listJumlahBarangBelanjaanPelanggan.value[i],
        total: listJumlahBarangBelanjaanPelanggan.value[i] * originalListBarang.value[i].harga_jual,
      })
    }
    try {
      if (belanjaanPelanggan.value.length > 0) {
        const response = await fetch("http://127.0.0.1:8000/api/transaksi", {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify(belanjaanPelanggan.value)
        });

        const responseData = await response.json();
        if (response.ok) {
          await alertSuccess(responseData.message);
        } else {
          await alertError("Proses transaksi gagal!");
        }
      } else {
        await alertWarning("Keranjang masih kosong!");
      }
    } catch (error) {
      // console.log(error);
      await alertError("Kesalahan sistem!");
    }
    window.location.reload();
  }

  function getClientLocalDateTime() {
    const now = new Date();
    const pad = n => String(n).padStart(2, '0');
    return `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())} ` +
          `${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
  }

  watchEffect(async () => {
    const data = currIndex.value
    if (data !== null) {
      if (listJumlahBarangBelanjaanPelanggan.value[data] < 0) {
        await alertWarning("Jumlah barang tidak boleh negatif!")
        listJumlahBarangBelanjaanPelanggan.value[data] = 0
      } else if (listJumlahBarangBelanjaanPelanggan.value[data] > originalListBarang.value[data].sisa_stock) {
        await alertWarning("Jumlah barang tidak boleh melebihi sisa stock!")
        listJumlahBarangBelanjaanPelanggan.value[data] = originalListBarang.value[data].sisa_stock
      }
      listTotal.value[data] = listJumlahBarangBelanjaanPelanggan.value[data] * originalListBarang.value[data].harga_jual
    }
    totalHargaKeseluruhan.value = listTotal.value.reduce((a, b) => a + b, 0);
  })

  watchEffect(() => {
    const term = searchInput.value.trim().toLowerCase();

    if (term) {
      listBarang.value = originalListBarang.value
        .map((item, index) => ({ ...item, originalIndex: index }))
        .filter(barang => barang.nama.toLowerCase().includes(term));
    } else {
      listBarang.value = originalListBarang.value.map((item, index) => ({ ...item, originalIndex: index }));
    }
  });

  onMounted(async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/barang');
      const data = await response.json();
      listBarang.value = data;
      originalListBarang.value = data;
      listJumlahBarangBelanjaanPelanggan.value = Array(originalListBarang.value.length).fill(0);
    } catch (error) {
      await alertError('Gagal mengambil data barang!');
    }
  });

</script>

<template>

  <div class="page">
    <h1 class="title">Kasir</h1>
    <!-- Search bar -->
    <div class="search-bar-wrapper">
      <input v-model="searchInput" type="text" placeholder="cari barang..." class="search-bar" />
      <button @click="clearSearchInput" class="btn btn-clear">Clear</button>
    </div>

    <!-- Item table -->
    <div class="table-container">
        <table class="table-design">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Sisa Stock</th>
            <th>Harga</th>
            <th>Jumlah Barang</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="barang in listBarang" :key="barang.id">
            <td>{{ barang.originalIndex + 1 }}</td>
            <td>{{ barang.nama }}</td>
            <td>{{ barang.sisa_stock }}</td>
            <td>{{ barang.harga_jual }}</td>
            <td>
              <input
                  v-model.number="listJumlahBarangBelanjaanPelanggan[barang.originalIndex]"
                  @input="listIndex[barang.originalIndex] = barang.originalIndex, currIndex = barang.originalIndex"
                  type="number">
            </td>
            <td>{{ listJumlahBarangBelanjaanPelanggan[barang.originalIndex] * barang.harga_jual }}</td>
          </tr>
          </tbody>
        </table>
      </div>

    <!-- Total harga keseluruhan -->
    <br>
    <h2>Total Harga Keseluruhan : {{ totalHargaKeseluruhan }} </h2>

    <!-- Proses Transaksi -->
    <button class="process-btn" @click="prosesTransaksi">
      💲 Proses Transaksi
    </button>
  </div>

</template>

<style scoped>

  .search-bar-wrapper {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
  }

  .search-bar {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .btn {
    padding: 8px 14px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
  }

  .btn-search {
    background-color: #4caf50;
    color: white;
  }

  .btn-search:hover {
    background-color: #45a049;
  }

  .btn-clear {
    background-color: #f44336;
    color: white;
  }

  .btn-clear:hover {
    background-color: #d32f2f;
  }

  .container {
    padding: 20px;
    max-width: 900px;
    margin: 140px auto 0 auto;
    font-family: sans-serif;
  }

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

  button {
    padding: 4px 8px;
    margin: 0 4px;
  }

  .process-btn {
    margin-top: 20px;
    font-size: 18px;
    padding: 10px 20px;
    cursor: pointer;
  }

</style>

