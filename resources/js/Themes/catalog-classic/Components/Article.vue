<template>
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Products Grid -->
            <div v-if="hasItems" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div v-for="product in paginatedProducts" :key="product.id"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group cursor-pointer"
                    @click="router.visit(routeUrl('post', product.slug))">
                    <div class="relative overflow-hidden">
                        <img :src="imageUrl(product.image)" :alt="product.title"
                            class="w-full h-64 object-cover group-hover:scale-110 transition duration-300" />
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <Link :href="routeUrl('post', product.slug)">{{ product.title }}</Link>
                        </h3>

                        <div class="flex items-center mb-2">
                            <div class="flex text-amber-500">
                                <svg v-for="i in 5" :key="i" class="w-4 h-4"
                                    :class="i <= productRating(product) ? 'fill-current' : 'fill-gray-300'"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 ml-2">({{ product.comment_count ?? 0 }})</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-amber-600" v-if="productPrice(product)">
                                Rp {{ productPrice(product).toLocaleString('id-ID') }}
                            </span>
                            <span v-else>
                                Hubungi Kami
                            </span>
                            <button @click="addToCart(product)"
                                class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="totalPages > 1" class="mt-12 flex items-center justify-center space-x-2">
                <!-- Previous Button -->
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" :class="[
                    'px-4 py-2 rounded-lg font-medium transition',
                    currentPage === 1
                        ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-600 hover:text-white border border-gray-300'
                ]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Page Numbers -->
                <button v-for="page in visiblePages" :key="page" @click="goToPage(page)" :class="[
                    'px-4 py-2 rounded-lg font-medium transition',
                    currentPage === page
                        ? 'bg-amber-600 text-white'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-300'
                ]">
                    {{ page }}
                </button>

                <!-- Next Button -->
                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages" :class="[
                    'px-4 py-2 rounded-lg font-medium transition',
                    currentPage === totalPages
                        ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-600 hover:text-white border border-gray-300'
                ]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div v-else-if="!hasItems" class="py-16 text-center text-gray-500">
                Belum ada produk yang tersedia.
            </div>

            <!-- Pagination Info -->
            <div class="mt-4 text-center text-gray-600 text-sm">
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
