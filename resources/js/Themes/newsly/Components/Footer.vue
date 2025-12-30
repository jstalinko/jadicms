<template>
    <footer class="border-t border-slate-200 bg-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">{{ websiteName }}</h3>
                    <p class="text-sm text-slate-500">{{ slogan }}</p>
                </div>
                <div class="flex flex-wrap gap-3 text-sm text-slate-500">
                    <span>Editorial</span>
                    <span class="text-slate-300">•</span>
                    <span>Newsletter</span>
                    <span class="text-slate-300">•</span>
                    <span>About</span>
                </div>
                <div class="text-sm text-slate-400">
                    © {{ new Date().getFullYear() }} Newsly
                </div>
            </div>
        </div>
    </footer>
    <HookRenderer place="footer" />
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import HookRenderer from './HookRenderer.vue';

const $page = usePage();
const websiteName = computed(() => $page.props.setting?.site_name ?? 'JadiCMS');
const slogan = computed(() => $page.props.setting?.tagline ?? 'News & Stories');
</script>
