<template>

    <Head>
        <base :href="setting.base_url" />
        <title>
            {{ meta?.title ?? defaultTitle }}
        </title>
        <meta name="description" :content="meta?.description" />
        <meta name="keywords" :content="meta?.description" />
        <meta name="author" :content="setting.site_name" />
        <!-- openGraph -->
        <meta property="og:title" :content="meta?.title ?? defaultTitle" />
        <meta property="og:description" :content="meta?.description" />
        <meta property="og:type" :content="meta?.type ?? 'website'" />
        <meta property="og:url" :content="meta?.url" />
        <meta property="og:image" :content="meta?.image ?? defaultImage" />
        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="meta?.title ?? defaultTitle" />
        <meta name="twitter:description" :content="meta?.description" />
        <meta name="twitter:image" :content="meta?.image ?? defaultImage" />

    </Head>
</template>
<script setup>
import { usePage, Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const $page = usePage();
const meta = computed(() => $page.props.j_inertia_meta ?? {});
const setting = computed(() => $page.props.setting ?? {});
const defaultTitle = computed(() => {
    const siteName = setting.value.site_name ?? 'JadiCMS';
    const tagline = setting.value.tagline ?? '';
    return tagline ? `${siteName} - ${tagline}` : siteName;
});
const defaultImage = computed(() => {
    if (!setting.value.base_url || !setting.value.icon) {
        return '';
    }
    return `${setting.value.base_url}/storage${setting.value.icon}`;
});
</script>
