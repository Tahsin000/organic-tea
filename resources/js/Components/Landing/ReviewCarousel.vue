<template>
    <section id="reviews" class="relative bg-gradient-to-br from-gray-50 to-green-50 py-16 lg:py-28 overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #16a34a 1px, transparent 1px); background-size: 30px 30px;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 lg:mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <ChatBubbleLeftRightIcon class="w-4 h-4" />
                    {{ c.badge }}
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-3" v-html="c.title_1 + '<span class=text-green-600>' + c.title_highlight + '</span>' + c.title_2">
                </h2>
                <p class="text-gray-600 mt-3 lg:mt-4 text-base lg:text-lg max-w-2xl mx-auto">
                    {{ c.description }}
                </p>
            </div>

            <!-- Desktop (lg+): multi-column animated carousel -->
            <div class="hidden lg:block">
                <div class="relative h-[520px] overflow-hidden">
                    <!-- Fade top/bottom -->
                    <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-gray-50/90 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-green-50/90 to-transparent pointer-events-none z-10"></div>

                    <!-- Column tracks -->
                    <div
                        v-for="(col, ci) in columns"
                        :key="'col-' + ci"
                        class="review-track"
                        :style="{
                            left: (ci * 20) + '%',
                            width: '20%',
                            animationDuration: durations[ci] + 's',
                            animationDirection: ci % 2 === 0 ? 'normal' : 'reverse',
                        }"
                    >
                        <div class="space-y-4 px-2">
                            <div
                                v-for="(review, ri) in [...col, ...col]"
                                :key="'r' + ci + '-' + ri"
                                class="review-card"
                            >
                                <div class="flex gap-0.5 mb-2">
                                    <svg v-for="s in (review.stars || 5)" :key="s" class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                                <p class="rc-text">"{{ review.text || '' }}"</p>
                                <div class="flex items-center gap-2">
                                    <div class="rc-avatar" :class="review.image ? '' : 'rc-avatar-fallback'">
                                        <img v-if="review.image" :src="review.image" :alt="review.name" class="w-full h-full object-cover" />
                                        <span v-else class="rc-initial">{{ review.initial || (review.name || '').substring(0, 2) }}</span>
                                    </div>
                                    <div>
                                        <p class="rc-name">{{ review.name || 'Anonymous' }}</p>
                                        <p class="rc-location">{{ review.location || '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tablet (sm-md): 3 column carousel -->
            <div class="hidden sm:block md:hidden">
                <div class="relative h-[500px] overflow-hidden">
                    <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-gray-50/90 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-green-50/90 to-transparent pointer-events-none z-10"></div>

                    <div
                        v-for="(col, ci) in tabletColumns"
                        :key="'tcol-' + ci"
                        class="review-track"
                        :style="{
                            left: (ci * 33.33) + '%',
                            width: '33.33%',
                            animationDuration: tabletDurations[ci] + 's',
                            animationDirection: ci % 2 === 0 ? 'normal' : 'reverse',
                        }"
                    >
                        <div class="space-y-3 px-1.5">
                            <div
                                v-for="(review, ri) in [...col, ...col]"
                                :key="'tr' + ci + '-' + ri"
                                class="review-card"
                            >
                                <div class="flex gap-0.5 mb-2">
                                    <svg v-for="s in (review.stars || 5)" :key="s" class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                                <p class="rc-text">"{{ review.text || '' }}"</p>
                                <div class="flex items-center gap-2">
                                    <div class="rc-avatar" :class="review.image ? '' : 'rc-avatar-fallback'">
                                        <img v-if="review.image" :src="review.image" :alt="review.name" class="w-full h-full object-cover" />
                                        <span v-else class="rc-initial">{{ review.initial || (review.name || '').substring(0, 2) }}</span>
                                    </div>
                                    <div>
                                        <p class="rc-name">{{ review.name || 'Anonymous' }}</p>
                                        <p class="rc-location">{{ review.location || '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile: horizontal scroll -->
            <div class="sm:hidden">
                <div class="overflow-hidden rounded-xl">
                    <div class="mobile-scroll-track">
                        <template v-for="pass in 2" :key="'pass-' + pass">
                            <div
                                v-for="(review, i) in allReviews"
                                :key="'m' + pass + '-' + i"
                                class="review-card mobile-card"
                            >
                                <div class="flex gap-0.5 mb-2">
                                    <svg v-for="s in (review.stars || 5)" :key="s" class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                                <p class="rc-text">"{{ review.text || '' }}"</p>
                                <div class="flex items-center gap-2">
                                    <div class="rc-avatar" :class="review.image ? '' : 'rc-avatar-fallback'">
                                        <img v-if="review.image" :src="review.image" :alt="review.name" class="w-full h-full object-cover" />
                                        <span v-else class="rc-initial">{{ review.initial || (review.name || '').substring(0, 2) }}</span>
                                    </div>
                                    <div>
                                        <p class="rc-name">{{ review.name || 'Anonymous' }}</p>
                                        <p class="rc-location">{{ review.location || '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Stats bar -->
            <div class="mt-12 lg:mt-16 grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 max-w-3xl mx-auto">
                <div v-for="(stat, i) in c.stats.slice(0, 4)" :key="i" class="text-center">
                    <p class="text-2xl lg:text-3xl font-bold text-green-600">{{ stat.value }}</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ stat.label }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ChatBubbleLeftRightIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';

const props = defineProps({
    reviews: { type: Array, default: () => [] },
    content: { type: Object, default: () => ({}) },
});

const c = computed(() => ({
    badge: 'গ্রাহকদের মতামত',
    title_1: 'আমাদের ',
    title_highlight: 'সন্তুষ্ট',
    title_2: ' গ্রাহকরা কী বলছেন',
    description: '৫,০০+ সন্তুষ্ট গ্রাহক - প্রতিদিন বাড়ছে আমাদের পরিবার',
    stat1_value: '৫,০০০+',
    stat1_label: 'সন্তুষ্ট গ্রাহক',
    stat2_value: '৪.৮/৫',
    stat2_label: 'গড় রেটিং',
    stat3_value: '১০,০০০+',
    stat3_label: 'অর্ডার সম্পন্ন',
    stat4_value: '৯৮%',
    stat4_label: 'পুনরায় অর্ডার',
    ...props.content,
}));

const fallbackReviews = [
    { name: 'রহিম আহমেদ', location: 'ঢাকা', initial: 'রহ', image: null, text: 'অ্যারোমা ব্লেন্ড চা সত্যিই অসাধারণ! স্বাদ আর গন্ধ দুটোই প্রিমিয়াম।', stars: 5 },
    { name: 'ফারহানা খান', location: 'চট্টগ্রাম', initial: 'ফা', image: null, text: 'গ্রিন টি অর্ডার করেছিলাম, প্যাকেজিং ছিল দারুণ। চা পাতা একদম তাজা।', stars: 5 },
    { name: 'কামাল হোসেন', location: 'সিলেট', initial: 'কা', image: null, text: 'দীর্ঘদিন ধরে ভালো চা খুঁজছিলাম। অ্যারোমা ব্লেন্ড সেই খোঁজ শেষ করেছে।', stars: 5 },
    { name: 'নাসরিন আক্তার', location: 'রাজশাহী', initial: 'না', image: null, text: 'হার্বাল টি আমার ঘুমের সমস্যা অনেকটাই কমিয়ে দিয়েছে।', stars: 4 },
    { name: 'জাহিদ হাসান', location: 'খুলনা', initial: 'জা', image: null, text: 'কম্বো প্যাক কিনেছিলাম - তিন ধরনের চা একসাথে। মানসম্মত।', stars: 5 },
    { name: 'সালমা বেগম', location: 'চট্টগ্রাম', initial: 'সা', image: null, text: 'ব্ল্যাক টি এর সুগন্ধ অসাধারণ। ডেলিভারিও খুব দ্রুত।', stars: 5 },
    { name: 'তানভীর রহমান', location: 'ঢাকা', initial: 'তা', image: null, text: 'বন্ধুর কাছ থেকে শুনে অর্ডার করেছিলাম। প্রিমিয়াম কোয়ালিটি।', stars: 4 },
    { name: 'মাহমুদা ইসলাম', location: 'বরিশাল', initial: 'মা', image: null, text: 'গ্রিন টি দিয়ে ডায়েট শুরু করেছি। স্বাদ হালকা কিন্তু তৃপ্তিদায়ক।', stars: 5 },
    { name: 'আরিফুল ইসলাম', location: 'সিলেট', initial: 'আ', image: null, text: 'চা প্রেমি হিসেবে বলছি - এত ভালো চা আগে পাইনি।', stars: 5 },
    { name: 'রুমানা পারভীন', location: 'ঢাকা', initial: 'রু', image: null, text: 'ফুলের চা আমার পছন্দ সবচেয়ে বেশি। সুগন্ধ মন মুগ্ধ করে।', stars: 5 },
    { name: 'সোহেল রানা', location: 'কক্সবাজার', initial: 'সো', image: null, text: 'সারাদিনে ৩ কাপ চা খাই। অ্যারোমা ব্লেন্ড স্বাস্থ্যের জন্য ভালো।', stars: 4 },
    { name: 'তাসনিম জাহান', location: 'রংপুর', initial: 'তা', image: null, text: 'ছেলেমেয়েরাও এখন এই চা খায়। কোনো কৃত্রিম স্বাদ নেই।', stars: 5 },
];

const allReviews = computed(() => {
    const source = props.reviews && props.reviews.length > 0 ? props.reviews : fallbackReviews;
    return shuffleArray([...source]);
});

function shuffleArray(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
}

function distributeToCols(reviews, numCols) {
    const cols = Array.from({ length: numCols }, () => []);
    reviews.forEach((r, i) => {
        cols[i % numCols].push(r);
    });
    return cols;
}

const columns = computed(() => distributeToCols(allReviews.value, 5));
const tabletColumns = computed(() => distributeToCols(allReviews.value, 3));

const durations = [25, 30, 35, 28, 32];
const tabletDurations = [28, 33, 30];
</script>

<style scoped>
/* ── Vertical infinite scroll ── */
@keyframes review-scroll {
    0% { transform: translateY(0); }
    100% { transform: translateY(-50%); }
}

.review-track {
    position: absolute;
    top: 0;
    height: auto;
    overflow: visible;
    animation: review-scroll linear infinite;
}

.review-track:hover {
    animation-play-state: paused;
}

/* ── Mobile horizontal scroll ── */
.mobile-scroll-track {
    display: flex;
    gap: 0.75rem;
    animation: scroll-horizontal 40s linear infinite;
    width: max-content;
}

.mobile-scroll-track:hover {
    animation-play-state: paused;
}

.mobile-scroll-track > * {
    width: 280px;
    flex-shrink: 0;
}

@keyframes scroll-horizontal {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ── Review card ── */
.review-card {
    background: #fff;
    border-radius: 0.75rem;
    padding: 0.75rem;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    border: 1px solid #f3f4f6;
    transition: box-shadow 0.3s ease;
    user-select: none;
    flex-shrink: 0;
}

.review-card:hover {
    box-shadow: 0 4px 12px 0 rgb(0 0 0 / 0.1);
}

.mobile-card {
    width: 280px;
}

.rc-text {
    color: #4b5563;
    font-size: 0.75rem;
    line-height: 1.5;
    margin-bottom: 0.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.rc-avatar {
    width: 1.75rem;
    height: 1.75rem;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
}

.rc-avatar-fallback {
    background-color: #dcfce7;
}

.rc-initial {
    color: #15803d;
    font-weight: 700;
    font-size: 0.625rem;
}

.rc-name {
    font-weight: 600;
    color: #111827;
    font-size: 0.75rem;
}

.rc-location {
    color: #9ca3af;
    font-size: 0.625rem;
}
</style>
