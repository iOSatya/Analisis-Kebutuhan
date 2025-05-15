<template>

  <div class="container">
    <!-- Search bar -->
    <div class="search-bar-wrapper">
      <input type="text" placeholder="cari barang..." class="search-bar" />
      <button class="btn btn-search">Search</button>
      <button class="btn btn-clear">Clear</button>
    </div>

    <!-- Item table -->
    <div class="table-wrapper">
      <table>
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
        <tr v-for="(barang, index) in listBarang" :key="barang.id">
          <td>{{ index + 1 }}</td>
          <td>{{ barang.nama }}</td>
          <td>{{ barang.sisa_stock }}</td>
          <td>{{ barang.harga_jual }}</td>
          <td>
            <input
                v-model.number="listJumlahBarangBelanjaanPelanggan[index]"
                @input="listIndex[index] = index"
                type="number">
          </td>
          <td>{{ listJumlahBarangBelanjaanPelanggan[index] * barang.harga_jual }}</td>
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

<script setup>
import {onMounted, ref, watchEffect} from "vue";

  const listIndex = ref([]);
  const listBarang = ref([]);
  const listJumlahBarangBelanjaanPelanggan = ref([]);
  const belanjaanPelanggan = ref([]);
  const totalHargaKeseluruhan = ref(0);

  const prosesTransaksi = async () => {
    for (const i in listIndex.value) {
      belanjaanPelanggan.value.push({
        tanggal: new Date().toISOString().slice(0, 19).replace('T', ' '),
        barang_id: listBarang.value[i].id,
        nama: listBarang.value[i].nama,
        harga: listBarang.value[i].harga_jual,
        jumlah_barang: listJumlahBarangBelanjaanPelanggan.value[i],
        total: listJumlahBarangBelanjaanPelanggan.value[i] * listBarang.value[i].harga_jual,
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
          alert(responseData.message);
        } else {
          alert("gagal proses transaksi");
        }
      } else {
        alert("keranjang masih kosong");
      }
    } catch (error) {
      // console.log(error);
      alert("kesalahan sistem");
    }
    window.location.reload();
  }

  watchEffect(async () => {
    const data = listJumlahBarangBelanjaanPelanggan.value
    const listTotal = Array(listBarang.value.length).fill(0);
    for (const i in listIndex.value) {
      if (data[i] < 0) {
        alert("jumlah barang tidak boleh negatif")
        data[i] = 0
      } else if (data[i] > listBarang.value[i].sisa_stock) {
        alert("jumlah barang tidak boleh melebihi sisa stock")
        data[i] = listBarang.value[i].sisa_stock
      }
      listTotal.push(data[i] * listBarang.value[i].harga_jual);
    }
    totalHargaKeseluruhan.value = eval(listTotal.join('+'))
  })
  onMounted(async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/barang');
      listBarang.value = await response.json();
      listJumlahBarangBelanjaanPelanggan.value = Array(listBarang.value.length).fill(0);
    } catch (error) {
      // console.error(error);
      alert('gagal mengambil data barang');
    }
  });

</script>

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

  .table-wrapper {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #ddd;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
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

