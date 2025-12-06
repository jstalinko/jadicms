<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <Navbar />
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- content -->
                <div class="lg:col-span-2 space-y-8">
                    <slot />
                </div>
                <aside class="space-y-8">

                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Pencarian
                        </h3>
                        <div class="flex">
                            <input v-model="searchQuery" type="text" placeholder="Cari artikel..."
                                class="flex-1 px-4 py-3 bg-white/5 border border-white/20 rounded-l-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 backdrop-blur-sm" />
                            <button
                                class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-r-xl hover:from-purple-600 hover:to-pink-600 transition duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Categories -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            Kategori
                        </h3>
                        <ul class="space-y-3">
                            <li v-for="category in categories" :key="category.id"
                                class="cursor-pointer hover:bg-white/10 p-3 rounded-lg transition duration-300 flex justify-between text-gray-300 hover:text-white">
                                <span>{{ category.name }}</span>
                                <span class="backdrop-blur-md bg-purple-500/50 px-3 py-1 rounded-full text-sm">
                                    {{ category.count }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Archive -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            Arsip
                        </h3>
                        <ul class="space-y-3">
                            <li v-for="archive in archives" :key="archive.month"
                                class="cursor-pointer hover:bg-white/10 p-3 rounded-lg transition duration-300 flex justify-between text-gray-300 hover:text-white">
                                <span>{{ archive.month }}</span>
                                <span class="backdrop-blur-md bg-purple-500/50 px-3 py-1 rounded-full text-sm">
                                    {{ archive.count }}
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Latest Posts -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Postingan Terbaru
                        </h3>
                        <ul class="space-y-4">
                            <li v-for="post in latestPosts" :key="post.id"
                                class="cursor-pointer hover:bg-white/10 p-3 rounded-lg transition duration-300 group">
                                <h4
                                    class="font-medium text-white group-hover:text-purple-300 mb-2 transition duration-300">
                                    {{ post.title }}
                                </h4>
                                <p class="text-sm text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ post.date }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>


        <Footer />
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';

const searchQuery = ref('');
const archives = ref([
    { month: 'Desember 2024', count: 12 },
    { month: 'November 2024', count: 25 },
    { month: 'Oktober 2024', count: 18 },
    { month: 'September 2024', count: 22 },
    { month: 'Agustus 2024', count: 15 }
])

const latestPosts = ref([
    { id: 1, title: 'Tips Produktivitas', date: '2 Des 2024' },
    { id: 2, title: 'Resep Masakan Sehat', date: '2 Des 2024' },
    { id: 3, title: 'Review Gadget', date: '1 Des 2024' },
    { id: 4, title: 'Cara Memulai Investasi', date: '1 Des 2024' },
    { id: 5, title: 'Panduan Vue.js', date: '30 Nov 2024' }
]);
const categories = ref([
    { id: 1, name: 'Teknologi', count: 12 },
    { id: 2, name: 'Gaya Hidup', count: 25 },
    { id: 3, name: 'Kesehatan', count: 18 },
    { id: 4, name: 'Investasi', count: 22 },
    { id: 5, name: 'Teknologi', count: 15 }
]);
</script>