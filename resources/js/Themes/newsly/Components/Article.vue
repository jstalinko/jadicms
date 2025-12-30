<template>
    <section class="space-y-6">
        <div v-if="hasArticles" class="grid gap-6">
            <article v-for="article in paginatedArticles" :key="article.id"
                class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-6">
                    <div class="h-full">
                        <img :src="imageUrl(article.image)" :alt="article.title" class="w-full h-full object-cover" />
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                                {{ parseCategory(article.labels) }}
                            </span>
                            <span>{{ dateFormatHuman(article.created_at) }}</span>
                        </div>

                        <h2 class="text-2xl font-semibold text-slate-900">
                            <Link :href="routeUrl('post', article.slug)">{{ article.title }}</Link>
                        </h2>

                        <p class="text-slate-600 leading-relaxed">
                            {{ excerpt(article.excerpt) }}
                        </p>

                        <Link :href="routeUrl('post', article.slug)"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-900 hover:text-slate-700">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </Link>
                    </div>
                </div>
            </article>
        </div>
        <div v-else class="bg-white border border-slate-200 rounded-2xl p-8 text-center text-slate-500">
            Belum ada artikel yang tersedia.
        </div>

        <div v-if="totalPages > 1" class="flex justify-center items-center gap-2">
            <button @click="prevPage" :disabled="currentPage === 1"
                class="px-3 py-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed transition">
                Sebelumnya
            </button>

            <button v-for="page in totalPages" :key="page" @click="currentPage = page" :class="[
                'px-4 py-2 rounded-lg text-sm font-medium transition',
                currentPage === page
                    ? 'bg-slate-900 text-white'
                    : 'border border-slate-200 text-slate-600 hover:bg-slate-100'
            ]">
                {{ page }}
            </button>

            <button @click="nextPage" :disabled="currentPage === totalPages"
                class="px-3 py-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed transition">
                Berikutnya
            </button>
        </div>
    </section>
</template>
<script setup>
import { dateFormatHuman, excerpt, imageUrl, parseCategory, routeUrl } from '../../../helpers';
import { Link } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
const prop = defineProps({
    articles: {
        type: Array,
        default: () => []
    },
    perPage: {
        type: Number,
        default: 5
    }
});
const currentPage = ref(1);
const totalPages = computed(() => Math.ceil(prop.articles.length / prop.perPage))
const hasArticles = computed(() => prop.articles.length > 0);
const paginatedArticles = computed(() => {
    const start = (currentPage.value - 1) * prop.perPage
    return prop.articles.slice(start, start + prop.perPage)
})
watch(
    () => prop.articles,
    () => {
        currentPage.value = 1;
    }
);
const nextPage = () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
}
const prevPage = () => {
    if (currentPage.value > 1) {
        currentPage.value--
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
}
</script>
