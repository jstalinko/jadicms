<template>
    <!-- Footer -->
    <footer class="backdrop-blur-xl bg-white/5 border-t border-white/20 py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-2 text-white font-medium">&copy; 2024 {{ websiteName }}. All rights reserved.</p>
            <p class="text-purple-300">{{ slogan }}</p>
        </div>
    </footer>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
const $page = usePage();
const [websiteName, slogan] = [$page.props.value.setting.site_name, $page.props.value.setting.tagline]
</script>