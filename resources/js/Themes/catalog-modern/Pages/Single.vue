<template>
    <AppLayout>
        <Breadcumb :product="product" />

        <section class="py-14 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-12">
                    <div class="space-y-6">
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                            <img :src="imageUrl(selectedImage)" :alt="product.name"
                                class="w-full h-96 lg:h-[520px] object-cover" />
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button v-for="(image, index) in product.images" :key="index"
                                @click="selectedImage = image" :class="[
                                    'rounded-xl overflow-hidden border-2 transition focus:outline-none',
                                    selectedImage === image ? 'border-amber-500' : 'border-transparent hover:border-amber-300'
                                ]">
                                <img :src="imageUrl(image)" :alt="`${product.name} ${index + 1}`"
                                    class="w-full h-20 object-cover" />
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-lg space-y-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.25em] text-amber-600 mb-2">Produk pilihan</p>
                            <h1 class="text-3xl lg:text-4xl font-semibold text-gray-900">
                                {{ product.name }}
                            </h1>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                            <span class="flex items-center gap-2">
                                <span class="text-amber-500 font-semibold">{{ product.rating }}/5</span>
                                <span>Rating</span>
                            </span>
                            <span class="w-px h-4 bg-gray-200"></span>
                            <span>{{ product.reviews }} ulasan</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-semibold text-gray-900">
                                Rp {{ product.price?.toLocaleString('id-ID') }}
                            </span>
                            <span v-if="product.oldPrice" class="text-lg text-gray-400 line-through">
                                Rp {{ product.oldPrice?.toLocaleString('id-ID') }}
                            </span>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Deskripsi Produk</h3>
                            <div class="text-gray-600 leading-relaxed">
                                <div v-html="product.description" class="prose max-w-none"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-500">
                            <div class="flex items-center justify-between border border-gray-100 rounded-xl px-4 py-3">
                                <span>Stok</span>
                                <span class="text-gray-900 font-semibold">Tersedia</span>
                            </div>
                            <div class="flex items-center justify-between border border-gray-100 rounded-xl px-4 py-3">
                                <span>Pengiriman</span>
                                <span class="text-gray-900 font-semibold">2-4 Hari</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button @click="addToCart"
                                class="flex-1 bg-gray-900 text-white py-3 rounded-full font-semibold hover:bg-gray-800 transition">
                                Tambah ke Keranjang
                            </button>
                            <button
                                class="flex-1 border border-amber-500 text-amber-600 py-3 rounded-full font-semibold hover:bg-amber-50 transition">
                                Simpan Favorit
                            </button>
                        </div>
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
import { imageUrl, parseMeta } from '../../../helpers';
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
const selectedImage = ref(prop.jdata?.post?.image ?? null);

const post = ref(prop.jdata?.post ?? {});
const toNumberOrNull = (value) => {
    if (value === undefined || value === null || value === '') {
        return null;
    }
    const parsed = Number(value);
    return Number.isFinite(parsed) ? parsed : null;
};
const featuredImages = computed(() => {
    const meta = post.value?.meta ?? [];
    const raw = parseMeta('featured_images', meta);
    if (!raw) {
        return [];
    }
    try {
        const parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
    } catch (error) {
        return [];
    }
});
const product = computed(() => {
    const p = post.value;
    const meta = p?.meta ?? [];
    const priceValue = parseMeta('price', meta);
    const ratingValue = parseMeta('rating', meta);
    const oldPriceValue = parseMeta('old_price', meta);
    return {

        id: p.id,
        name: p.title,
        category: p.category,
        price: toNumberOrNull(priceValue),
        oldPrice: toNumberOrNull(oldPriceValue),
        rating: toNumberOrNull(ratingValue) ?? 0,
        reviews: p.comment_count ?? 0,
        description: p.content,
        images: [
            p.image,
            ...featuredImages.value
        ].filter(Boolean),
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
