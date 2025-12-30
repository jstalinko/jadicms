<template>
    <AppLayout>
        <article class="space-y-8">
            <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                <span class="uppercase tracking-[0.2em] text-slate-400">Newsly</span>
                <span class="w-px h-3 bg-slate-200"></span>
                <span>{{ parseCategory(post.labels) || ucfirst(post.type) }}</span>
                <span class="w-px h-3 bg-slate-200"></span>
                <span>{{ formatDate(post.created_at) }}</span>
            </div>

            <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                <img :src="imageUrl(post.image)" :alt="post.title" class="w-full h-96 object-cover" />
                <div class="p-8 lg:p-12 space-y-5">
                    <h1 class="text-3xl md:text-4xl font-semibold text-slate-900">
                        {{ post.title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                        <span>{{ parseAuthorName(post.author) }}</span>
                        <span class="w-px h-3 bg-slate-200"></span>
                        <span>{{ parseMetaView(post.meta) ?? 0 }} views</span>
                        <span class="w-px h-3 bg-slate-200"></span>
                        <span>{{ comments.length }} komentar</span>
                    </div>
                    <div class="prose max-w-none text-slate-700">
                        <HookRenderer place="content_single_before" />
                        <div v-html="post.content"></div>
                        <HookRenderer place="content_single_after" />
                    </div>
                </div>
            </div>

            <div v-if="post.labels?.length" class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-sm font-semibold text-slate-900 mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <Link v-for="tag in parseTagArray(post.labels)" :key="tag" :href="routeUrl('tag', tag)"
                        class="px-3 py-1 rounded-full bg-slate-100 text-xs text-slate-600">
                    #{{ tag }}
                    </Link>
                </div>
            </div>

            <CommentSection :comments="comments" :post_id="post.id" :show="post.type === 'post'"
                @comment-added="addComment" />

            <div v-if="post.type === 'post' && relatedPosts.length"
                class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="related in relatedPosts" :key="related.id"
                        class="border border-slate-200 rounded-xl overflow-hidden hover:shadow-md transition">
                        <img :src="imageUrl(related.image)" :alt="related.title" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-slate-900">
                                <Link :href="routeUrl('post', related.slug)">{{ related.title }}</Link>
                            </h4>
                            <p class="text-xs text-slate-500 mt-2">{{ formatDate(related.created_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </AppLayout>
</template>

<script setup>
import AppLayout from '../AppLayout.vue';
import CommentSection from '../Components/CommentSection.vue';
import { parseCategory, parseMetaView, parseTagArray, parseAuthorName, formatDate, imageUrl, ucfirst, routeUrl } from '../../../helpers';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import HookRenderer from '../Components/HookRenderer.vue';

const prop = defineProps({ jdata: Object });
const post = ref(prop.jdata?.post ?? {});
const comments = ref(prop.jdata?.comments ?? []);
const relatedPosts = ref(prop.jdata?.relatedPosts ?? []);

const addComment = (comment) => {
    comments.value.push(comment);
};
</script>
