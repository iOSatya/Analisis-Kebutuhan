<!--<template>-->

<!--  <div class="container">-->
<!--    &lt;!&ndash; Search bar &ndash;&gt;-->
<!--    <div class="search-bar-wrapper">-->
<!--      <input v-model="searchInput" type="text" placeholder="cari barang..." class="search-bar" />-->
<!--      <button @click="doSearch" class="btn btn-search">Search</button>-->
<!--      <button @click="clearSearch" class="btn btn-clear">Clear</button>-->
<!--    </div>-->

<!--    &lt;!&ndash; Item table &ndash;&gt;-->
<!--    <div class="table-wrapper">-->
<!--      <table>-->
<!--        <thead>-->
<!--        <tr>-->
<!--          <th>No</th>-->
<!--          <th>Nama</th>-->
<!--          <th>Sisa Stock</th>-->
<!--          <th>Harga</th>-->
<!--          <th>Jumlah Barang</th>-->
<!--          <th>Total</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        <tr v-for="(item, index) in barang" :key="item.id">-->
<!--          <td>{{ index + 1 }}</td>-->
<!--          <td>{{ item.nama }}</td>-->
<!--          <td>{{ item.sisa_stock }}</td>-->
<!--          <td>{{ item.harga_jual }}</td>-->
<!--          <td>-->
<!--            &lt;!&ndash;            <button @click="increaseAndDecrease('decrease', index, item)">◀</button>&ndash;&gt;-->
<!--            &lt;!&ndash;            {{ jumlahBarang[index] }}&ndash;&gt;-->
<!--            &lt;!&ndash;            <button @click="increaseAndDecrease('increase', index, item)">▶</button>&ndash;&gt;-->
<!--            <input type="number" v-model.number="jumlahBarangVal[index]" @input="currIndex = index">-->
<!--          </td>-->
<!--&lt;!&ndash;          <td>{{ jumlahBarang[index] * item.harga_jual }}</td>&ndash;&gt;-->
<!--          <td>{{ jumlahBarangVal[index] * item.harga_jual }}</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--      </table>-->
<!--    </div>-->

<!--    &lt;!&ndash; Total harga keseluruhan &ndash;&gt;-->
<!--    <br>-->
<!--    <h2>Total Harga Keseluruhan : {{ sum(belanja.total) }} </h2>-->

<!--    &lt;!&ndash; Proses Transaksi &ndash;&gt;-->
<!--    <button class="process-btn" @click="prosesTransaksi">-->
<!--      💲 Proses Transaksi-->
<!--    </button>-->
<!--  </div>-->

<!--</template>-->

<!--<script setup>-->
<!--  import {onMounted, ref, watchEffect} from "vue";-->

<!--  const jumlahBarangVal = ref([]);-->
<!--  const searchInput = ref("")-->
<!--  const currIndex = ref(0)-->
<!--  const sum = a => eval(a.join('+'));-->
<!--  const barang = ref([]);-->
<!--  const jumlahBarang = ref([]);-->
<!--  const belanja = ref({-->
<!--    "barang_id": [],-->
<!--    "nama": [],-->
<!--    "harga": [],-->
<!--    "jumlah_barang": [],-->
<!--    "total": []-->
<!--  });-->

