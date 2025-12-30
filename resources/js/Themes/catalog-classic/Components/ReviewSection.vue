<template>
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Review Pelanggan</h2>
                <button @click="showModal = true"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    Tulis Review
                </button>
            </div>
            <div class="space-y-6">
                <div v-for="review in reviews" :key="review.id" class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-amber-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ review.author_name?.charAt(0) ?? 'Guest' }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="font-semibold text-gray-800">{{ review.author_name ?? 'Guest' }}</h4>
                                <span class="text-sm text-gray-500">{{ timeAgo(review.created_at) }}</span>
                            </div>
                            <div class="flex text-amber-500 mb-2">
                                <svg v-for="i in 5" :key="i" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                </svg>
                            </div>
                            <p class="text-gray-600">{{ review.content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold text-gray-800">Tulis Review</h3>
                    <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="handleSubmit">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input v-model="formData.name" type="text" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                placeholder="Nama Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input v-model="formData.email" type="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                            <div class="flex space-x-1">
                                <button v-for="i in 5" :key="i" type="button" @click="formData.rating = i"
                                    class="focus:outline-none">
                                    <svg class="w-8 h-8 transition-colors"
                                        :class="i <= formData.rating ? 'fill-amber-500' : 'fill-gray-300'"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Review</label>
                            <textarea v-model="formData.comment" required rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                placeholder="Tulis review Anda..."></textarea>
                        </div>
                    </div>

                    <div class="flex space-x-3 mt-6">
                        <button type="button" @click="closeModal"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition duration-200">
                            Kirim Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import { timeAgo } from '../../../helpers';

const props = defineProps({
    reviews: Array
})

const showModal = ref(false)
const formData = ref({
    name: '',
    email: '',
    rating: 5,
    comment: ''
})

const closeModal = () => {
    showModal.value = false
    // Reset form
    formData.value = {
        name: '',
        email: '',
        rating: 5,
        comment: ''
    }
}

const handleSubmit = () => {
    // Handle form submission here
    console.log('Review submitted:', formData.value)

    // Emit event to parent component
    // emit('review-submitted', formData.value)

    // Close modal and reset form
    closeModal()
}
</script>