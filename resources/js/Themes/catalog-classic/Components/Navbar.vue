<template>
    <header class="bg-amber-700 text-white">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-md flex items-center justify-center">
                        <span class="text-white font-bold text-lg">JC</span>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-amber-100">Catalog Classic</p>
                        <h1 class="text-xl font-bold">{{ siteName }}</h1>
                    </div>
                </div>

                <nav class="flex flex-wrap gap-4 text-sm">
                    <Link :href="menu.url" class="hover:text-amber-100" v-for="menu in menus" :key="menu.id">
                    {{ menu.label }}
                    </Link>
                </nav>

                <div class="flex items-center gap-3 text-sm">
                    <span class="text-amber-100">Support 24/7</span>
                    <span class="w-px h-4 bg-amber-200/60"></span>
                    <span>+62 812 3456</span>
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
