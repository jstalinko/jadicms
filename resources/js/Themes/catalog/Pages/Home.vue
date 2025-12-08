<template>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <Navbar />

        <!-- Hero Section -->
        <HeroSection />


        <AboutSection />
        <!-- Categories -->
        <section class="py-8 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex overflow-x-auto space-x-4 pb-4">
                    <button v-for="category in categories" :key="category.id" @click="selectedCategory = category.id"
                        :class="[
                            'px-6 py-2 rounded-full font-medium whitespace-nowrap transition',
                            selectedCategory === category.id
                                ? 'bg-amber-600 text-white'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                        ]">
                        {{ category.name }}
                    </button>
                </div>
            </div>
        </section>
        <!-- Products Grid -->
        <Article :articles="filteredProducts" />

        <Testimonial />



        <Footer />
    </div>
</template>
<script setup>
import { ref, computed } from 'vue';
import Navbar from '../Components/Navbar.vue';
import HeroSection from '../Components/HeroSection.vue';
import Footer from '../Components/Footer.vue';
import Article from '../Components/Article.vue';
import AboutSection from '../Components/AboutSection.vue';
import Testimonial from '../Components/Testimonial.vue';
const selectedCategory = ref('all');
const cart = ref([]);

const categories = [
    { id: 'all', name: 'Semua' },
    { id: 'sofa', name: 'Sofa' },
    { id: 'chair', name: 'Kursi' },
    { id: 'table', name: 'Meja' },
    { id: 'bed', name: 'Tempat Tidur' },
    { id: 'storage', name: 'Penyimpanan' }
];

const products = [
    {
        id: 1,
        name: 'Sofa Modern Minimalis',
        category: 'sofa',
        price: 4500000,
        image: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=500&h=400&fit=crop',
        rating: 5,
        reviews: 124
    },
    {
        id: 2,
        name: 'Kursi Makan Kayu Jati',
        category: 'chair',
        price: 850000,
        image: 'https://images.unsplash.com/photo-1503602642458-232111445657?w=500&h=400&fit=crop',
        rating: 4,
        reviews: 89
    },
    {
        id: 3,
        name: 'Meja Kerja Industrial',
        category: 'table',
        price: 2100000,
        image: 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=500&h=400&fit=crop',
        rating: 5,
        reviews: 156
    },
    {
        id: 4,
        name: 'Tempat Tidur Minimalis',
        category: 'bed',
        price: 3800000,
        image: 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=500&h=400&fit=crop',
        rating: 5,
        reviews: 203
    },
    {
        id: 5,
        name: 'Lemari Pakaian 3 Pintu',
        category: 'storage',
        price: 3200000,
        image: 'https://images.unsplash.com/photo-1595428774223-ef52624120d2?w=500&h=400&fit=crop',
        rating: 4,
        reviews: 67
    },
    {
        id: 6,
        name: 'Kursi Sofa Single',
        category: 'chair',
        price: 1750000,
        image: 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=500&h=400&fit=crop',
        rating: 4,
        reviews: 98
    },
    {
        id: 7,
        name: 'Meja Makan Keluarga',
        category: 'table',
        price: 4200000,
        image: 'https://images.unsplash.com/photo-1595515106969-1ce29566ff1c?w=500&h=400&fit=crop',
        rating: 5,
        reviews: 142
    },
    {
        id: 8,
        name: 'Sofa L Shape Premium',
        category: 'sofa',
        price: 8500000,
        image: 'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=500&h=400&fit=crop',
        rating: 5,
        reviews: 187
    }
];

const filteredProducts = computed(() => {
    if (selectedCategory.value === 'all') {
        return products;
    }
    return products.filter(product => product.category === selectedCategory.value);
});

const addToCart = (product) => {
    cart.value.push(product);
    alert(`${product.name} ditambahkan ke keranjang!`);
};
</script>

<style scoped>
/* Custom styles if needed */
</style>