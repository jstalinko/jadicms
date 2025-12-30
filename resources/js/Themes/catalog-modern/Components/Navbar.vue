<template>
    <header class="bg-white/90 backdrop-blur sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">JM</span>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-gray-400">JadiCMS</p>
                        <h1 class="text-lg md:text-xl font-semibold text-gray-900">{{ siteName }}</h1>
                    </div>
                </div>

                <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                    <Link :href="menu.url" class="text-gray-600 hover:text-amber-600" v-for="menu in menus"
                        :key="menu.id">
                    {{ menu.label }}
                    </Link>
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    <button class="px-4 py-2 text-sm rounded-full bg-gray-900 text-white hover:bg-gray-800 transition">
                        Masuk
                    </button>
                    <button
                        class="px-4 py-2 text-sm rounded-full border border-amber-500 text-amber-600 hover:bg-amber-50 transition">
                        Hubungi
                    </button>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const $page = usePage();
const setting = computed(() => $page.props.setting ?? {});
const menus = computed(() => setting.value.menus ?? []);
const siteName = computed(() => setting.value.site_name ?? 'JadiCMS');
</script>
