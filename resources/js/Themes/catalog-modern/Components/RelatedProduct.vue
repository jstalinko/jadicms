<template>
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Produk Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div v-for="relatedProduct in products" :key="relatedProduct.id"
                    @click="router.visit(routeUrl('post', relatedProduct.slug))"
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                    <img :src="imageUrl(relatedProduct.image)" :alt="relatedProduct.title"
                        class="w-full h-48 object-cover" />
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">
                            <Link :href="routeUrl('post', relatedProduct.slug)"> {{ relatedProduct.title }}</Link>
                        </h3>
                        <span class="text-xl font-bold text-amber-600" v-if="parseMeta('price', relatedProduct.meta)">Rp
                            {{
                                parseMeta('price', relatedProduct.meta).toLocaleString('id-ID') }}</span>
                        <span v-else>Hubungi Kami</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
const prop = defineProps({
    products: Object
});
import { router, Link } from '@inertiajs/vue3';
import { imageUrl, parseMeta, routeUrl } from '../../../helpers';
</script>
