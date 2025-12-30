<template>
    <section class="bg-gray-950 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-12 items-center">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-amber-300 mb-4">Catalog Modern</p>
                    <h2 class="text-4xl md:text-5xl font-semibold leading-tight mb-5">
                        {{ headerText }}
                    </h2>
                    <p class="text-gray-300 text-lg mb-8">
                        {{ subHeaderText }}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button
                            class="bg-amber-500 text-gray-900 px-7 py-3 rounded-full font-semibold hover:bg-amber-400 transition">
                            Lihat Koleksi
                        </button>
                        <button
                            class="border border-white/40 px-7 py-3 rounded-full font-semibold hover:bg-white/10 transition">
                            Konsultasi Gratis
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -top-8 -left-8 w-28 h-28 bg-amber-500/30 rounded-full blur-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80"
                        alt="Furniture Modern" class="rounded-3xl shadow-2xl border border-white/10" />
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
    }, 5000);
});
</script>
