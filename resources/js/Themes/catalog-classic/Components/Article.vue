<template>
    <section class="py-12 bg-amber-50/40">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Katalog Pilihan</h2>
                <p class="text-sm text-gray-600">Tampilan klasik dengan fokus detail produk.</p>
            </div>

            <div v-if="hasItems" class="space-y-6">
                <div v-for="product in paginatedProducts" :key="product.id"
                    class="flex flex-col md:flex-row gap-6 bg-white border border-amber-100 rounded-xl p-4 md:p-6 shadow-sm hover:shadow-md transition cursor-pointer"
                    @click="router.visit(routeUrl('post', product.slug))">
                    <div class="w-full md:w-56 h-44 overflow-hidden rounded-lg bg-gray-100">
                        <img :src="imageUrl(product.image)" :alt="product.title"
                            class="w-full h-full object-cover transition duration-300 hover:scale-105" />
                    </div>

                    <div class="flex-1 space-y-3">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    <Link :href="routeUrl('post', product.slug)">{{ product.title }}</Link>
                                </h3>
                                <p class="text-sm text-gray-500">Kategori: {{ product.category?.name ?? 'Produk' }}</p>
                            </div>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                Rating {{ productRating(product) }}/5
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 line-clamp-2">
                            {{ product.excerpt ?? 'Deskripsi produk tersedia di halaman detail.' }}
                        </p>

                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase text-gray-400">Harga</p>
                                <p class="text-lg font-semibold text-gray-900" v-if="productPrice(product)">
                                    Rp {{ productPrice(product).toLocaleString('id-ID') }}
                                </p>
                                <p v-else class="text-sm text-gray-500">Hubungi Kami</p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="text-xs text-gray-500">Ulasan {{ product.comment_count ?? 0 }}</span>
                                <button @click="addToCart(product)"
                                    class="px-4 py-2 text-sm font-semibold rounded-lg border border-amber-600 text-amber-600 hover:bg-amber-600 hover:text-white transition">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="py-16 text-center text-gray-500">
                Belum ada produk yang tersedia.
            </div>

            <div v-if="totalPages > 1" class="mt-10 flex items-center justify-center gap-2">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" :class="[
                    'px-3 py-2 rounded-md text-sm transition',
                    currentPage === 1
                        ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    Sebelumnya
                </button>

                <button v-for="page in visiblePages" :key="page" @click="goToPage(page)" :class="[
                    'px-3 py-2 rounded-md text-sm transition',
                    currentPage === page
                        ? 'bg-amber-600 text-white'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    {{ page }}
                </button>

                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages" :class="[
                    'px-3 py-2 rounded-md text-sm transition',
                    currentPage === totalPages
                        ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    Berikutnya
                </button>
            </div>

            <div class="mt-4 text-center text-gray-500 text-xs">
                Menampilkan {{ startItem }} - {{ endItem }} dari {{ articles.length }} produk
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { imageUrl, parseMeta, routeUrl } from '../../../helpers';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    articles: {
        type: Array,
        default: () => []
    }
});

const currentPage = ref(1);
const itemsPerPage = ref(8); // Jumlah produk per halaman
const hasItems = computed(() => props.articles.length > 0);

watch(
    () => props.articles,
    () => {
        currentPage.value = 1;
    }
);

// Hitung total halaman
const totalPages = computed(() => {
    return Math.ceil(props.articles.length / itemsPerPage.value);
});

// Produk yang ditampilkan di halaman saat ini
const paginatedProducts = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.articles.slice(start, end);
});

// Halaman yang ditampilkan di pagination
const visiblePages = computed(() => {
    const pages = [];
    const maxVisible = 5; // Maksimal nomor halaman yang ditampilkan

    if (totalPages.value === 0) {
        return pages;
    }

    let startPage = Math.max(1, currentPage.value - Math.floor(maxVisible / 2));
    let endPage = Math.min(totalPages.value, startPage + maxVisible - 1);

    // Adjust jika di awal
    if (endPage - startPage < maxVisible - 1) {
        startPage = Math.max(1, endPage - maxVisible + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        pages.push(i);
    }

    return pages;
});

// Info item yang ditampilkan
const startItem = computed(() => {
    if (!hasItems.value) {
        return 0;
    }
    return (currentPage.value - 1) * itemsPerPage.value + 1;
});

const endItem = computed(() => {
    if (!hasItems.value) {
        return 0;
    }
    const end = currentPage.value * itemsPerPage.value;
    return end > props.articles.length ? props.articles.length : end;
});

// Fungsi pindah halaman
const goToPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;

    }
};

// Fungsi add to cart (emit ke parent atau handle di sini)
const addToCart = (product) => {
    alert(`${product.title} ditambahkan ke keranjang!`);
    // emit('add-to-cart', product);
};

const productRating = (product) => {
    return Number(parseMeta('rating', product.meta ?? [])) || 0;
};

const productPrice = (product) => {
    const price = parseMeta('price', product.meta ?? []);
    if (price === undefined || price === null || price === '') {
        return null;
    }
    const parsed = Number(price);
    return Number.isFinite(parsed) ? parsed : null;
};
</script>

<style scoped>
/* Custom styles if needed */
</style>
