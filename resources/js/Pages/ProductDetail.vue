<template>
    <Head :title="product.name + ' - অ্যারোমা ব্লেন্ড চা'" />
    <div class="min-h-screen bg-white">
        <StickyRibbon :content="site?.ribbon" />

        <!-- Breadcrumb -->
        <div :class="['bg-gray-50 py-3 sm:py-4', ribbonStatus ? 'mt-12' : '']">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center gap-1.5 sm:gap-2 text-xs sm:text-sm text-gray-600 overflow-x-auto whitespace-nowrap" dir="ltr">
                    <a href="/" class="hover:text-green-600 transition-colors">হোম</a>
                    <ChevronRightIcon class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" />
                    <a href="/#products" class="hover:text-green-600 transition-colors">পণ্য</a>
                    <ChevronRightIcon class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" />
                    <span class="text-green-600 font-medium truncate">{{ product.name }}</span>
                </nav>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 lg:py-12">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Image Gallery -->
                <div class="space-y-3 sm:space-y-4">
                    <!-- Main Image with zoom -->
                    <div class="aspect-square bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl sm:rounded-2xl overflow-hidden shadow-lg relative group cursor-zoom-in"
                         @mousemove="onZoomMove" @mouseleave="zoomLevel = 1" @mouseenter="zoomLevel = 2">
                        <img v-if="product.images && product.images[activeImage]" :src="product.images[activeImage]" :alt="product.name"
                             class="w-full h-full object-cover transition-transform duration-300"
                             :style="{ transform: `scale(${zoomLevel})`, transformOrigin: `${zoomX}% ${zoomY}%` }" />
                        <!-- Fallback: default icon if image missing -->
                        <div v-else class="w-full h-full flex flex-col items-center justify-center text-green-300">
                            <svg class="w-32 h-32 sm:w-40 sm:h-40 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313m0 0l-2.25-1.313m0 0l-2.25 1.313m0 0l2.25 1.313M12 12.75l-2.25-1.313M12 12.75l-2.25-1.313m0 0l-2.25 1.313m0 0l2.25 1.313M12 12.75l2.25-1.313M12 12.75l2.25-1.313m0 0l2.25 1.313m0 0l-2.25 1.313M9 12.75l-2.25-1.313M9 12.75l-2.25-1.313m0 0l-2.25 1.313m0 0l2.25 1.313M9 12.75l2.25-1.313M9 12.75l2.25-1.313m0 0l2.25 1.313m0 0l-2.25 1.313M15 12.75l-2.25-1.313M15 12.75l-2.25-1.313m0 0l-2.25 1.313m0 0l2.25 1.313M15 12.75l2.25-1.313M15 12.75l2.25-1.313m0 0l2.25 1.313m0 0l-2.25 1.313" />
                            </svg>
                            <p class="text-sm text-green-400 mt-4 font-medium">ছবি আপলোড করা হয়নি</p>
                        </div>
                        <!-- Discount overlay -->
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4 bg-red-500 text-white text-xs sm:text-lg font-bold px-2.5 py-1.5 sm:px-4 sm:py-2 rounded-lg sm:rounded-xl shadow-lg">
                            {{ formatBangla(discountPercent) }}% ছাড়
                        </div>
                        <!-- Badge -->
                        <div class="absolute top-3 right-3 sm:top-4 sm:right-4 bg-green-600 text-white text-[11px] sm:text-sm font-bold px-2.5 py-1 sm:px-3 rounded-full flex items-center gap-1 max-w-[55%] sm:max-w-none">
                            <TagIcon class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" />
                            {{ product.badge }}
                        </div>
                    </div>
                    <!-- Thumbnails -->
                    <div class="grid grid-cols-4 gap-2 sm:gap-3">
                        <template v-if="product.images && product.images.length > 0">
                            <div v-for="(img, i) in product.images" :key="i"
                                 @click="activeImage = i"
                                 :class="`aspect-square sm:aspect-video rounded-lg sm:rounded-xl overflow-hidden cursor-pointer border-2 sm:border-3 transition-all duration-300 ${activeImage === i ? 'border-green-600 shadow-md scale-[1.02]' : 'border-transparent opacity-60 hover:opacity-100'}`">
                                <img :src="img" class="w-full h-full object-cover" />
                            </div>
                        </template>
                        <div v-else class="w-full text-center py-4 text-gray-400">
                            <p class="text-sm">কোনো ছবি নেই</p>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-5 sm:space-y-6">
                    <div>
                        <h1 class="text-2xl sm:text-4xl font-bold text-gray-900 leading-tight mb-2">{{ product.name }}</h1>
                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                            <div class="flex">
                                <StarIcon v-for="s in 5" :key="s" class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" />
                            </div>
                            <span class="text-xs sm:text-sm text-gray-500">({{ formatBangla(128) }}টি রিভিউ)</span>
                        </div>
                    </div>

                    <!-- Price Block -->
                    <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3">
                        <div class="flex flex-wrap items-baseline gap-x-3 gap-y-1 sm:gap-4">
                            <span class="text-3xl sm:text-5xl font-bold text-green-600">{{ formatBangla(product.price) }}৳</span>
                            <span class="text-lg sm:text-2xl text-gray-400 line-through">{{ formatBangla(product.original_price) }}৳</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                            <span class="bg-red-100 text-red-700 text-xs sm:text-sm font-bold px-2.5 py-1 sm:px-3 rounded-full">
                                {{ formatBangla(discountPercent) }}% ছাড়
                            </span>
                            <span class="bg-green-100 text-green-700 text-xs sm:text-sm font-bold px-2.5 py-1 sm:px-3 rounded-full">
                                আপনি সাশ্রয় করছেন {{ formatBangla(savingsPerUnit) }}৳
                            </span>
                        </div>
                    </div>

                    <!-- First order discount banner -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 flex items-start gap-3">
                        <GiftIcon class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 flex-shrink-0 mt-0.5 sm:mt-1" />
                        <div>
                            <p class="font-bold text-sm sm:text-base text-green-800">প্রথম অর্ডারে ২০% অতিরিক্ত ছাড়!</p>
                            <p class="text-xs sm:text-sm text-green-600">নতুন গ্রাহকদের জন্য স্বাগত অফার - স্বয়ংক্রিয়ভাবে প্রযোজ্য</p>
                        </div>
                    </div>

                    <!-- Offer countdown -->
                    <div v-if="showCountdown" class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <ClockIcon class="w-4 h-4 sm:w-5 sm:h-5 text-amber-600 flex-shrink-0" />
                            <span class="font-bold text-sm sm:text-base text-amber-800">{{ timerLabel }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2 sm:gap-3">
                            <div v-for="unit in ['hours', 'minutes', 'seconds']" :key="unit" class="text-center">
                                <div class="bg-white rounded-lg px-2.5 py-2 sm:px-3 shadow-sm border border-amber-200">
                                    <span class="text-lg sm:text-2xl font-bold font-mono text-amber-700">{{ countdown[unit] }}</span>
                                </div>
                                <span class="text-xs text-amber-600 mt-1 block">{{ unit === 'hours' ? 'ঘন্টা' : unit === 'minutes' ? 'মিনিট' : 'সেকেন্ড' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stock indicator -->
                    <div class="space-y-2">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div class="flex items-center gap-2" :class="stockColor">
                                <component :is="stockIcon" class="w-4 h-4 sm:w-5 sm:h-5" />
                                <span class="font-medium text-sm sm:text-base">{{ stockText }}</span>
                            </div>
                            <span class="text-xs sm:text-sm text-gray-500">{{ formatBangla(product.stock) }}টি বাকি</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-1000"
                                 :class="stockBarColor"
                                 :style="{ width: `${stockPercent}%` }"></div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-sm max-w-none">
                        <p class="text-gray-600 leading-relaxed text-base sm:text-lg">{{ product.desc }}</p>
                    </div>

                    <!-- Quantity + Price Calculator -->
                    <div class="bg-gray-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <span class="text-gray-700 font-semibold text-base sm:text-lg">পরিমাণ:</span>
                            <div class="flex items-center gap-2 self-start sm:self-auto">
                                <button @click="quantity = Math.max(1, quantity - 1)"
                                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-lg sm:text-xl font-bold text-gray-600 hover:text-green-600">-</button>
                                <input v-model.number="quantity" type="number" min="1"
                                       class="w-14 sm:w-16 text-center text-lg sm:text-xl font-bold bg-white border-2 border-gray-200 rounded-lg py-1 focus:border-green-600 focus:ring-2 focus:ring-green-500 outline-none" />
                                <button @click="quantity++"
                                        class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-lg sm:text-xl font-bold text-gray-600 hover:text-green-600">+</button>
                            </div>
                        </div>

                        <!-- Live price calculation -->
                        <div class="space-y-2 text-xs sm:text-sm border-t border-gray-200 pt-4">
                            <div class="flex items-start justify-between gap-3 text-gray-600">
                                <span>{{ product.name }} × {{ formatBangla(quantity) }}</span>
                                <span>{{ formatBangla(subtotal) }}৳</span>
                            </div>
                            <div class="flex items-start justify-between gap-3 text-green-600 font-medium">
                                <span>প্রথম অর্ডার ছাড় (২০%)</span>
                                <span>-{{ formatBangla(discountAmount) }}৳</span>
                            </div>
                            <div class="flex items-start justify-between gap-3 text-amber-600 font-medium">
                                <span>সাবটোটাল</span>
                                <span>{{ formatBangla(afterDiscount) }}৳</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg sm:text-xl pt-3 border-t border-gray-200">
                                <span>মোট</span>
                                <span class="text-green-600">{{ formatBangla(totalPrice) }}৳</span>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex gap-3">
                        <button @click="goToCheckout"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white text-base sm:text-lg font-bold py-3.5 sm:py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2">
                            <ShoppingCartIcon class="w-4 h-4 sm:w-5 sm:h-5" />
                            চেকআউটে যান
                        </button>
                    </div>

                    <!-- Trust badges -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 pt-5 sm:pt-6 border-t border-gray-200">
                        <div class="text-center group">
                            <TruckIcon class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mx-auto mb-2 group-hover:scale-110 transition-transform" />
                            <p class="text-xs text-gray-600">দ্রুত ডেলিভারি</p>
                        </div>
                        <div class="text-center group">
                            <ShieldCheckIcon class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mx-auto mb-2 group-hover:scale-110 transition-transform" />
                            <p class="text-xs text-gray-600">মানি-ব্যাক</p>
                        </div>
                        <div class="text-center group">
                            <BanknotesIcon class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mx-auto mb-2 group-hover:scale-110 transition-transform" />
                            <p class="text-xs text-gray-600">ক্যাশ অন ডেলিভারি</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import StickyRibbon from '../Components/Landing/StickyRibbon.vue';
import {
    ChevronRightIcon, TagIcon, GiftIcon, ClockIcon, ShoppingCartIcon,
    TruckIcon, ShieldCheckIcon, BanknotesIcon, StarIcon,
    ExclamationTriangleIcon, CheckCircleIcon,
} from '@heroicons/vue/24/outline';

const props = defineProps({
    product: { type: Object, required: true },
    products: { type: Object, required: true },
    site: { type: Object, default: () => ({}) },
});

const quantity = ref(1);
const activeImage = ref(0);
const zoomLevel = ref(1);
const zoomX = ref(50);
const zoomY = ref(50);
const countdown = ref({ hours: '00', minutes: '00', seconds: '00' });
let timer = null;

// Ribbon timer awareness
const ribbonConfig = computed(() => props.site?.ribbon || {});
const ribbonStatus = computed(() => {
    const s = ribbonConfig.value.status;
    return s === true || s === 'true' || s === 1;
});
const timerEnabled = computed(() => ribbonConfig.value.timer?.enabled === true);

const showCountdown = computed(() => ribbonStatus.value && timerEnabled.value && isTimerInRange.value);
const timerLabel = computed(() => ribbonConfig.value.timer?.countdown_label || 'অফার শেষ হতে বাকি');

const isTimerInRange = computed(() => {
    const { start_date, end_date } = ribbonConfig.value.timer || {};
    if (!start_date || !end_date) return false;
    const today = new Date(); today.setHours(0, 0, 0, 0);
    const start = new Date(start_date + 'T00:00:00');
    const end = new Date(end_date + 'T23:59:59');
    return today >= start && today <= end;
});

const relatedProducts = computed(() =>
    Object.values(props.products)
        .filter(p => p.slug && p.slug !== props.product.slug)
        .slice(0, 3)
);

const discountPercent = computed(() => Math.round((1 - props.product.price / props.product.original_price) * 100));
const savingsPerUnit = computed(() => props.product.original_price - props.product.price);

// Live price calculation
const subtotal = computed(() => props.product.price * quantity.value);
const discountAmount = computed(() => Math.round(subtotal.value * 0.20));
const afterDiscount = computed(() => subtotal.value - discountAmount.value);
const totalPrice = computed(() => afterDiscount.value);

// Stock indicators
const stockPercent = computed(() => Math.min(100, (props.product.stock / 100) * 100));
const stockColor = computed(() => {
    if (props.product.stock <= 10) return 'text-red-600';
    if (props.product.stock <= 30) return 'text-amber-600';
    return 'text-green-600';
});
const stockBarColor = computed(() => {
    if (props.product.stock <= 10) return 'bg-red-500';
    if (props.product.stock <= 30) return 'bg-amber-500';
    return 'bg-green-500';
});
const stockText = computed(() => {
    if (props.product.stock <= 10) return 'শেষ হতে চলছে!';
    if (props.product.stock <= 30) return 'সীমিত স্টক';
    return 'স্টকে আছে';
});
const stockIcon = computed(() => {
    if (props.product.stock <= 10) return ExclamationTriangleIcon;
    return CheckCircleIcon;
});

function onZoomMove(e) {
    const rect = e.target.getBoundingClientRect();
    zoomX.value = ((e.clientX - rect.left) / rect.width) * 100;
    zoomY.value = ((e.clientY - rect.top) / rect.height) * 100;
}

function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(Math.round(n)).replace(/\d/g, d => b[d]);
}

function updateCountdown() {
    if (!isTimerInRange.value) { countdown.value = { hours: '00', minutes: '00', seconds: '00' }; return; }
    const end = new Date(ribbonConfig.value.timer.end_date + 'T23:59:59');
    const diff = Math.max(0, end - new Date());
    const h = Math.floor(diff / 3600000);
    const m = Math.floor((diff % 3600000) / 60000);
    const s = Math.floor((diff % 60000) / 1000);
    const pad = (x) => String(x).padStart(2, '0');
    countdown.value = { hours: pad(h), minutes: pad(m), seconds: pad(s) };
}

function goToCheckout() {
    window.location.href = `/checkout?product_id=${props.product.id}&quantity=${quantity.value}`;
}

function goToProduct(slug) {
    if (!slug) return;
    router.visit(`/product/${slug}`);
}

onMounted(() => {
    updateCountdown();
    timer = setInterval(updateCountdown, 1000);
});
onUnmounted(() => { if (timer) clearInterval(timer); });
</script>