<!--  const increaseAndDecrease = async (condition, index, barang) => {-->
<!--    if (condition === "increase") {-->
<!--      jumlahBarang.value[index]++;-->
<!--    } else {-->
<!--      jumlahBarang.value[index]&#45;&#45;;-->
<!--    }-->

<!--    if (jumlahBarang.value[index] > barang.sisa_stock) {-->
<!--      alert("jumlah barang melebihi sisa stock")-->
<!--      jumlahBarang.value[index] = barang.sisa_stock;-->
<!--    } else if (jumlahBarang.value[index] < 0) {-->
<!--      alert("jumlah barang tidak boleh negatif")-->
<!--      jumlahBarang.value[index] = 0;-->
<!--    } else {-->
<!--      if (jumlahBarang.value[index] > 0) {-->
<!--        belanja.value.barang_id[index] = barang.id;-->
<!--        belanja.value.nama[index] = barang.nama;-->
<!--        belanja.value.harga[index] = barang.harga_jual;-->
<!--        belanja.value.jumlah_barang[index] = jumlahBarang.value[index];-->
<!--        belanja.value.total[index] = jumlahBarang.value[index] * barang.harga_jual;-->
<!--      } else {-->
<!--        delete belanja.value.barang_id[index]-->
<!--        delete belanja.value.harga[index]-->
<!--        delete belanja.value.jumlah_barang[index]-->
<!--        delete belanja.value.nama[index]-->
<!--        delete belanja.value.total[index]-->
<!--      }-->
<!--    }-->
<!--  }-->
<!--  const prosesTransaksi = async () => {-->
<!--    // try {-->
<!--    //   belanja.value.barang_id = belanja.value.barang_id.filter((e) => e);-->
<!--    //   belanja.value.nama = belanja.value.nama.filter((e) => e);-->
<!--    //   belanja.value.harga = belanja.value.harga.filter((e) => e);-->
<!--    //   belanja.value.jumlah_barang = belanja.value.jumlah_barang.filter((e) => e);-->
<!--    //   belanja.value.total = belanja.value.total.filter((e) => e);-->
<!--    //-->
<!--    //   if (belanja.value.nama.length > 0) {-->
<!--    //     const response = await fetch("http://127.0.0.1:8000/api/transaksi", {-->
<!--    //       method: "POST",-->
<!--    //       headers: {"Content-Type": "application/json"},-->
<!--    //       body: JSON.stringify(belanja.value)-->
<!--    //     });-->
<!--    //-->
<!--    //     const responseData = await response.json();-->
<!--    //     if (response.ok) {-->
<!--    //       alert(responseData.message);-->
<!--    //       window.location.reload();-->
<!--    //     } else {-->
<!--    //       alert("gagal proses transaksi");-->
<!--    //     }-->
<!--    //   } else {-->
<!--    //     alert("keranjang masih kosong");-->
<!--    //   }-->
<!--    // } catch (error) {-->
<!--    //   console.log(error);-->
<!--    //   alert("kesalahan sistem");-->
<!--    // }-->
<!--  }-->
<!--  const doSearch = async () => {-->
<!--    //   TODO-->
<!--  }-->
<!--  const clearSearch = async () => {-->
<!--    //   TODO-->
<!--  }-->

<!--  onMounted(async () => {-->
<!--    try {-->
<!--      const response = await fetch('http://127.0.0.1:8000/api/barang');-->
<!--      barang.value = await response.json();-->
<!--      jumlahBarang.value = barang.value.map(() => 0);-->
<!--    } catch (error) {-->
<!--      // console.error(error);-->
<!--      alert('gagal mengambil data barang');-->
<!--    }-->
<!--  });-->

<!--  watchEffect(async () => {-->
<!--    jumlahBarangVal.value = Array(barang.value.length).fill(0);-->
<!--    const currIndexBuff = currIndex.value;-->
<!--  })-->

<!--</script>-->

<!--<style scoped>-->

<!--.search-bar-wrapper {-->
<!--  display: flex;-->
<!--  gap: 10px;-->
<!--  margin-bottom: 16px;-->
<!--}-->

<!--.search-bar {-->
<!--  flex: 1;-->
<!--  padding: 8px;-->
<!--  border: 1px solid #ccc;-->
<!--  border-radius: 4px;-->
<!--}-->

<!--.btn {-->
<!--  padding: 8px 14px;-->
<!--  border: none;-->
<!--  border-radius: 4px;-->
<!--  font-weight: 600;-->
<!--  cursor: pointer;-->
<!--  transition: background-color 0.2s ease;-->
<!--}-->

<!--.btn-search {-->
<!--  background-color: #4caf50;-->
<!--  color: white;-->
<!--}-->

<!--.btn-search:hover {-->
<!--  background-color: #45a049;-->
<!--}-->

<!--.btn-clear {-->
<!--  background-color: #f44336;-->
<!--  color: white;-->
<!--}-->

<!--.btn-clear:hover {-->
<!--  background-color: #d32f2f;-->
<!--}-->

<!--.container {-->
<!--  padding: 20px;-->
<!--  max-width: 900px;-->
<!--  margin: 140px auto 0 auto;-->
<!--  font-family: sans-serif;-->
<!--}-->

<!--.table-wrapper {-->
<!--  max-height: 300px;-->
<!--  overflow-y: auto;-->
<!--  border: 1px solid #ddd;-->
<!--}-->

<!--table {-->
<!--  width: 100%;-->
<!--  border-collapse: collapse;-->
<!--}-->

<!--th, td {-->
<!--  text-align: left;-->
<!--  padding: 8px;-->
<!--  border-bottom: 1px solid #ddd;-->
<!--}-->

<!--button {-->
<!--  padding: 4px 8px;-->
<!--  margin: 0 4px;-->
<!--}-->

<!--.process-btn {-->
<!--  margin-top: 20px;-->
<!--  font-size: 18px;-->
<!--  padding: 10px 20px;-->
<!--  cursor: pointer;-->
<!--}-->

<!--</style>-->


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

