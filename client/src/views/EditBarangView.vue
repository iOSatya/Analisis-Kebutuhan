<script setup>

  import {onMounted, ref, watchEffect} from "vue";
  import router from "@/router/index.js";
  import {useRoute} from "vue-router";

  const route = useRoute();
  const editBarangForm = ref({
    nama: "",
    harga_jual: 0,
  })
  const submit = async () => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/barang/${route.params.id}`, {
        method: "PUT",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(editBarangForm.value)
      });
      if (response.ok) {
        alert("berhasil edit data barang");
        await router.push({name: 'barang'});
      } else {
        alert("gagal edit data barang");
      }
    } catch (error) {
      // console.log(error);
      alert("kesalahan sistem");
    }
  }

  watchEffect(async () => {
      const val = editBarangForm.value.harga_jual;
      if (val < 0) {
        alert("input harga tidak valid")
        editBarangForm.value.harga_jual = 0;
      }
    }
  )

  onMounted(async () => {
    try {
      const response = await fetch(`http://127.0.0.1:8000/api/barang/${route.params.id}`);
      if (response.ok) {
        const data = await response.json();
        editBarangForm.value.nama = data.nama;
        editBarangForm.value.harga_jual = data.harga_jual;
      } else {
        alert("gagal fetch data barang");
      }
    } catch (error) {
      // console.log(error);
      alert("kesalahan sistem");
    }
  });

</script>

<template>

  <div class="form-container">
    <form @submit.prevent="submit" class="form">
      <h1 class="form-title">EDIT BARANG</h1>

      <!-- Nama Barang -->
      <label class="form-label">Nama</label>
      <div class="form-input">
        <input v-model="editBarangForm.nama" type="text" class="input-text" />
      </div>

      <!-- Harga Jual -->
      <label class="form-label">Harga Jual</label>
      <div class="form-input">
        <input v-model="editBarangForm.harga_jual" type="number" class="input-text input-disabled" />
      </div>

      <!-- Buttons -->
      <div class="button-group">
        <button @click="router.push({ name: 'barang' })" class="btn btn-back">
          KEMBALI
        </button>
        <button class="btn btn-submit">SUBMIT</button>
      </div>
    </form>
  </div>

</template>

<style scoped>
  .form-container {
    max-width: 400px;
    margin: 40px auto;
    padding: 16px;
    font-family: sans-serif;
  }

  .form-title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 24px;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 1px 1px 1px #ccc;
  }

  .form-label {
    display: block;
    margin-top: 16px;
    font-weight: 600;
  }

  .form-input {
    background-color: #e0e0e0;
    border-radius: 999px;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    margin-top: 6px;
  }

  .input-text {
    border: none;
    background: transparent;
    width: 100%;
    font-size: 14px;
    outline: none;
  }

  .button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 24px;
  }

  .btn {
    flex: 1;
    padding: 10px;
    border-radius: 999px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-back {
    background-color: #ffdede;
    color: #000;
    margin-right: 10px;
  }

  .btn-submit {
    background-color: #d4ffd4;
    color: #000;
    margin-left: 10px;
  }
</style>