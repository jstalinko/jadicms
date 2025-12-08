<template>
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">F</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ setting.site_name }}</h1>
                </div>

                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-amber-600">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-amber-600">Katalog</a>
                    <a href="#" class="text-gray-700 hover:text-amber-600">Tentang</a>
                    <a href="#" class="text-gray-700 hover:text-amber-600">Hubungi</a>
                </nav>


            </div>
        </div>
    </header>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const $page = usePage();
const setting = ref($page.props.setting);
</script>