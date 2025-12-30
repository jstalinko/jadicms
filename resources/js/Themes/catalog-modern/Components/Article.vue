<template>
    <section class="py-14">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-amber-600">Produk Terbaru</p>
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-900">Pilihan Produk Modern</h2>
                </div>
                <div class="hidden md:flex items-center gap-3 text-sm text-gray-500">
                    <span>Filter mudah, hasil cepat</span>
                    <span class="w-10 h-px bg-gray-300"></span>
                    <span>{{ articles.length }} item</span>
                </div>
            </div>

            <div v-if="hasItems" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="product in paginatedProducts" :key="product.id"
                    class="group border border-gray-200 rounded-2xl overflow-hidden bg-white hover:border-amber-500 hover:shadow-xl transition"
                    @click="router.visit(routeUrl('post', product.slug))">
                    <div class="relative">
                        <img :src="imageUrl(product.image)" :alt="product.title"
                            class="w-full h-64 object-cover transition duration-300 group-hover:scale-105" />
                        <span
                            class="absolute top-4 left-4 bg-black/70 text-white text-xs px-3 py-1 rounded-full">
                            {{ product.category?.name ?? 'Produk' }}
                        </span>
                    </div>

                    <div class="p-5 space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                <Link :href="routeUrl('post', product.slug)">{{ product.title }}</Link>
                            </h3>
                            <p class="text-sm text-gray-500">Review {{ product.comment_count ?? 0 }}</p>
                        </div>

                        <div class="flex items-center gap-2 text-sm">
                            <div class="flex text-amber-500">
                                <svg v-for="i in 5" :key="i" class="w-4 h-4"
                                    :class="i <= productRating(product) ? 'fill-current' : 'fill-gray-300'"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                            </div>
                            <span class="text-gray-600">{{ productRating(product) }}/5</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-900" v-if="productPrice(product)">
                                Rp {{ productPrice(product).toLocaleString('id-ID') }}
                            </span>
                            <span v-else class="text-sm text-gray-500">Harga sesuai permintaan</span>
                            <button @click="addToCart(product)"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-700">
                                <span>Tambah</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="py-16 text-center text-gray-500">
                Belum ada produk yang tersedia.
            </div>

            <div v-if="totalPages > 1" class="mt-12 flex items-center justify-center gap-2">
                <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" :class="[
                    'px-3 py-2 rounded-full text-sm transition',
                    currentPage === 1
                        ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    Prev
                </button>

                <button v-for="page in visiblePages" :key="page" @click="goToPage(page)" :class="[
                    'px-4 py-2 rounded-full text-sm transition',
                    currentPage === page
                        ? 'bg-amber-600 text-white'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    {{ page }}
                </button>

                <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages" :class="[
                    'px-3 py-2 rounded-full text-sm transition',
                    currentPage === totalPages
                        ? 'bg-gray-100 text-gray-400 cursor-not-allowed'
                        : 'bg-white text-gray-700 hover:bg-amber-100 border border-gray-200'
                ]">
                    Next
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
