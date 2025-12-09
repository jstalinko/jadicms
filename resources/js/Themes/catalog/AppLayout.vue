<template>
    <AppHead />
    <div class="bg-gray-50 min-h-screen">
        <Navbar />
        <slot />

        <Footer />
    </div>
</template>
<script setup>
import AppHead from './AppHead.vue';
import Navbar from './Components/Navbar.vue';
import Footer from './Components/Footer.vue';
</script>
