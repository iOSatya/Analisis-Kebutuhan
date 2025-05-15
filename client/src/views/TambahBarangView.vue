<script setup>

  import router from '@/router';
  import { ref } from 'vue';

  const item = ref({
    nama: '',
    harga_beli: 0,
    harga_jual: 0,
    stock: 0,
    modal: 0
  });


  const handleSubmit = async () => {
    try {
      const response = await fetch("http://127.0.0.1:8000/api/barang", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(item.value)
      });

      const responseData = await response.json();
      if (response.ok) {
        alert(responseData.message);
        await router.push({name: "barang"});
      } else {
        alert("gagal menambahkan barang");
      }
    } catch (error) {
      console.log(error);
      alert("kesalahan sistem");
    }
  };

  const calculateModal = () => {
    item.value.modal = item.value.harga_beli * item.value.stock;
  };

</script>

<template>
  <div class="add-item-form-container">
    <h2 class="form-title">TAMBAH BARANG</h2>
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="namaBarang">Nama Barang</label>
        <input
            type="text"
            id="namaBarang"
            v-model="item.nama"
            placeholder="Masukkan nama barang"
            required
        />
      </div>
      <div class="form-group">
        <label for="hargaBeli">Harga Beli</label>
        <input
            type="number"
            id="hargaBeli"
            v-model.number="item.harga_beli"
            placeholder="Masukkan harga beli barang"
            required
            min="0"
        />
      </div>
      <div class="form-group">
        <label for="hargaJual">Harga Jual</label>
        <input
            type="number"
            id="hargaJual"
            v-model.number="item.harga_jual"
            placeholder="Masukkan harga jual barang"
            required
            min="0"
        />
      </div>
      <div class="form-group">
        <label for="stock">Stock</label>
        <input
            type="number"
            id="stock"
            v-model.number="item.stock"
            placeholder="Masukkan jumlah stock"
            required
            min="0"
        />
      </div>
      <div class="form-group">
        <label for="modal">Modal</label>
        <div class="input-with-button">
          <input
              type="number"
              id="modal"
              v-model.number="item.modal"
              placeholder="Total modal (harga beli × stock)"
              required
              min="0"
          />
          <button
              type="button"
              class="btn-calculate"
              @click="calculateModal"
          >
            Hitung
          </button>
        </div>
      </div>
      <div class="button-group">
        <button type="submit" class="btn btn-update">SIMPAN</button>
        <RouterLink :to="{ name: 'barang' }" class="btn btn-back">Kembali</RouterLink>
      </div>
    </form>
  </div>
</template>

<style scoped>
.add-item-form-container {
  padding: 30px;
  max-width: 500px;
  margin: 0 auto;
  font-family: sans-serif;
}
.form-title {
  text-align: center;
  margin-bottom: 30px;
  font-weight: bold;
  color: #333;
}
.form-group {
  margin-bottom: 20px;
}
label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  color: #555;
}
input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid #ccc;
  border-radius: 25px;
  box-sizing: border-box;
  background-color: #f0f0f0;
  color: #333;
  font-size: 1em;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
input[type="text"]:focus,
input[type="number"]:focus {
  outline: none;
  border-color: #aaa;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.button-group {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.input-with-button {
  display: flex;
  gap: 10px;
}

.input-with-button input {
  flex: 1;
}

.btn-calculate {
  background-color: #e0f2f1;
  color: #333;
  border: none;
  border-radius: 25px;
  padding: 0 15px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-calculate:hover {
  background-color: #b2dfdb;
}
.btn {
  padding: 15px 20px;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-size: 1em;
  font-weight: bold;
  text-align: center;
  transition: background-color 0.2s ease, transform 0.1s ease;
  width: 100%;
}
.btn:active {
  transform: scale(0.98);
}
.btn-update {
  background-color: #b2f2bb;
  color: #333;
}
.btn-update:hover {
  background-color: #a1e0a9;
}
.btn-back {
  background-color: #f5c6cb;
  color: #333;
}
.btn-back:hover {
  background-color: #e4b5ba;
}
</style>