<template>
    <section class="relative bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 overflow-hidden">
        <!-- Animated background blobs -->
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 bg-green-300 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 lg:pt-12 pb-4 flex justify-center lg:justify-start items-center z-30">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-700 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg border-2 border-green-100">
                    <img src="../../../../public/images/favicon.png" alt="Logo" class="w-full h-full object-cover" />
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-2xl font-bold text-gray-900 leading-none tracking-tight">অ্যারোমা ব্লেন্ড</span>
                    <span class="text-xs text-green-600 font-semibold uppercase tracking-widest mt-1">Aroma Blend</span>
                </div>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-16 lg:pt-16 lg:pb-24">
            <!-- Mobile: tag centered, desktop: left-aligned -->
            <div class="text-center lg:text-right">
                <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 text-sm font-medium px-4 py-2 rounded-full mb-4 animate-fade-in-up">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-1.5 0-2.8.4-3.9 1.1C5.3 6 4 9 4 12c0 5.5 3.8 8.5 8 8.5s8-3 8-8.5c0-3-1.3-6-4.1-7.9C14.8 3.4 13.5 3 12 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/></svg>
                    {{ c.badge }}
                </span>
            </div>

            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center mt-6">
                <!-- Left: Hero content -->
                <div class="z-20 text-center lg:text-right order-2 lg:order-1">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight mb-4 animate-fade-in-up" v-html="c.title_1 + '<span class=text-green-600>' + c.title_highlight + '</span>' + c.title_2">
                    </h1>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600 mb-6 max-w-xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 0.2s">
                        {{ c.description }}
                    </p>

                    <!-- CTA buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start animate-fade-in-up mb-8 w-full max-w-xs mx-auto sm:max-w-none sm:w-auto" style="animation-delay: 0.4s">
                        <a href="#products" class="w-full sm:w-auto group bg-green-600 hover:bg-green-700 text-white text-base sm:text-lg font-semibold px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            {{ c.cta_primary }}
                            <svg class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </a>
                        <a href="#offer" class="w-full sm:w-auto group bg-white hover:bg-gray-50 text-green-600 text-base sm:text-lg font-semibold px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl border-2 border-green-600 hover:border-green-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.149 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l6 6"/></svg>
                            {{ c.cta_secondary }}
                        </a>
                    </div>

                    <!-- Trust stats row -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 max-w-lg mx-auto animate-fade-in-up" style="animation-delay: 0.6s">
                        <div v-for="(stat, i) in c.stats.slice(0, 3)" :key="i" class="text-center">
                            <p class="text-xl sm:text-2xl font-bold text-green-600">{{ stat.value }}</p>
                            <p class="text-xs sm:text-sm text-gray-500">{{ stat.label }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Highlighted products slider -->
                <div class="order-1 lg:order-2 w-full px-4 sm:px-0 mb-6 lg:mb-0 flex justify-center">
                    <div class="relative w-full max-w-[280px] sm:max-w-md lg:max-w-lg overflow-visible">
                        <!-- Glow ring -->
                        <div class="absolute inset-0 bg-green-300 rounded-full opacity-20 blur-2xl animate-pulse"></div>

                        <!-- Slider card -->
                        <div v-if="currentProduct"
                             class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-green-100 cursor-pointer group animate-fade-in-up w-full"
                             @click="goToProduct">
                            <!-- Product image -->
                            <div class="relative h-48 sm:h-56 lg:h-64 bg-gradient-to-br from-green-100 to-emerald-100 overflow-hidden">
                                <img :src="currentProduct.image" :alt="currentProduct.name"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                <!-- Badge -->
                                <span v-if="currentProduct.badge" class="absolute top-3 left-3 bg-green-600 text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.149 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6l6 6"/></svg>
                                    {{ currentProduct.badge }}
                                </span>
                                <!-- Price tag -->
                                <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1.5">
                                    <span class="text-lg font-bold text-green-600">{{ formatBangla(currentProduct.price) }}৳</span>
                                    <span class="text-xs text-gray-400 line-through ml-1">{{ formatBangla(currentProduct.original_price) }}৳</span>
                                </div>
                            </div>
                            <!-- Product info -->
                            <div class="p-4 bg-white">
                                <h3 class="font-bold text-gray-900 text-base">{{ currentProduct.name }}</h3>
                                <p class="text-gray-500 text-sm mt-1 truncate">{{ currentProduct.desc }}</p>
                                <span class="inline-block mt-2 text-xs text-green-600 font-semibold group-hover:underline">অর্ডার করুন →</span>
                            </div>
                        </div>

                        <!-- Slider dots -->
                        <div v-if="slides.length > 1" class="flex items-center justify-center gap-2 mt-4">
                            <button v-for="(_, i) in slides" :key="i"
                                    @click.stop="currentSlide = i"
                                    :class="['w-2.5 h-2.5 rounded-full transition-all duration-300', currentSlide === i ? 'bg-green-600 w-6' : 'bg-green-300 hover:bg-green-400']"
                                    :aria-label="`Slide ${i + 1}`" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave separator -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full" preserveAspectRatio="none">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    highlightedProducts: { type: [Array, Object], default: () => [] },
    content: { type: Object, default: () => ({}) },
});

const c = computed(() => ({
    badge: '১০০% প্রাকৃতিক ও জৈব',
    title_1: 'সেরা মানের ',
    title_highlight: 'অ্যারোমা ব্লেন্ড',
    title_2: ' চা <br class="hidden sm:block" /> আপনার দরজায়',
    description: 'সিলেটের পাহাড়ি বাগান থেকে সংগ্রহ করা বিশুদ্ধ জৈব চা পাতা। কোনো রাসায়নিক সার নেই, কোনো কৃত্রিম স্বাদ নেই - শুধু প্রকৃতির আসল স্বাদ।',
    cta_primary: 'পণ্য দেখুন',
    cta_secondary: 'অফার দেখুন',
    stats: [
        { value: '৫০০+', label: 'সন্তুষ্ট গ্রাহক' },
        { value: '৪.৮/৫', label: 'গড় রেটিং' },
        { value: '১০০০+', label: 'অর্ডার সম্পন্ন' },
    ],
    ...props.content,
}));

const currentSlide = ref(0);
let autoAdvanceTimer = null;

const slides = computed(() => (
    Array.isArray(props.highlightedProducts)
        ? props.highlightedProducts
        : Object.values(props.highlightedProducts || {})
));

const currentProduct = computed(() => slides.value[currentSlide.value] ?? null);

function startAutoAdvance() {
    stopAutoAdvance();
    if (slides.value.length > 1) {
        autoAdvanceTimer = setInterval(() => {
            currentSlide.value = (currentSlide.value + 1) % slides.value.length;
        }, 5000);
    }
}
function stopAutoAdvance() { if (autoAdvanceTimer) { clearInterval(autoAdvanceTimer); autoAdvanceTimer = null; } }

onMounted(() => {
    currentSlide.value = 0;
    startAutoAdvance();
});

onUnmounted(() => { stopAutoAdvance(); });

watch(slides, () => {
    currentSlide.value = 0;
    startAutoAdvance();
}, { deep: true });

function goToProduct() {
    if (currentProduct.value?.slug) {
        router.visit(`/product/${currentProduct.value.slug}`);
    }
}

function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).replace(/\d/g, d => b[d]);
}
</script>

<style scoped>
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up { animation: fade-in-up 0.8s ease-out both; }
</style>
