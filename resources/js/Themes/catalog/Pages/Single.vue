<template>
    <div class="bg-gray-50 min-h-screen">
        <!-- Header/Navbar -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">F</span>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-800">FurniShop</h1>
                    </div>

                    <nav class="hidden md:flex space-x-8">
                        <a href="#" class="text-gray-700 hover:text-amber-600">Home</a>
                        <a href="#" class="text-gray-700 hover:text-amber-600">Catalog</a>
                        <a href="#" class="text-gray-700 hover:text-amber-600">About</a>
                        <a href="#" class="text-gray-700 hover:text-amber-600">Contact</a>
                    </nav>

                    <div class="flex items-center space-x-4">
                        <button class="relative text-gray-700 hover:text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span v-if="cart.length > 0"
                                class="absolute -top-2 -right-2 bg-amber-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ cart.length }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Breadcrumb -->
        <div class="bg-white border-b">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center space-x-2 text-sm">
                    <a href="#" class="text-gray-600 hover:text-amber-600">Home</a>
                    <span class="text-gray-400">/</span>
                    <a href="#" class="text-gray-600 hover:text-amber-600">{{ product.category }}</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-800 font-medium">{{ product.name }}</span>
                </div>
            </div>
        </div>

        <!-- Product Detail Section -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Product Images -->
                    <div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                            <img :src="selectedImage" :alt="product.name"
                                class="w-full h-96 lg:h-[500px] object-cover" />
                        </div>
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="(image, index) in product.images" :key="index" @click="selectedImage = image"
                                :class="[
                                    'bg-white rounded-lg overflow-hidden cursor-pointer border-2 transition',
                                    selectedImage === image ? 'border-amber-600' : 'border-gray-200 hover:border-amber-400'
                                ]">
                                <img :src="image" :alt="`${product.name} ${index + 1}`"
                                    class="w-full h-24 object-cover" />
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">
                            {{ product.name }}
                        </h1>

                        <div class="flex items-center mb-4">
                            <div class="flex text-amber-500 mr-2">
                                <svg v-for="i in 5" :key="i" class="w-5 h-5"
                                    :class="i <= product.rating ? 'fill-current' : 'fill-gray-300'" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                            </div>
                            <span class="text-gray-600">{{ product.rating }} / 5</span>
                            <span class="text-gray-400 mx-2">|</span>
                            <span class="text-gray-600">{{ product.reviews }} reviews</span>
                        </div>

                        <div class="mb-6">
                            <span class="text-4xl font-bold text-amber-600">
                                Rp {{ product.price.toLocaleString('id-ID') }}
                            </span>
                            <span v-if="product.oldPrice" class="text-xl text-gray-400 line-through ml-3">
                                Rp {{ product.oldPrice.toLocaleString('id-ID') }}
                            </span>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ product.description }}
                            </p>
                        </div>

                        <!-- Color Selection -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Warna</h3>
                            <div class="flex space-x-3">
                                <button v-for="color in product.colors" :key="color.name"
                                    @click="selectedColor = color.name" :class="[
                                        'w-12 h-12 rounded-full border-2 transition',
                                        selectedColor === color.name ? 'border-amber-600 ring-2 ring-amber-200' : 'border-gray-300'
                                    ]" :style="{ backgroundColor: color.hex }" :title="color.name"></button>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Jumlah</h3>
                            <div class="flex items-center space-x-4">
                                <button @click="decreaseQuantity"
                                    class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4" />
                                    </svg>
                                </button>
                                <span class="text-xl font-semibold w-12 text-center">{{ quantity }}</span>
                                <button @click="increaseQuantity"
                                    class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Specifications -->
                        <div class="mb-6 bg-gray-100 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Spesifikasi</h3>
                            <div class="space-y-2">
                                <div v-for="(value, key) in product.specifications" :key="key"
                                    class="flex justify-between">
                                    <span class="text-gray-600">{{ key }}:</span>
                                    <span class="text-gray-800 font-medium">{{ value }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4">
                            <button @click="addToCart"
                                class="flex-1 bg-amber-600 text-white py-4 rounded-lg font-semibold hover:bg-amber-700 transition flex items-center justify-center space-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>Tambah ke Keranjang</span>
                            </button>
                            <button
                                class="bg-white border-2 border-amber-600 text-amber-600 py-4 px-6 rounded-lg font-semibold hover:bg-amber-50 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-white rounded-lg shadow">
                                <svg class="w-8 h-8 mx-auto mb-2 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                <p class="text-sm text-gray-600">Gratis Ongkir</p>
                            </div>
                            <div class="text-center p-4 bg-white rounded-lg shadow">
                                <svg class="w-8 h-8 mx-auto mb-2 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <p class="text-sm text-gray-600">Garansi 1 Tahun</p>
                            </div>
                            <div class="text-center p-4 bg-white rounded-lg shadow">
                                <svg class="w-8 h-8 mx-auto mb-2 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                <p class="text-sm text-gray-600">Pembayaran Aman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Review Pelanggan</h2>
                <div class="space-y-6">
                    <div v-for="review in reviews" :key="review.id" class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ review.name.charAt(0) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold text-gray-800">{{ review.name }}</h4>
                                    <span class="text-sm text-gray-500">{{ review.date }}</span>
                                </div>
                                <div class="flex text-amber-500 mb-2">
                                    <svg v-for="i in 5" :key="i" class="w-4 h-4"
                                        :class="i <= review.rating ? 'fill-current' : 'fill-gray-300'"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-600">{{ review.comment }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Produk Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div v-for="relatedProduct in relatedProducts" :key="relatedProduct.id"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <img :src="relatedProduct.image" :alt="relatedProduct.name" class="w-full h-48 object-cover" />
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ relatedProduct.name }}</h3>
                            <span class="text-xl font-bold text-amber-600">Rp {{
                                relatedProduct.price.toLocaleString('id-ID') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const cart = ref([]);
const quantity = ref(1);
const selectedColor = ref('Coklat');
const selectedImage = ref('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=600&fit=crop');

const product = ref({
    id: 1,
    name: 'Sofa Modern Minimalis 3 Seater',
    category: 'Sofa',
    price: 4500000,
    oldPrice: 5500000,
    rating: 5,
    reviews: 124,
    description: 'Sofa modern minimalis dengan desain elegan dan nyaman. Terbuat dari bahan berkualitas tinggi dengan rangka kayu solid yang kuat dan tahan lama. Cocok untuk ruang tamu modern Anda.',
    images: [
        'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=600&fit=crop',
        'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=800&h=600&fit=crop',
        'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=800&h=600&fit=crop',
        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=600&fit=crop'
    ],
    colors: [
        { name: 'Coklat', hex: '#8B4513' },
        { name: 'Abu-abu', hex: '#808080' },
        { name: 'Biru Navy', hex: '#000080' },
        { name: 'Hijau Tua', hex: '#2F4F4F' }
    ],
    specifications: {
        'Material': 'Fabric Premium + Kayu Jati',
        'Dimensi': '200 x 90 x 85 cm',
        'Berat': '45 kg',
        'Kapasitas': '3 Orang',
        'Garansi': '1 Tahun'
    }
});

const reviews = ref([
    {
        id: 1,
        name: 'Budi Santoso',
        rating: 5,
        date: '2 hari yang lalu',
        comment: 'Kualitas sangat bagus! Bahannya premium dan nyaman banget. Pengiriman juga cepat. Highly recommended!'
    },
    {
        id: 2,
        name: 'Siti Aminah',
        rating: 5,
        date: '1 minggu yang lalu',
        comment: 'Sofa impian akhirnya terwujud. Desainnya modern dan pas banget di ruang tamu saya. Pelayanan juga ramah.'
    },
    {
        id: 3,
        name: 'Rudi Hermawan',
        rating: 4,
        date: '2 minggu yang lalu',
        comment: 'Bagus sih, tapi warnanya agak sedikit berbeda dari foto. Overall masih oke lah untuk harga segini.'
    }
]);

const relatedProducts = ref([
    {
        id: 2,
        name: 'Sofa L Shape Premium',
        price: 8500000,
        image: 'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=500&h=400&fit=crop'
    },
    {
        id: 3,
        name: 'Kursi Sofa Single',
        price: 1750000,
        image: 'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=500&h=400&fit=crop'
    },
    {
        id: 4,
        name: 'Meja Kopi Minimalis',
        price: 1200000,
        image: 'https://images.unsplash.com/photo-1532372576444-dda954194ad0?w=500&h=400&fit=crop'
    },
    {
        id: 5,
        name: 'Cushion Set Premium',
        price: 350000,
        image: 'https://images.unsplash.com/photo-1584100936595-c0654b55a2e2?w=500&h=400&fit=crop'
    }
]);

const increaseQuantity = () => {
    quantity.value++;
};

const decreaseQuantity = () => {
    if (quantity.value > 1) {
        quantity.value--;
    }
};

const addToCart = () => {
    cart.value.push({
        ...product.value,
        quantity: quantity.value,
        color: selectedColor.value
    });
    alert(`${quantity.value}x ${product.value.name} (${selectedColor.value}) ditambahkan ke keranjang!`);
};
</script>

<style scoped>
/* Custom styles if needed */
</style>