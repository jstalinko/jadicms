<template>
    <AppLayout>
        <section class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Newsly</p>
                    <h2 class="text-2xl md:text-3xl font-semibold text-slate-900">
                        Berita singkat dan modern untuk pembaca cepat.
                    </h2>
                    <p class="text-slate-500 max-w-2xl">
                        Kurasi artikel terbaru dalam tampilan yang bersih dan ringan.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 rounded-full bg-slate-900 text-white text-sm">
                        Subscribe
                    </button>
                    <button class="px-4 py-2 rounded-full border border-slate-200 text-sm text-slate-600">
                        Contact
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
