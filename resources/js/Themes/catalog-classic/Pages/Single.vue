<template>
    <AppLayout>
        <Breadcumb :product="product" />

        <section class="py-12 bg-amber-50/50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-[0.95fr_1.05fr] gap-10">
                    <div class="space-y-4">
                        <div class="bg-white border border-amber-100 rounded-2xl overflow-hidden shadow-sm">
                            <img :src="imageUrl(selectedImage)" :alt="product.name"
                                class="w-full h-80 lg:h-[460px] object-cover" />
                        </div>
                        <div class="grid grid-cols-4 gap-3">
                            <button v-for="(image, index) in product.images" :key="index"
                                @click="selectedImage = image" :class="[
                                    'rounded-lg overflow-hidden border transition',
                                    selectedImage === image ? 'border-amber-600' : 'border-transparent hover:border-amber-300'
                                ]">
                                <img :src="imageUrl(image)" :alt="`${product.name} ${index + 1}`"
                                    class="w-full h-20 object-cover" />
                            </button>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white border border-amber-100 rounded-2xl p-7 shadow-sm">
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3">
                                {{ product.name }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-4">
                                <span class="font-semibold text-amber-700">{{ product.rating }}/5</span>
                                <span class="w-px h-4 bg-gray-200"></span>
                                <span>{{ product.reviews }} ulasan</span>
                                <span class="w-px h-4 bg-gray-200"></span>
                                <span>Kategori {{ product.category?.name ?? 'Produk' }}</span>
                            </div>

                            <div class="flex items-center gap-3 mb-6">
                                <span class="text-3xl font-bold text-amber-700">
                                    Rp {{ product.price?.toLocaleString('id-ID') }}
                                </span>
                                <span v-if="product.oldPrice" class="text-lg text-gray-400 line-through">
                                    Rp {{ product.oldPrice?.toLocaleString('id-ID') }}
                                </span>
                            </div>

                            <div class="text-gray-600 leading-relaxed">
                                <div v-html="product.description" class="prose max-w-none"></div>
                            </div>
                        </div>

                        <div class="bg-white border border-amber-100 rounded-2xl p-6 shadow-sm space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <span>Garansi</span>
                                <span class="font-semibold text-gray-900">12 Bulan</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span>Pengiriman</span>
                                <span class="font-semibold text-gray-900">Jadwal mingguan</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span>Custom</span>
                                <span class="font-semibold text-gray-900">Tersedia</span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                                <button @click="addToCart"
                                    class="flex-1 bg-amber-700 text-white py-3 rounded-lg font-semibold hover:bg-amber-800 transition">
                                    Tambah ke Keranjang
                                </button>
                                <button
                                    class="flex-1 border border-amber-700 text-amber-700 py-3 rounded-lg font-semibold hover:bg-amber-50 transition">
                                    Simpan Produk
                                </button>
                            </div>
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
