<template>
    <section class="bg-gradient-to-r from-amber-50 to-orange-50 py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    {{ headerText }}
                </h2>
                <p class="text-gray-600 text-lg mb-8">
                    {{ subHeaderText }}
                </p>
                <button
                    class="bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-700 transition">
                    Lihat Koleksi
                </button>
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
    }, 3000);
});
</script>