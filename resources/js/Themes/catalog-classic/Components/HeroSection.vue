<template>
    <section class="bg-amber-100 py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-[0.95fr_1.05fr] gap-10 items-center">
                <div class="bg-white/80 border border-amber-200 rounded-2xl p-8 shadow-sm">
                    <p class="text-sm uppercase tracking-[0.25em] text-amber-700 mb-3">Catalog Classic</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ headerText }}
                    </h2>
                    <p class="text-gray-600 text-base mb-6">
                        {{ subHeaderText }}
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="bg-amber-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-amber-800 transition">
                            Lihat Koleksi
                        </button>
                        <button
                            class="border border-amber-700 text-amber-700 px-6 py-3 rounded-lg font-semibold hover:bg-amber-50 transition">
                            Minta Katalog
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-amber-100">
                        <p class="text-xs uppercase text-gray-400 mb-2">Kualitas Terjaga</p>
                        <h3 class="text-lg font-semibold text-gray-900">Material Pilihan</h3>
                        <p class="text-sm text-gray-600 mt-2">Produk kayu dengan finishing rapi dan daya tahan tinggi.</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-amber-100">
                        <p class="text-xs uppercase text-gray-400 mb-2">Pengiriman Aman</p>
                        <h3 class="text-lg font-semibold text-gray-900">Siap Kirim</h3>
                        <p class="text-sm text-gray-600 mt-2">Pengiriman terjadwal dengan tim berpengalaman.</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-amber-100">
                        <p class="text-xs uppercase text-gray-400 mb-2">Custom Order</p>
                        <h3 class="text-lg font-semibold text-gray-900">Sesuaikan Desain</h3>
                        <p class="text-sm text-gray-600 mt-2">Ukuran dan warna bisa disesuaikan.</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-amber-100">
                        <p class="text-xs uppercase text-gray-400 mb-2">Layanan</p>
                        <h3 class="text-lg font-semibold text-gray-900">Dukungan Cepat</h3>
                        <p class="text-sm text-gray-600 mt-2">Tim siap membantu setiap hari kerja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { onMounted, ref } from 'vue';
const headerText = ref('Furniture Berkualitas untuk Rumah Anda');
const subHeaderText = ref('Temukan koleksi furniture terbaik dengan desain modern dan elegan');
const headerTextList = [
    'Gazebo Jati Berkualitas untuk Taman Rumah Anda',
    'Rumah Kayu dan Gazebo Jati dengan Desain Elegan',
    'Joglo Kayu Jati Asli – Tampilkan Nuansa Tradisional Mewah',
    'Furniture Indoor Kayu Jati dengan Kualitas Premium',
    'Gazebo Taman Joglo Jati – Kuat, Indah, dan Tahan Lama',
    'Rumah Kayu Modern dari Material Jati Terbaik',
    'Gazebo Jati Ukiran Klasik untuk Halaman Rumah',
    'Bangunan Joglo Jati Asli – Konstruksi Kokoh dan Artistik',
    'Furniture Kayu Jati Indoor Minimalis untuk Hunian Nyaman',
    'Custom Gazebo Jati Solid untuk Ruang Outdoor Anda',
];


const subHeaderTextList = [
    'Temukan gazebo jati terbaik untuk mempercantik taman rumah Anda.',
    'Bangun rumah kayu modern dan tradisional dengan material jati berkualitas.',
    'Rasakan keindahan arsitektur joglo jati asli untuk hunian mewah.',
    'Pilih furniture indoor dari kayu jati yang tahan lama dan berkelas.',
    'Gazebo joglo jati menawarkan estetika klasik dan kekuatan maksimal.',
    'Rumah kayu jati memberikan kesan alami, sejuk, dan ramah lingkungan.',
    'Gazebo taman dari kayu jati cocok untuk ruang santai dan dekorasi outdoor.',
    'Bangunan joglo jati menghadirkan nuansa budaya khas Jawa yang elegan.',
    'Furniture indoor dari jati memberikan kenyamanan dan daya tahan tinggi.',
    'Layanan custom gazebo jati untuk kebutuhan outdoor berkualitas premium.',
];


// text header sama sub ganti
onMounted(() => {
    setInterval(() => {
        headerText.value = headerTextList[Math.floor(Math.random() * headerTextList.length)];
        subHeaderText.value = subHeaderTextList[Math.floor(Math.random() * subHeaderTextList.length)];
    }, 4500);
});
</script>
