<template>
    <aside class="space-y-6">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-4 text-slate-900">Cari Artikel</h3>
            <div class="flex">
                <input v-model="searchQuery" type="text" placeholder="Cari artikel..."
                    class="flex-1 px-4 py-3 border border-slate-200 rounded-l-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300"
                    @keydown.enter="searchPost" />
                <button
                    class="bg-slate-900 text-white px-6 py-3 rounded-r-xl hover:bg-slate-800 transition duration-300"
                    @click="searchPost">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-4 text-slate-900">Kategori</h3>
            <ul class="space-y-2 text-sm">
                <li v-for="category in categories" :key="category.id"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-100 transition">
                    <Link :href="routeUrl('category', category.slug)" class="text-slate-700">
                        {{ category.name }}
                    </Link>
                    <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-full text-xs">
                        {{ category.post_count }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-4 text-slate-900">Arsip</h3>
            <ul class="space-y-2 text-sm">
                <li v-for="archive in archives" :key="archive.month"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-slate-100 transition">
                    <Link :href="routeUrl('archive', archive.month)" class="text-slate-700">
                        {{ archive.monthHuman }}
                    </Link>
                    <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-full text-xs">
                        {{ archive.count }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold mb-4 text-slate-900">Terbaru</h3>
            <ul class="space-y-3 text-sm">
                <li v-for="post in latestPosts" :key="post.id" class="border-b border-slate-100 pb-3 last:border-0">
                    <h4 class="font-medium text-slate-900">
                        <Link :href="routeUrl('post', post.slug)">{{ breakWord(post.title, 60) }}</Link>
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">{{ timeAgo(post.created_at) }}</p>
                </li>
            </ul>
        </div>
    </aside>
</template>
<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { breakWord, formatDate, routeUrl, timeAgo } from '../../../helpers';
const $page = usePage();
const searchQuery = ref('');
const archives = ref($page.props.sharedData?.archives ?? []);
const latestPosts = ref($page.props.sharedData?.latest_posts ?? []);
const categories = ref($page.props.sharedData?.categories ?? []);

const searchPost = () => {
    if (searchQuery.value) {
        window.location.href = routeUrl('search', searchQuery.value);
    }
}
</script>
