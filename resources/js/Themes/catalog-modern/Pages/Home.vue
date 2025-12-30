<template>
    <AppLayout>

        <HeroSection />
        <AboutSection />
        <section class="py-10 bg-gray-950">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-semibold text-white">Kategori Produk</h3>
                        <p class="text-sm text-gray-300">Pilih kategori untuk melihat produk terbaru.</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button @click="selectedCategory = 'all'" :class="[
                            'px-5 py-2 rounded-full text-sm font-medium transition',
                            selectedCategory === 'all'
                                ? 'bg-amber-500 text-gray-900'
                                : 'bg-white/10 text-white hover:bg-white/20'
                        ]">
                            Semua
                        </button>
                        <button v-for="category in categories" :key="category.id" @click="selectedCategory = category.slug"
                            :class="[
                                'px-5 py-2 rounded-full text-sm font-medium transition',
                                selectedCategory === category.slug
                                    ? 'bg-amber-500 text-gray-900'
                                    : 'bg-white/10 text-white hover:bg-white/20'
                            ]">
                            {{ category.name }}
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <Article :articles="filteredProducts" />

        <Testimonial />

    </AppLayout>
</template>
<script setup>
import { ref, computed } from 'vue';
import AppLayout from '../AppLayout.vue';
import HeroSection from '../Components/HeroSection.vue';
import Article from '../Components/Article.vue';
import AboutSection from '../Components/AboutSection.vue';
import Testimonial from '../Components/Testimonial.vue';
import { usePage } from '@inertiajs/vue3';
const prop = defineProps({ jdata: Object });
const $page = usePage();
const selectedCategory = ref('all');
const categories = ref($page.props.sharedData?.categories ?? []);
const productRaw = ref(prop.jdata?.posts ?? []);
const products = computed(() => {
    return (productRaw.value ?? []).filter(product => product.type === 'product');
});
const filteredProducts = computed(() => {
    if (selectedCategory.value === 'all') {
        return products.value;
    }
    return products.value.filter(product => product.category_slug === selectedCategory.value);
});


</script>

<style scoped>
/* Custom styles if needed */
</style>
