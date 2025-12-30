<template>
    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-br from-amber-50 to-orange-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-amber-600 font-semibold text-sm uppercase tracking-wide">Testimoni</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-4 mb-4">
                    Apa Kata Pelanggan Kami?
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Ribuan pelanggan telah mempercayai kami untuk mewujudkan rumah impian mereka
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <div v-for="testimonial in testimonials" :key="testimonial.id"
                    class="bg-white rounded-lg p-6 shadow-lg hover:shadow-xl transition">
                    <!-- Rating Stars -->
                    <div class="flex text-amber-500 mb-4">
                        <svg v-for="i in 5" :key="i" class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                    </div>

                    <!-- Testimonial Text -->
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        "{{ testimonial.text }}"
                    </p>

                    <!-- Customer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                            <img :src="testimonial.avatar" :alt="testimonial.name" class="w-full h-full object-cover" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{ testimonial.name }}</h4>
                            <p class="text-sm text-gray-500">{{ testimonial.role }}</p>
                        </div>
                    </div>

                    <!-- Quote Icon -->
                    <div class="absolute top-4 right-4 opacity-10">
                        <svg class="w-16 h-16 text-amber-600" fill="currentColor" viewBox="0 0 32 32">
                            <path
                                d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Video Testimonial -->
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Video Placeholder -->
                    <div class="relative bg-gray-900 h-64 lg:h-auto">
                        <img src="https://images.unsplash.com/photo-1556912173-46c336c7fd55?w=800&h=600&fit=crop"
                            alt="Video Testimonial" class="w-full h-full object-cover opacity-80" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button
                                class="w-20 h-20 bg-amber-600 rounded-full flex items-center justify-center hover:bg-amber-700 transition transform hover:scale-110">
                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <span class="text-amber-600 font-semibold text-sm uppercase tracking-wide mb-2">Video
                            Testimoni</span>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            Pengalaman Nyata dari Pelanggan Setia Kami
                        </h3>
                        <p class="text-gray-600 mb-6">
                            Dengarkan langsung dari pelanggan kami tentang bagaimana FurniShop membantu mewujudkan rumah
                            impian mereka dengan furniture berkualitas tinggi.
                        </p>
                        <div class="flex items-center">
                            <div class="w-16 h-16 rounded-full overflow-hidden mr-4">
                                <img src="https://i.pravatar.cc/150?img=12" alt="Customer"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Sarah Johnson</h4>
                                <p class="text-sm text-gray-500">Interior Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-amber-600 mb-2">{{ stats.happyCustomers }}</div>
                    <div class="text-gray-600">Pelanggan Bahagia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-amber-600 mb-2">{{ stats.rating }}</div>
                    <div class="text-gray-600">Rating Google Review</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-amber-600 mb-2">{{ stats.projects }}</div>
                    <div class="text-gray-600">Proyek Selesai</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-amber-600 mb-2">{{ stats.cities }}</div>
                    <div class="text-gray-600">Kota Terjangkau</div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const testimonials = ref([
    {
        id: 1,
        name: 'Budi Santoso',
        role: 'Pengusaha',
        avatar: 'https://i.pravatar.cc/150?img=1',
        text: 'Sangat puas dengan pelayanan FurniShop! Furniture yang saya beli berkualitas tinggi dan pengiriman tepat waktu. Highly recommended!'
    },
    {
        id: 2,
        name: 'Siti Aminah',
        role: 'Ibu Rumah Tangga',
        avatar: 'https://i.pravatar.cc/150?img=5',
        text: 'Desain furniture-nya modern dan elegan. Rumah saya jadi terlihat lebih indah. Terima kasih FurniShop!'
    },
    {
        id: 3,
        name: 'Andi Wijaya',
        role: 'Arsitek',
        avatar: 'https://i.pravatar.cc/150?img=3',
        text: 'Sebagai arsitek, saya sangat merekomendasikan FurniShop untuk klien saya. Kualitas produk dan layanan sangat memuaskan.'
    },
    {
        id: 4,
        name: 'Dewi Lestari',
        role: 'Interior Designer',
        avatar: 'https://i.pravatar.cc/150?img=9',
        text: 'Koleksi furniture-nya lengkap dan berkualitas. Saya sering menggunakan produk FurniShop untuk proyek interior design saya.'
    },
    {
        id: 5,
        name: 'Rudi Hermawan',
        role: 'Pengacara',
        avatar: 'https://i.pravatar.cc/150?img=7',
        text: 'Proses pembelian mudah, customer service responsif, dan produk sesuai ekspektasi. Sangat puas!'
    },
    {
        id: 6,
        name: 'Maya Sari',
        role: 'Dokter',
        avatar: 'https://i.pravatar.cc/150?img=10',
        text: 'Furniture di FurniShop tidak hanya cantik tapi juga nyaman dan awet. Worth it banget!'
    }
]);

const stats = ref({
    happyCustomers: '10K+',
    rating: '4.9',
    projects: '500+',
    cities: '50+'
});
</script>

<style scoped>
/* Custom styles if needed */
</style>