<template>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">FurniShop</h3>
                    <p class="text-gray-400">Furniture berkualitas untuk rumah impian Anda</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li v-for="category in data.categories" :key="category.id">
                            <Link :href="routeUrl('category', category.slug)" class="hover:text-white">{{ category.name
                                }}</Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Halaman</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li v-for="page in data.pages" :key="page.id">
                            <Link :href="routeUrl('page', page.slug)" class="hover:text-white">{{ page.title }}</Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@furnishop.com</li>
                        <li>Phone: +62 812-3456-7890</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ new Date().getFullYear() }} {{ setting.site_name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { routeUrl } from '../../../helpers';
const $page = usePage();
const setting = ref($page.props.setting);
const data = ref($page.props.sharedData);
</script>