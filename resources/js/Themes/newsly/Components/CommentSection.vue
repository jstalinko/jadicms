<template>
    <!-- Comments Section -->
    <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-sm mb-8" v-if="show">
        <h3 class="text-2xl font-semibold text-slate-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            Komentar ({{ totalComments }})
        </h3>

        <!-- Comment Form -->
        <div class="mb-8">
            <textarea v-model="newComment.content" placeholder="Tulis komentar Anda..." rows="4"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 mb-4"></textarea>
            <input type="text" v-model="newComment.name" placeholder="Nama"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 mb-4">
            <input type="email" v-model="newComment.email" placeholder="Email"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 mb-4">

            <button @click="addComment" :disabled="isSubmitting"
                class="px-6 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                {{ isSubmitting ? 'Mengirim...' : 'Kirim Komentar' }}
            </button>
        </div>

        <!-- Comments List -->
        <div class="space-y-6">
            <div v-for="comment in displayedComments" :key="comment.id"
                class="rounded-xl p-6 border border-slate-200 bg-slate-50">
                <div class="flex items-start space-x-4">
                    <div
                        class="w-12 h-12 rounded-full bg-slate-900 flex items-center justify-center text-white font-bold text-lg">
                        {{ getInitial(comment.author_name) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-semibold text-slate-900">{{ comment.author_name ?? 'Guest' }}</h4>
                            <span class="text-sm text-slate-500">{{ formatDate(comment.created_at) }}</span>
                        </div>
                        <p class="text-slate-600">{{ comment.content }}</p>
                    </div>
                </div>
            </div>
            <HookRenderer place="comment_after" />

            <!-- Load More Button -->
            <div v-if="hasMore" class="text-center pt-4">
                <button @click="loadMore" :disabled="isLoading"
                    class="px-8 py-3 bg-white hover:bg-slate-100 text-slate-700 rounded-xl border border-slate-200 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ isLoading ? 'Memuat...' : `Muat Lebih Banyak (${remainingCount})` }}
                </button>
            </div>

            <!-- No Comments Message -->
            <div v-if="displayedComments.length === 0" class="text-center py-8 text-slate-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="text-lg">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { http, formatDate } from '../../../helpers';
import HookRenderer from './HookRenderer.vue';

const prop = defineProps({
    comments: {
        type: Array,
        default: () => []
    },
    post_id: Number,
    show: Boolean
});

const emit = defineEmits(['comment-added']);

const allComments = ref([...prop.comments]);
const commentsPerPage = 3;
const currentPage = ref(1);
const isLoading = ref(false);
const isSubmitting = ref(false);

const newComment = ref({
    name: '',
    email: '',
    content: '',
    post_id: prop.post_id
});

const displayedComments = computed(() => {
    return allComments.value.slice(0, currentPage.value * commentsPerPage);
});

const totalComments = computed(() => allComments.value.length);

const hasMore = computed(() => {
    return displayedComments.value.length < allComments.value.length;
});

const remainingCount = computed(() => {
    return allComments.value.length - displayedComments.value.length;
});

const loadMore = () => {
    isLoading.value = true;

    // Simulasi loading untuk UX yang lebih baik
    setTimeout(() => {
        currentPage.value++;
        isLoading.value = false;
    }, 300);
};

const getInitial = (name) => {
    if (!name) return 'G';
    return name.charAt(0).toUpperCase();
};

const addComment = async () => {
    // Validasi
    if (!newComment.value.content.trim()) {
        alert('Komentar tidak boleh kosong');
        return;
    }
    if (!newComment.value.name.trim()) {
        alert('Nama tidak boleh kosong');
        return;
    }
    if (!newComment.value.email.trim()) {
        alert('Email tidak boleh kosong');
        return;
    }

    isSubmitting.value = true;

    try {
        const resp = await http('/api/post/comment', {
            method: 'POST',
            body: JSON.stringify(newComment.value),
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (resp.success) {
            // Tambahkan komentar baru di awal array
            allComments.value.unshift(resp.data);
            emit('comment-added', resp.data);

            // Reset form
            newComment.value = {
                name: '',
                email: '',
                content: '',
                post_id: prop.post_id
            };

            // Scroll ke komentar pertama
            setTimeout(() => {
                document.querySelector('.space-y-6')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }, 100);
        } else {
            alert(resp.message);
        }
    } catch (error) {
        alert('Terjadi kesalahan saat mengirim komentar');
        console.error(error);
    } finally {
        isSubmitting.value = false;
    }
};
</script>
