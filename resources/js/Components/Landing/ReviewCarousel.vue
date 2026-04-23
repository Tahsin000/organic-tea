<template>
    <section class="relative bg-gradient-to-br from-gray-50 to-green-50 py-16 lg:py-28 overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, #16a34a 1px, transparent 1px); background-size: 30px 30px;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 lg:mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <ChatBubbleLeftRightIcon class="w-4 h-4" />
                    গ্রাহকদের মতামত
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mt-3">
                    আমাদের <span class="text-green-600">সন্তুষ্ট</span> গ্রাহকরা কী বলছেন
                </h2>
                <p class="text-gray-600 mt-3 lg:mt-4 text-base lg:text-lg max-w-2xl mx-auto">
                    ৫,০০০+ সন্তুষ্ট গ্রাহক — প্রতিদিন বাড়ছে আমাদের পরিবার
                </p>
            </div>

            <!-- Mobile: horizontal scrolling carousel -->
            <div class="sm:hidden">
                <div class="mobile-scroll-wrapper overflow-hidden rounded-xl">
                    <div class="mobile-scroll-track">
                        <ReviewCard v-for="(review, i) in allReviews" :key="'m' + i" :review="review" />
                        <ReviewCard v-for="(review, i) in allReviews" :key="'m' + i + 'dup'" :review="review" />
                    </div>
                </div>
            </div>

            <!-- Tablet (sm-md): 3 column vertical scroll -->
            <div class="hidden sm:block md:hidden">
                <div class="relative h-[500px] overflow-hidden">
                    <div class="absolute left-0 w-1/3 animate-float-down px-1.5">
                        <div class="space-y-3">
                            <ReviewCard v-for="(review, i) in col1" :key="'t1' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col1" :key="'t1' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-1/3 w-1/3 animate-float-up px-1.5">
                        <div class="space-y-3">
                            <ReviewCard v-for="(review, i) in col3" :key="'t3' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col3" :key="'t3' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-2/3 w-1/3 animate-float-down-slow px-1.5">
                        <div class="space-y-3">
                            <ReviewCard v-for="(review, i) in col5" :key="'t5' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col5" :key="'t5' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-gray-50/80 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-green-50/80 to-transparent pointer-events-none z-10"></div>
                </div>
            </div>

            <!-- Desktop (lg+): 5 column vertical scroll -->
            <div class="hidden lg:block">
                <div class="relative h-[450px] overflow-hidden">
                    <div class="absolute left-0 w-1/5 animate-float-down px-2">
                        <div class="space-y-4">
                            <ReviewCard v-for="(review, i) in col1" :key="'d1' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col1" :key="'d1' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-1/5 w-1/5 animate-float-up px-2">
                        <div class="space-y-4">
                            <ReviewCard v-for="(review, i) in col2" :key="'d2' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col2" :key="'d2' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-2/5 w-1/5 animate-float-down-slow px-2">
                        <div class="space-y-4">
                            <ReviewCard v-for="(review, i) in col3" :key="'d3' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col3" :key="'d3' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-3/5 w-1/5 animate-float-up-slow px-2">
                        <div class="space-y-4">
                            <ReviewCard v-for="(review, i) in col4" :key="'d4' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col4" :key="'d4' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute left-4/5 w-1/5 animate-float-down px-2">
                        <div class="space-y-4">
                            <ReviewCard v-for="(review, i) in col5" :key="'d5' + i" :review="review" />
                            <ReviewCard v-for="(review, i) in col5" :key="'d5' + i + 'dup'" :review="review" />
                        </div>
                    </div>
                    <div class="absolute inset-y-0 left-0 w-16 bg-gradient-to-r from-gray-50/80 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-y-0 right-0 w-16 bg-gradient-to-l from-green-50/80 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-x-0 top-0 h-16 bg-gradient-to-b from-gray-50/80 to-transparent pointer-events-none z-10"></div>
                    <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-green-50/80 to-transparent pointer-events-none z-10"></div>
                </div>
            </div>

            <!-- Stats bar -->
            <div class="mt-12 lg:mt-16 grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 max-w-3xl mx-auto">
                <div class="text-center">
                    <p class="text-2xl lg:text-3xl font-bold text-green-600">৫,০০০+</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">সন্তুষ্ট গ্রাহক</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl lg:text-3xl font-bold text-green-600">৪.৮/৫</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">গড় রেটিং</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl lg:text-3xl font-bold text-green-600">১০,০০০+</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">অর্ডার সম্পন্ন</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl lg:text-3xl font-bold text-green-600">৯৮%</p>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">পুনরায় অর্ডার</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ChatBubbleLeftRightIcon } from '@heroicons/vue/24/outline';
import { computed } from 'vue';

function renderStars(count) {
    return Array.from({ length: count }, (_, i) =>
        `<svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.385a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>`
    ).join('');
}

