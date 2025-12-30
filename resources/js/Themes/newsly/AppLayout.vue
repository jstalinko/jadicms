<template>
    <AppHead />
    <div class="min-h-screen bg-slate-50 text-slate-900">
        <Navbar />
        <div class="container mx-auto px-4 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-8">
                <main class="space-y-8">
                    <HookRenderer place="content_before" />
                    <slot />
                    <HookRenderer place="content_after" />
                </main>
                <SideBar />
            </div>
        </div>
        <Footer />
    </div>
</template>
<script setup>
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
import AppHead from './AppHead.vue';
import SideBar from './Components/SideBar.vue';
import HookRenderer from './Components/HookRenderer.vue';
</script>
