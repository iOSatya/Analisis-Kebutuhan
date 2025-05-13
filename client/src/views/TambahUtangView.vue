<template>

    <div class="form-container">
        <form @submit.prevent="submit" class="form">
            <h1 class="form-title">TAMBAH DATA UTANG</h1>

            <!-- Nama Penghutang -->
            <label class="form-label">Nama Penghutang</label>
            <div class="form-input">
                <input v-model="tambahUtangForm.nama" type="text" placeholder="masukkan nama penghutang" class="input-text" />
            </div>

            <!-- Tanggal Berhutang -->
            <label class="form-label">Tanggal Berhutang</label>
            <div class="form-input icon-input">
                <input v-model="tambahUtangForm.tanggal_berhutang" type="date" class="input-text" />
            </div>

            <!-- Barang -->
            <label class="form-label">Barang</label>
            <div class="form-input">
                <select class="input-select" v-model="tambahUtangForm.barang_id">
                    <option disabled value="">-- Pilih Barang --</option>
                    <option v-for="item in barang" :key="item.id" :value="item.id">{{ item.nama }} ({{ item.sisa_stock }})</option>
                </select>
            </div>

            <!-- Jumlah Barang -->
            <label class="form-label">Jumlah Barang</label>
            <div class="form-input">
                <input @click="taek" v-model="tambahUtangForm.jumlah_barang" type="number" value="0" class="input-number" />
            </div>

            <!-- Nominal Utang -->
            <label class="form-label">Nominal Utang</label>
            <div class="form-input">
                <input v-model="tambahUtangForm.nominal_utang" type="text" class="input-text input-disabled" disabled />
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button @click="back" class="btn btn-back">
                    KEMBALI
                </button>
                <button class="btn btn-submit">SUBMIT</button>
            </div>
        </form>
    </div>

</template>

<script setup>
    
    import router from '@/router';
    import { ref, watchEffect } from 'vue';

    const barang = ref([]);

    const tambahUtangForm = ref({
        tanggal_berhutang: "", 
        nama: "", 
        barang_id: "", 
        nama_barang: "", 
        jumlah_barang: 0, 
        nominal_utang: 0
    });

    const submit = async () => {
        try {
            const response = await fetch("http://127.0.0.1:8000/api/utang", {
                method: "POST",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(tambahUtangForm.value)
            });
            if (response.ok) {
                alert("berhasil menambah data utang");
                router.push({ name: 'utang' });
            } else {
                alert("gagal menambah data utang");
            }
        } catch (error) {
            // console.log(error);
            alert("kesalahan sistem");
        }
    }

    const back = () => {
        router.push({ name: 'utang' });
    };

    (async () => {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/barang');
            const data = await response.json();
            barang.value = data.filter(item => item.sisa_stock > 0);
        } catch (error) {
            // console.error(error);
            alert('gagal mengambil data barang');
        }
    })();

    watchEffect(async () => {
        const idBarang = tambahUtangForm.value.barang_id;
        const jumlah_barang = tambahUtangForm.value.jumlah_barang;
        tambahUtangForm.value.nama_barang = barang.value.find(item => item.id === idBarang)?.nama || "";
        barang.value.forEach(item => {
            if (item.id === idBarang) {
                if (jumlah_barang > item.sisa_stock) {
                    alert("jumlah barang melebihi stock");
                    tambahUtangForm.value.jumlah_barang = item.sisa_stock;
                    tambahUtangForm.value.nominal_utang = item.harga_jual * item.sisa_stock;
                } else if (jumlah_barang < 0) {
                    alert("jumlah barang tidak boleh kurang dari 0");
                    tambahUtangForm.value.jumlah_barang = 0;
                    tambahUtangForm.value.nominal_utang = 0;
                } else {
                    tambahUtangForm.value.nominal_utang = item.harga_jual * jumlah_barang;
                }
            }
        });
    })
</script>


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

    .input-text,
    .input-number,
    .input-select {
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