const ReviewCard = {
    props: ['review'],
    template: `
        <div class="bg-white rounded-xl p-3 sm:p-4 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 select-none shrink-0">
            <div class="flex gap-0.5 mb-2" v-html="stars"></div>
            <p class="text-gray-600 text-xs sm:text-sm leading-relaxed line-clamp-3 mb-2">"{{ review.text }}"</p>
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 sm:w-7 sm:h-7 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-green-700 font-bold text-[10px] sm:text-xs">{{ review.initial }}</span>
                </div>
                <div>
                    <p class="font-semibold text-gray-900 text-xs sm:text-sm">{{ review.name }}</p>
                    <p class="text-gray-400 text-[10px] sm:text-xs">{{ review.location }}</p>
                </div>
            </div>
        </div>
    `,
    computed: {
        stars() { return renderStars(this.review.stars); },
    },
};

const allReviews = [
    { name: 'রহিম আহমেদ', location: 'ঢাকা', initial: 'রা', text: 'অর্গানিক চা সত্যিই অসাধারণ! স্বাদ আর গন্ধ দুটোই প্রিমিয়াম।', stars: 5 },
    { name: 'ফারহানা খান', location: 'চট্টগ্রাম', initial: 'ফা', text: 'গ্রিন টি অর্ডার করেছিলাম, প্যাকেজিং ছিল দারুণ। চা পাতা একদম তাজা।', stars: 5 },
    { name: 'কামাল হোসেন', location: 'সিলেট', initial: 'কা', text: 'দীর্ঘদিন ধরে ভালো চা খুঁজছিলাম। অর্গানিক চা সেই খোঁজ শেষ করেছে।', stars: 5 },
    { name: 'নাসরিন আক্তার', location: 'রাজশাহী', initial: 'না', text: 'হার্বাল টি আমার ঘুমের সমস্যা অনেকটাই কমিয়ে দিয়েছে।', stars: 4 },
    { name: 'জাহিদ হাসান', location: 'খুলনা', initial: 'জা', text: 'কম্বো প্যাক কিনেছিলাম — তিন ধরনের চা একসাথে। মানসম্মত।', stars: 5 },
    { name: 'সালমা বেগম', location: 'চট্টগ্রাম', initial: 'সা', text: 'ব্ল্যাক টি এর সুগন্ধ অসাধারণ। ডেলিভারিও খুব দ্রুত।', stars: 5 },
    { name: 'তানভীর রহমান', location: 'ঢাকা', initial: 'তা', text: 'বন্ধুর কাছ থেকে শুনে অর্ডার করেছিলাম। প্রিমিয়াম কোয়ালিটি।', stars: 4 },
    { name: 'মাহমুদা ইসলাম', location: 'বরিশাল', initial: 'মা', text: 'গ্রিন টি দিয়ে ডায়েট শুরু করেছি। স্বাদ হালকা কিন্তু তৃপ্তিদায়ক।', stars: 5 },
    { name: 'আরিফুল ইসলাম', location: 'সিলেট', initial: 'আ', text: 'চা প্রেমি হিসেবে বলছি — এত ভালো চা আগে পাইনি।', stars: 5 },
    { name: 'রুমানা পারভীন', location: 'ঢাকা', initial: 'রু', text: 'ফুলের চা আমার পছন্দ সবচেয়ে বেশি। সুগন্ধ মন মুগ্ধ করে।', stars: 5 },
    { name: 'সোহেল রানা', location: 'কক্সবাজার', initial: 'সো', text: 'সারাদিনে ৩ কাপ চা খাই। অর্গানিক চা স্বাস্থ্যের জন্য ভালো।', stars: 4 },
    { name: 'তাসনিম জাহান', location: 'রংপুর', initial: 'তা', text: 'ছেলেমেয়েরাও এখন এই চা খায়। কোনো কৃত্রিম স্বাদ নেই।', stars: 5 },
];

const col1 = computed(() => allReviews.slice(0, 4));
const col2 = computed(() => allReviews.slice(2, 6));
const col3 = computed(() => allReviews.slice(4, 8));
const col4 = computed(() => allReviews.slice(6, 10));
const col5 = computed(() => allReviews.slice(8, 12));
</script>

<style scoped>
/* ── Mobile horizontal scroll ── */
.mobile-scroll-wrapper {
    overflow: hidden;
}
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

/* ── Vertical infinite scroll ── */
@keyframes float-down {
    0% { transform: translateY(-50%); }
    100% { transform: translateY(0); }
}
@keyframes float-up {
    0% { transform: translateY(0); }
    100% { transform: translateY(-50%); }
}
@keyframes float-down-slow {
    0% { transform: translateY(-50%); }
    100% { transform: translateY(0); }
}
@keyframes float-up-slow {
    0% { transform: translateY(0); }
    100% { transform: translateY(-50%); }
}
.animate-float-down {
    animation: float-down 25s linear infinite;
}
.animate-float-up {
    animation: float-up 30s linear infinite;
}
.animate-float-down-slow {
    animation: float-down-slow 35s linear infinite;
}
.animate-float-up-slow {
    animation: float-up-slow 28s linear infinite;
}

/* Pause all on hover */
section:hover .animate-float-down,
section:hover .animate-float-up,
section:hover .animate-float-down-slow,
section:hover .animate-float-up-slow {
    animation-play-state: paused;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>