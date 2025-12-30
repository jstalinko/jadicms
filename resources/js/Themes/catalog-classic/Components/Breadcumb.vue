<template>
    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center space-x-2 text-sm">
                <a href="#" class="text-gray-600 hover:text-amber-600">Home</a>
                <span class="text-gray-400">/</span>
                <a href="#" class="text-gray-600 hover:text-amber-600">{{ product.category }}</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-800 font-medium">{{ product.name }}</span>
            </div>
        </div>
    </div>
</template>
<script setup>
const prop = defineProps({
    product: Object
})

</script>