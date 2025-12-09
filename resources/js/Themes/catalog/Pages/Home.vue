<template>
    <AppLayout>

        <HeroSection />
        <AboutSection />
        <section class="py-8 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex overflow-x-auto space-x-4 pb-4">
                    <button @click="selectedCategory = 'all'"
                        :class="[
                            'px-6 py-2 rounded-full font-medium whitespace-nowrap transition',
                            selectedCategory === 'all' ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200']">Semua</button>
                    <button v-for="category in categories" :key="category.id" @click="selectedCategory = category.slug"
                        :class="[
                            'px-6 py-2 rounded-full font-medium whitespace-nowrap transition',
                            selectedCategory === category.slug
                                ? 'bg-amber-600 text-white'
                                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                        ]">
                        {{ category.name }}
                    </button>
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
import Footer from '../Components/Footer.vue';
import Article from '../Components/Article.vue';
import AboutSection from '../Components/AboutSection.vue';
import Testimonial from '../Components/Testimonial.vue';
import { usePage } from '@inertiajs/vue3';
const prop = defineProps({ jdata: Object });
const $page = usePage();
const selectedCategory = ref('all');
const categories = ref($page.props.sharedData.categories);
const productRaw = ref(prop.jdata.posts);
const products = computed(() => {
    return productRaw.value.filter(product => product.type === 'product');
})
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