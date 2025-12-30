<template>
    <header class="border-b border-slate-200 bg-white">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center">
                        <span class="text-lg font-semibold">N</span>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Newsly</p>
                        <h1 class="text-2xl font-bold text-slate-900">{{ websiteName }}</h1>
                        <p class="text-sm text-slate-500">{{ slogan }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button class="hidden md:inline-flex px-4 py-2 rounded-full bg-slate-900 text-white text-sm">
                        Langganan
                    </button>
                    <button class="inline-flex px-4 py-2 rounded-full border border-slate-200 text-sm text-slate-600">
                        Kontak
                    </button>
                </div>
            </div>
        </div>
    </header>

    <nav class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-slate-200">
        <div class="container mx-auto px-4">
            <ul class="flex flex-wrap gap-6 py-4 text-sm font-medium">
                <template v-for="menu in menus" :key="menu.id">
                    <li v-if="menu.is_parent" class="relative group">
                        <div class="cursor-pointer text-slate-700 hover:text-slate-900 flex items-center">
                            {{ menu.label }}
                            <svg class="w-4 h-4 ml-1 transition-transform duration-300 group-hover:rotate-180"
                                fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <ul
                            class="absolute left-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-slate-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                            <li v-for="child in menus.filter(c => c.parent_id === menu.id)" :key="child.id">
                                <div @click="router.visit(child.url)"
                                    class="px-4 py-2 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition cursor-pointer">
                                    {{ child.label }}
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li v-else-if="menu.parent_id === null" class="text-slate-700 hover:text-slate-900">
                        <Link :href="menu.url">{{ menu.label }}</Link>
                    </li>
                </template>
            </ul>
        </div>
    </nav>
</template>

<script setup>
import { usePage, Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const $page = usePage();
const websiteName = computed(() => $page.props.setting?.site_name ?? 'JadiCMS');
const slogan = computed(() => $page.props.setting?.tagline ?? 'News & Stories');
const menus = computed(() => $page.props.setting?.menus ?? []);
</script>
