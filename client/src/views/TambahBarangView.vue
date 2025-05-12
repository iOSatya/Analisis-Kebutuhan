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
        <label for="harga">Harga</label>
        <input
          type="number"
          id="harga"
          v-model.number="item.harga"
          placeholder="Masukkan harga barang"
          required
          min="0"
        />
      </div>

      <div class="button-group">
        <button type="submit" class="btn btn-update">UPDATE</button>
        <RouterLink :to="{ name: 'barang' }" class="btn btn-back">Kembali</RouterLink>
      </div>
    </form>
  </div>
</template>

<script setup>

  import { ref } from 'vue';

  const item = ref({
    nama: '',
    stock: 0,
    harga: 0,
  });

  const handleSubmit = async () => {
    
    try {
      const response = await fetch("http://127.0.0.1/api/barang", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(item.value)
      });

      const responseData = await response.json();
      alert(responseData["message"]);
    } catch (error) {
      console.log(error);
      alert("Kesalahan Sistem");
    }
    
  };

</script>

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