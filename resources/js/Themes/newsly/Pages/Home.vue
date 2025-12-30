<template>
    <AppLayout>
        <section class="bg-white border border-slate-200 rounded-3xl p-8 shadow-sm">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-slate-400 mb-3">Newsly Highlight</p>
                    <h2 class="text-3xl md:text-4xl font-semibold text-slate-900 mb-3">
                        Cerita terbaru, insight, dan update pilihan.
                    </h2>
                    <p class="text-slate-600 max-w-2xl">
                        Temukan artikel menarik dari berbagai kategori, disajikan dalam tampilan editorial modern.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button class="px-5 py-2 rounded-full bg-slate-900 text-white text-sm">
                        Langganan
                    </button>
                    <button class="px-5 py-2 rounded-full border border-slate-200 text-sm text-slate-600">
                        Kirim Tulisan
                    </button>
                </div>
            </div>
        </section>

        <section class="grid gap-6">
            <Article :articles="articles" :perPage="4" />
        </section>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import AppLayout from '../AppLayout.vue';
import Article from '../Components/Article.vue';
const prop = defineProps({ jdata: Object });
const articles = ref(prop.jdata?.posts ?? [])

</script>

<style scoped>
* {
    transition: all 0.3s ease;
}
</style>
