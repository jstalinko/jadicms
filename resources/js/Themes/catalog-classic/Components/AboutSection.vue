<template>
    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <span class="text-amber-600 font-semibold text-sm uppercase tracking-wide">Tentang Kami</span>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mt-4 mb-6">
                        Furniture Berkualitas untuk Rumah Impian Anda
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        FurniShop adalah perusahaan furniture terkemuka di Indonesia yang telah berpengalaman lebih dari
                        15 tahun dalam menyediakan furniture berkualitas tinggi dengan desain modern dan elegan.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Kami berkomitmen untuk memberikan produk terbaik dengan harga yang terjangkau, serta pelayanan
                        yang memuaskan untuk setiap pelanggan kami.
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-600 mb-2">15+</div>
                            <div class="text-gray-600 text-sm">Tahun Pengalaman</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-600 mb-2">10K+</div>
                            <div class="text-gray-600 text-sm">Pelanggan Puas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-amber-600 mb-2">500+</div>
                            <div class="text-gray-600 text-sm">Produk Tersedia</div>
                        </div>
                    </div>

                    <button
                        class="bg-amber-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-amber-700 transition inline-flex items-center space-x-2">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>

                <!-- Right Images -->
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-4">
                            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=500&h=600&fit=crop"
                                alt="Furniture 1" class="rounded-lg shadow-lg w-full h-64 object-cover" />
                            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=500&h=400&fit=crop"
                                alt="Furniture 2" class="rounded-lg shadow-lg w-full h-48 object-cover" />
                        </div>
                        <div class="space-y-4 mt-8">
                            <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?w=500&h=400&fit=crop"
                                alt="Furniture 3" class="rounded-lg shadow-lg w-full h-48 object-cover" />
                            <img src="https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=500&h=600&fit=crop"
                                alt="Furniture 4" class="rounded-lg shadow-lg w-full h-64 object-cover" />
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-amber-100 rounded-full -z-10"></div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-amber-200 rounded-full -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Kami memberikan nilai lebih untuk setiap pembelian furniture Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="bg-white rounded-lg p-6 text-center hover:shadow-xl transition group">
                    <div
                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition">
                        <svg class="w-8 h-8 text-amber-600 group-hover:text-white transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Kualitas Premium</h3>
                    <p class="text-gray-600">Bahan pilihan dengan standar kualitas internasional</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white rounded-lg p-6 text-center hover:shadow-xl transition group">
                    <div
                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition">
                        <svg class="w-8 h-8 text-amber-600 group-hover:text-white transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Harga Terjangkau</h3>
                    <p class="text-gray-600">Harga kompetitif dengan kualitas terbaik di kelasnya</p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white rounded-lg p-6 text-center hover:shadow-xl transition group">
                    <div
                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition">
                        <svg class="w-8 h-8 text-amber-600 group-hover:text-white transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Gratis Pengiriman</h3>
                    <p class="text-gray-600">Pengiriman gratis ke seluruh Indonesia</p>
                </div>

                <!-- Value 4 -->
                <div class="bg-white rounded-lg p-6 text-center hover:shadow-xl transition group">
                    <div
                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition">
                        <svg class="w-8 h-8 text-amber-600 group-hover:text-white transition" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Garansi Resmi</h3>
                    <p class="text-gray-600">Garansi 1 tahun untuk semua produk</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
// Component logic here if needed
</script>

<style scoped>
/* Custom styles if needed */
</style>