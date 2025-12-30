<template>
    <AppLayout>

        <HeroSection />
        <AboutSection />
        <section class="py-8 bg-amber-50">
            <div class="container mx-auto px-4">
                <div class="bg-white border border-amber-100 rounded-2xl p-5 shadow-sm">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Jelajahi Kategori</h3>
                            <p class="text-sm text-gray-500">Gunakan filter klasik untuk mempermudah pencarian.</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button @click="selectedCategory = 'all'" :class="[
                                'px-4 py-2 rounded-lg text-sm font-medium transition',
                                selectedCategory === 'all'
                                    ? 'bg-amber-700 text-white'
                                    : 'bg-amber-50 text-amber-700 hover:bg-amber-100'
                            ]">
                                Semua
                            </button>
                            <button v-for="category in categories" :key="category.id" @click="selectedCategory = category.slug"
                                :class="[
                                    'px-4 py-2 rounded-lg text-sm font-medium transition',
                                    selectedCategory === category.slug
                                        ? 'bg-amber-700 text-white'
                                        : 'bg-amber-50 text-amber-700 hover:bg-amber-100'
                                ]">
                                {{ category.name }}
                            </button>
                        </div>
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
