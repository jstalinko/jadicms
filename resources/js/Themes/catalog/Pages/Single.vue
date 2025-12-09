<template>
    <AppLayout>
        <Breadcumb :product="product" />

        <!-- Product Detail Section -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Product Images -->
                    <div>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                            <img :src="imageUrl(selectedImage)" :alt="product.name"
                                class="w-full h-96 lg:h-[500px] object-cover" />
                        </div>
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="(image, index) in product.images" :key="index" @click="selectedImage = image"
                                :class="[
                                    'bg-white rounded-lg overflow-hidden cursor-pointer border-2 transition',
                                    selectedImage === image ? 'border-amber-600' : 'border-gray-200 hover:border-amber-400'
                                ]">
                                <img :src="imageUrl(image)" :alt="`${product.name} ${index + 1}`"
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
                                Rp {{ product.price?.toLocaleString('id-ID') }}
                            </span>
                            <span v-if="product.oldPrice" class="text-xl text-gray-400 line-through ml-3">
                                Rp {{ product.oldPrice?.toLocaleString('id-ID') }}
                            </span>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <div class="text-gray-600 leading-relaxed">
                                <div v-html="product.description" class="prose md:prose-xl"></div>
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
                        <!-- <div class="mt-8 grid grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-white rounded-lg shadow">
                                <svg class="w-8 h-8 mx-auto mb-2 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                <p class="text-sm text-gray-600"></p>
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
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <ReviewSection :reviews="reviews" />

        <!-- Related Products -->
        <RelatedProduct :products="relatedProducts" />

    </AppLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { imageUrl, parseMetas } from '../../../helpers';
import Breadcumb from '../Components/Breadcumb.vue';
import AppLayout from '../AppLayout.vue';
import ReviewSection from '../Components/ReviewSection.vue';
import RelatedProduct from '../Components/RelatedProduct.vue';
const cart = ref([]);
const quantity = ref(1);
const selectedColor = ref('Coklat');
const prop = defineProps({
    jdata: Object
});
const selectedImage = ref(prop.jdata.post.image);

const post = ref(prop.jdata.post);
const product = computed(() => {
    const p = post.value;

    return {

        id: p.id,
        name: p.title,
        category: p.category,
        price: 10000,
        oldPrice: 100000,
        rating: 5,
        reviews: p.comment_count,
        description: p.content,
        images: [
            p.image,
            ...JSON.parse(parseMetas('featured_images', p.meta))
        ],
        created_at: p.created_at,
        updated_at: p.updated_at

    };
});



const reviews = ref(prop.jdata.comments);

const relatedProducts = computed(() => {
    let related = prop.jdata.relatedPosts;
    return related.filter(product => product.type === 'product');
})



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