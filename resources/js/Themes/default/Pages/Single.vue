<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Header with Glass Effect -->
        <header class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-600/30 to-pink-600/30 backdrop-blur-xl"></div>
            <div class="relative container mx-auto px-4 py-12 text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-3 tracking-tight">
                    {{ websiteName }}
                </h1>
                <p class="text-xl text-purple-200 font-light">{{ slogan }}</p>
            </div>
        </header>

        <!-- Navbar with Glass Effect -->
        <nav class="sticky top-0 z-50 backdrop-blur-md bg-white/10 border-b border-white/20">
            <div class="container mx-auto px-4">
                <ul class="flex space-x-8 py-4 overflow-x-auto">
                    <li v-for="menu in menus" :key="menu"
                        class="cursor-pointer text-white hover:text-purple-300 transition duration-300 font-medium whitespace-nowrap">
                        {{ menu }}
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Article Content -->
                <article class="lg:col-span-2">
                    <!-- Breadcrumb -->
                    <div class="flex items-center space-x-2 text-sm text-purple-300 mb-6">
                        <span class="cursor-pointer hover:text-white transition">Beranda</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="cursor-pointer hover:text-white transition">{{ article.category }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <span class="text-white">{{ article.title }}</span>
                    </div>

                    <!-- Article Header -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl overflow-hidden border border-white/20 mb-8">
                        <div class="relative">
                            <img :src="article.image" :alt="article.title" class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <span
                                    class="inline-block px-4 py-2 backdrop-blur-md bg-purple-500/80 text-white text-sm font-medium rounded-full mb-4">
                                    {{ article.category }}
                                </span>
                                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ article.title }}</h1>
                                <div class="flex items-center space-x-6 text-purple-200">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ article.author }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ article.date }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>{{ article.views }} views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-8 border border-white/20 mb-8">
                        <div class="prose prose-invert prose-lg max-w-none">
                            <p class="text-gray-300 leading-relaxed mb-6" v-for="paragraph in article.content"
                                :key="paragraph">
                                {{ paragraph }}
                            </p>
                        </div>

                        <!-- Tags -->
                        <div class="mt-8 pt-8 border-t border-white/20">
                            <h3 class="text-white font-bold mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Tags:
                            </h3>
                            <div class="flex flex-wrap gap-3">
                                <span v-for="tag in article.tags" :key="tag"
                                    class="px-4 py-2 backdrop-blur-md bg-purple-500/30 hover:bg-purple-500/50 text-purple-200 rounded-lg cursor-pointer transition duration-300">
                                    #{{ tag }}
                                </span>
                            </div>
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-8 pt-8 border-t border-white/20">
                            <h3 class="text-white font-bold mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                                Share:
                            </h3>
                            <div class="flex space-x-4">
                                <button
                                    class="px-6 py-3 backdrop-blur-md bg-blue-500/80 hover:bg-blue-600 text-white rounded-lg transition duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                    Facebook
                                </button>
                                <button
                                    class="px-6 py-3 backdrop-blur-md bg-sky-500/80 hover:bg-sky-600 text-white rounded-lg transition duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                    Twitter
                                </button>
                                <button
                                    class="px-6 py-3 backdrop-blur-md bg-green-500/80 hover:bg-green-600 text-white rounded-lg transition duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                    WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-8 border border-white/20 mb-8">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Komentar ({{ comments.length }})
                        </h3>

                        <!-- Comment Form -->
                        <div class="mb-8">
                            <textarea v-model="newComment" placeholder="Tulis komentar Anda..." rows="4"
                                class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 backdrop-blur-sm mb-4"></textarea>
                            <button @click="addComment"
                                class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition duration-300">
                                Kirim Komentar
                            </button>
                        </div>

                        <!-- Comments List -->
                        <div class="space-y-6">
                            <div v-for="comment in comments" :key="comment.id"
                                class="backdrop-blur-md bg-white/5 rounded-xl p-6 border border-white/10">
                                <div class="flex items-start space-x-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold">
                                        {{ comment.author.charAt(0) }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="font-bold text-white">{{ comment.author }}</h4>
                                            <span class="text-sm text-gray-400">{{ comment.date }}</span>
                                        </div>
                                        <p class="text-gray-300">{{ comment.text }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-8 border border-white/20">
                        <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Artikel Terkait
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div v-for="related in relatedPosts" :key="related.id"
                                class="group cursor-pointer backdrop-blur-md bg-white/5 rounded-xl overflow-hidden border border-white/10 hover:border-purple-400/50 transition duration-300">
                                <img :src="related.image" :alt="related.title"
                                    class="w-full h-40 object-cover group-hover:scale-110 transition duration-500">
                                <div class="p-4">
                                    <h4
                                        class="font-bold text-white group-hover:text-purple-300 transition duration-300 mb-2">
                                        {{ related.title }}</h4>
                                    <p class="text-sm text-gray-400">{{ related.date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="space-y-8">

                    <!-- Author Card -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white">Tentang Penulis</h3>
                        <div class="text-center">
                            <div
                                class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-3xl font-bold mb-4">
                                {{ article.author.charAt(0) }}
                            </div>
                            <h4 class="text-xl font-bold text-white mb-2">{{ article.author }}</h4>
                            <p class="text-gray-300 text-sm mb-4">{{ article.authorBio }}</p>
                            <div class="flex justify-center space-x-3">
                                <button
                                    class="p-2 backdrop-blur-md bg-white/10 hover:bg-white/20 rounded-lg transition duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2 backdrop-blur-md bg-white/10 hover:bg-white/20 rounded-lg transition duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </button>
                                <button
                                    class="p-2 backdrop-blur-md bg-white/10 hover:bg-white/20 rounded-lg transition duration-300">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Posts -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Populer
                        </h3>
                        <ul class="space-y-4">
                            <li v-for="(post, index) in popularPosts" :key="post.id"
                                class="cursor-pointer hover:bg-white/10 p-3 rounded-lg transition duration-300 group flex">
                                <div
                                    class="flex-shrink-0 w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold mr-4">
                                    {{ index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h4
                                        class="font-medium text-white group-hover:text-purple-300 mb-1 transition duration-300">
                                        {{ post.title }}</h4>
                                    <p class="text-sm text-gray-400">{{ post.views }} views</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="backdrop-blur-xl bg-white/10 rounded-2xl p-6 border border-white/20">
                        <h3 class="text-2xl font-bold mb-4 text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Newsletter
                        </h3>
                        <p class="text-gray-300 mb-4">Dapatkan artikel terbaru langsung ke email Anda</p>
                        <input v-model="newsletterEmail" type="email" placeholder="Email Anda"
                            class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 backdrop-blur-sm mb-4">
                        <button
                            class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition duration-300">
                            Subscribe
                        </button>
                    </div>

                </aside>

            </div>
        </div>

        <!-- Footer with Glass Effect -->
        <footer class="backdrop-blur-xl bg-white/5 border-t border-white/20 py-8 mt-12">
            <div class="container mx-auto px-4 text-center">
                <p class="mb-2 text-white font-medium">&copy; 2024 {{ websiteName }}. All rights reserved.</p>
                <p class="text-purple-300">{{ slogan }}</p>
            </div>
        </footer>

    </div>
</template>

<script>
export default {
    name: 'DetailPost',
    data() {
        return {
            websiteName: 'InfoMagazine',
            slogan: 'Inspirasi Setiap Hari',
            menus: ['Beranda', 'Teknologi', 'Bisnis', 'Lifestyle', 'Travel', 'Olahraga', 'Kontak'],
            newsletterEmail: '',
            newComment: '',
            article: {
                id: 1,
                title: 'Tren Teknologi 2024 yang Wajib Diketahui',
                category: 'Teknologi',
                date: '1 Desember 2024',
                author: 'Ahmad Fauzi',
                authorBio: 'Tech enthusiast dan content creator yang passionate dalam dunia teknologi dan inovasi digital.',
                views: '1,234',
                image: 'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?w=1200&h=600&fit=crop',
                content: [
                    'Perkembangan teknologi di tahun 2024 membawa berbagai inovasi menarik yang akan mengubah cara kita hidup dan bekerja. Dari kecerdasan buatan hingga komputasi kuantum, mari kita eksplorasi tren-tren teknologi yang paling berpengaruh tahun ini.',
                    'Artificial Intelligence (AI) terus berkembang dengan pesat. Machine learning dan deep learning kini tidak hanya digunakan oleh perusahaan besar, tetapi juga mulai diadopsi oleh startup dan bisnis menengah. Aplikasi AI dalam berbagai sektor seperti healthcare, finance, dan e-commerce menunjukkan peningkatan signifikan dalam efisiensi dan akurasi.',
                    'Internet of Things (IoT) juga mengalami pertumbuhan eksponensial. Smart home, wearable devices, dan kota pintar bukan lagi konsep futuristik, melainkan kenyataan yang kita hadapi sehari-hari. Perangkat-perangkat ini saling terhubung dan berkomunikasi untuk memberikan pengalaman yang lebih seamless dan efisien.',
                    'Blockchain dan cryptocurrency terus menjadi topik hangat. Meskipun volatilitasnya tinggi, teknologi blockchain menawarkan solusi inovatif untuk keamanan data, transparansi transaksi, dan desentralisasi sistem. Banyak industri mulai mengeksplorasi implementasi blockchain di luar cryptocurrency.',
                    '5G dan konektivitas super cepat membuka peluang baru untuk aplikasi real-time, augmented reality (AR), dan virtual reality (VR). Dengan kecepatan internet yang jauh lebih tinggi, pengalaman digital kita akan menjadi lebih immersive dan responsif.',
                    'Sustainability tech atau teknologi berkelanjutan menjadi fokus utama. Dari energi terbarukan hingga solusi pengurangan emisi karbon, teknologi hijau tidak hanya baik untuk planet kita, tetapi juga menjadi peluang bisnis yang menjanjikan. Panel surya yang lebih efisien, baterai yang lebih tahan lama, dan kendaraan listrik adalah beberapa contohnya.',
                    'Kesimpulannya, tahun 2024 adalah tahun yang penuh dengan inovasi teknologi. Untuk tetap relevan, kita perlu terus belajar dan beradaptasi dengan perubahan-perubahan ini. Teknologi bukan hanya tentang gadget dan perangkat, tetapi tentang bagaimana kita menggunakan inovasi ini untuk meningkatkan kualitas hidup dan menciptakan masa depan yang lebih baik.'
                ],
                tags: ['Teknologi', 'AI', 'IoT', 'Blockchain', '5G', 'Innovation', 'FutureTech']
            },
            comments: [
                {
                    id: 1,
                    author: 'Budi Santoso',
                    date: '2 Desember 2024',
                    text: 'Artikel yang sangat informatif! Saya sangat tertarik dengan perkembangan AI dan bagaimana penerapannya di berbagai industri. Terima kasih atas sharingnya!'
                },
                {
                    id: 2,
                    author: 'Siti Nurhaliza',
                    date: '2 Desember 2024',
                    text: 'Penjelasan tentang IoT sangat menarik. Saya sudah mulai menggunakan smart home devices dan memang sangat membantu kehidupan sehari-hari.'
                },
                {
                    id: 3,
                    author: 'Andi Wijaya',
                    date: '1 Desember 2024',
                    text: 'Blockchain memang teknologi yang revolutionary. Tapi masih banyak yang belum paham potensinya di luar crypto. Good article!'
                }
            ],
            relatedPosts: [
                {
                    id: 2,
                    title: 'Panduan Lengkap Memulai dengan AI untuk Pemula',
                    date: '30 November 2024',
                    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=400&fit=crop'
                },
                {
                    id: 3,
                    title: 'Masa Depan Internet: Web 3.0 dan Desentralisasi',
                    date: '29 November 2024',
                    image: 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=600&h=400&fit=crop'
                },
                {
                    id: 4,
                    title: 'Smart Home: Membuat Rumah Anda Lebih Pintar',
                    date: '28 November 2024',
                    image: 'https://images.unsplash.com/photo-1558002038-1055907df827?w=600&h=400&fit=crop'
                },
                {
                    id: 5,
                    title: 'Cryptocurrency: Investasi atau Spekulasi?',
                    date: '27 November 2024',
                    image: 'https://images.unsplash.com/photo-1621504450181-5d356f61d307?w=600&h=400&fit=crop'
                }
            ],
            popularPosts: [
                {
                    id: 1,
                    title: 'Tips Produktivitas untuk Pekerja Remote',
                    views: '3,456'
                },
                {
                    id: 2,
                    title: 'Resep Masakan Sehat untuk Diet',
                    views: '2,890'
                },
                {
                    id: 3,
                    title: 'Review Gadget Terbaru Tahun Ini',
                    views: '2,567'
                },
                {
                    id: 4,
                    title: 'Cara Memulai Investasi untuk Pemula',
                    views: '2,345'
                },
                {
                    id: 5,
                    title: 'Panduan Lengkap Belajar Vue.js',
                    views: '2,123'
                }
            ]
        }
    },
    methods: {
        addComment() {
            if (this.newComment.trim()) {
                this.comments.unshift({
                    id: this.comments.length + 1,
                    author: 'Anda',
                    date: new Date().toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }),
                    text: this.newComment
                })
                this.newComment = ''
            }
        }
    }
}
</script>

<style scoped>
/* Smooth transitions */
* {
    transition: all 0.3s ease;
}

/* Prose styling for article content */
.prose-invert p {
    color: #d1d5db;
    line-height: 1.8;
}
</style>