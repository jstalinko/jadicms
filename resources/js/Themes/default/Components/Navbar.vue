<template>
    <!-- Header -->
    <header class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600/30 to-pink-600/30 backdrop-blur-xl"></div>
        <div class="relative container mx-auto px-4 py-12 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-3 tracking-tight">
                {{ websiteName }}
            </h1>
            <p class="text-xl text-purple-200 font-light">{{ slogan }}</p>
        </div>
    </header>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/10 border-b border-white/20">
        <div class="container mx-auto px-4">
            <ul class="flex space-x-8 py-4 overflow-x-auto">
                <li v-for="menu in menus" :key="menu"
                    class="cursor-pointer text-white hover:text-purple-300 transition duration-300 font-medium whitespace-nowrap">
                    {{ menu }}
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
import { ref } from 'vue';

const prop = defineProps({
    websiteName: String,
    slogan: String,
    menus: Array,
});
</script>