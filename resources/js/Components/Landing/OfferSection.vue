<template>
    <section id="offer" class="relative bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 py-16 overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-1/4 w-64 h-64 bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1.5s"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 bg-yellow-400 text-yellow-900 text-sm font-bold px-6 py-2 rounded-full mb-6 animate-bounce">
                <SparklesIcon class="w-4 h-4" />
                {{ c.badge }}
            </div>

            <h2 class="text-3xl sm:text-5xl font-bold text-white mb-6" v-html="c.title_1 + '<span class=text-yellow-300>' + c.title_highlight + '</span>'">
            </h2>

            <p class="text-lg text-green-100 mb-8 max-w-2xl mx-auto">
                {{ c.description }}
            </p>

            <!-- Countdown Timer -->
            <div v-if="showTimer" class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 mb-8 inline-block border border-white/20">
                <p class="text-green-200 text-sm mb-4">{{ c.countdown_label }}</p>
                <div class="flex gap-4 justify-center text-white">
                    <div class="bg-white/20 rounded-xl p-3 min-w-[70px]">
                        <div class="text-3xl font-bold">{{ countdown.hours }}</div>
                        <div class="text-xs text-green-200 mt-1">ঘন্টা</div>
                    </div>
                    <div class="bg-white/20 rounded-xl p-3 min-w-[70px]">
                        <div class="text-3xl font-bold">{{ countdown.minutes }}</div>
                        <div class="text-xs text-green-200 mt-1">মিনিট</div>
                    </div>
                    <div class="bg-white/20 rounded-xl p-3 min-w-[70px]">
                        <div class="text-3xl font-bold">{{ countdown.seconds }}</div>
                        <div class="text-xs text-green-200 mt-1">সেকেন্ড</div>
                    </div>
                </div>
            </div>

            <!-- Offer Stats -->
            <div class="grid grid-cols-3 gap-6 mb-8 max-w-lg mx-auto">
                <div v-for="(stat, i) in c.stats.slice(0, 3)" :key="i" class="text-center">
                    <div class="text-white text-2xl font-bold">{{ stat.value }}</div>
                    <div class="text-green-200 text-xs mt-1">{{ stat.label }}</div>
                </div>
            </div>

            <div>
                <a href="#contact" class="inline-flex items-center gap-2 bg-white text-green-600 hover:bg-yellow-300 hover:text-green-800 text-lg font-bold px-10 py-4 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <ShoppingBagIcon class="w-5 h-5" />
                    {{ c.cta_text }}
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { SparklesIcon, ShoppingBagIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    content: { type: Object, default: () => ({}) },
});

const c = computed(() => ({
    badge: 'সীমিত সময়ের অফার!',
    title_1: 'প্রথম অর্ডারে ',
    title_highlight: '২০% ছাড়',
    description: 'অ্যারোমা ব্লেন্ড ট্রায়াল করুন বিশেষ মূল্যে। প্রতিটি পণ্যে ফ্রি ডেলিভারি এবং ৭ দিনের মানি-ব্যাক গ্যারান্টি।',
    countdown_label: 'অফার শেষ হতে বাকি',
    timer_enabled: true,
    end_date: '',
    stats: [],
    cta_text: 'এখনই অর্ডার করুন',
    ...props.content,
}));

const countdown = ref({ hours: '০০', minutes: '০০', seconds: '০০' });
let timer = null;

const showTimer = computed(() => {
    const t = c.value.timer_enabled;
    return t === true || t === 'true' || t === 1 || t === '1';
});

function toBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).padStart(2, '0').replace(/\d/g, d => b[d]);
}

function updateCountdown() {
    const now = new Date();
    const end = c.value.end_date
        ? new Date(c.value.end_date + 'T23:59:59')
        : (() => { const d = new Date(now); d.setHours(23, 59, 59, 0); return d; })();
    const diff = Math.max(0, end - now);

    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);

    countdown.value = { hours: toBangla(h), minutes: toBangla(m), seconds: toBangla(s) };
}

onMounted(() => {
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
});
onUnmounted(() => { if (timer) clearInterval(timer); });
</script>
