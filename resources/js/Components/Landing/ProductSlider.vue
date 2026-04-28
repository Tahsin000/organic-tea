<template>
    <div v-if="!isEmpty" ref="sliderRef" class="relative overflow-hidden rounded-2xl" @touchstart="onTouchStart" @touchmove="onTouchMove" @touchend="onTouchEnd" @mousedown="onDragStart">
        <!-- Track -->
        <div class="flex items-stretch transition-transform duration-500 ease-out select-none"
             :style="{ transform: `translateX(-${translateX}%)`, cursor: isDragging ? 'grabbing' : 'grab' }">
            <div v-for="(item, i) in normalizedProducts" :key="item.id"
                 :style="{ width: `${slideWidth}%`, flexShrink: 0 }"
                 class="px-1.5 sm:px-2 self-stretch"
                 @mouseenter="pauseAutoplay" @mouseleave="resumeAutoplay">
                <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1 border border-gray-100 flex flex-col h-full">
                    <!-- Image -->
                    <div class="relative h-44 sm:h-48 bg-gradient-to-br from-green-100 to-emerald-100 overflow-hidden cursor-pointer flex-shrink-0"
                         @click="goToProduct(item.slug)">
                        <img :src="item.image" :alt="item.name"
                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-700"
                             loading="lazy" />
                        <!-- Badge -->
                        <span class="absolute top-2 left-2 sm:top-3 sm:left-3 bg-green-600 text-white text-[10px] sm:text-xs font-bold px-2 sm:px-3 py-1 rounded-full flex items-center gap-1">
                            <TagIcon class="w-2.5 h-2.5 sm:w-3 sm:h-3" />
                            {{ item.badge }}
                        </span>
                        <!-- Discount Badge -->
                        <span class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-red-500 text-white text-[10px] sm:text-xs font-bold px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full">
                            -{{ discountPercent(item) }}%
                        </span>
                        <!-- Stock urgency -->
                        <span v-if="item.stock <= 20" class="absolute bottom-2 left-2 sm:bottom-3 sm:left-3 bg-orange-500 text-white text-[10px] sm:text-xs font-bold px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full flex items-center gap-1">
                            <FireIcon class="w-2.5 h-2.5 sm:w-3 sm:h-3" />
                           {{ formatBangla(item.stock) }}টি বাকি
                        </span>
                    </div>
                    <!-- Content -->
                    <div class="p-3 sm:p-4 md:p-5 flex flex-col flex-1">
                        <h4 class="text-sm sm:text-base font-bold text-gray-900 mb-1 cursor-pointer hover:text-green-600 transition-colors leading-snug" @click="goToProduct(item.slug)">{{ item.name }}</h4>
                        <p class="text-gray-500 text-xs mb-3 truncate">{{ item.desc }}</p>
                        <!-- Price -->
                        <div class="flex items-baseline gap-1.5 mb-3">
                            <span class="text-lg sm:text-xl font-bold text-green-600">{{ formatBangla(item.price) }}৳</span>
                            <span class="text-xs text-gray-400 line-through">{{ formatBangla(item.original_price) }}৳</span>
                        </div>
                        <!-- Qty + Checkout (pushed to bottom) -->
                        <div class="mt-auto space-y-2">
                            <!-- Qty selector -->
                            <div class="flex items-center gap-1.5">
                                <span class="text-xs text-gray-600">পরিমাণ:</span>
                                <button @click.stop="quantities[item.id] = Math.max(1, (quantities[item.id] || 1) - 1)"
                                        class="w-7 h-7 rounded-lg border border-gray-200 hover:border-green-600 hover:bg-green-50 transition-colors flex items-center justify-center font-bold text-sm">-</button>
                                <span class="w-7 text-center font-bold text-xs">{{ formatBangla(quantities[item.id] || 1) }}</span>
                                <button @click.stop="quantities[item.id] = (quantities[item.id] || 1) + 1"
                                        class="w-7 h-7 rounded-lg border border-gray-200 hover:border-green-600 hover:bg-green-50 transition-colors flex items-center justify-center font-bold text-sm">+</button>
                            </div>
                            <!-- Checkout button -->
                            <button @click.stop="buyNow(item.id)"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2.5 rounded-lg transition-colors flex items-center justify-center gap-1.5 shadow hover:shadow-md">
                                <ShoppingBagIcon class="w-3.5 h-3.5" />
                                চেকআউট করুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button v-if="canGoPrev" @click="prev"
                class="absolute left-1 top-1/2 -translate-y-1/2 -translate-x-2 bg-white shadow-lg rounded-full p-2 hover:bg-gray-50 transition-colors z-10 group">
            <ChevronLeftIcon class="w-5 h-5 text-gray-700 group-hover:text-green-600 transition-colors" />
        </button>
        <button v-if="canGoNext" @click="next"
                class="absolute right-1 top-1/2 -translate-y-1/2 translate-x-2 bg-white shadow-lg rounded-full p-2 hover:bg-gray-50 transition-colors z-10 group">
            <ChevronRightIcon class="w-5 h-5 text-gray-700 group-hover:text-green-600 transition-colors" />
        </button>

        <!-- Dots -->
        <div class="flex justify-center gap-2 mt-6">
            <button v-for="i in totalDots" :key="i"
                    @click="goToSlide(i - 1)"
                    :class="`rounded-full transition-all duration-300 ${i - 1 === currentSlide ? 'bg-green-600 w-8 h-3' : 'bg-gray-300 w-3 h-3'}`" />
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { TagIcon, ShoppingBagIcon, ChevronLeftIcon, ChevronRightIcon, FireIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    products: { type: [Array, Object], required: true },
    slidesPerView: { type: Number, default: 3 },
    autoplayInterval: { type: Number, default: 4000 },
});

const currentSlide = ref(0);
const isDragging = ref(false);
const dragStartX = ref(0);
const dragOffset = ref(0);
const quantities = ref({});
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);
const sliderRef = ref(null);
let autoplayTimer = null;

const normalizedProducts = computed(() => (
    Array.isArray(props.products)
        ? props.products
        : Object.values(props.products || {})
));

const isEmpty = computed(() => normalizedProducts.value.length === 0);

function updateWidth() { windowWidth.value = window.innerWidth; }

const responsiveSlides = computed(() => {
    const w = windowWidth.value;
    if (w < 640) return 1;
    if (w < 1024) return 2;
    return Math.min(props.slidesPerView, 3);
});

const slidesPerView = computed(() => responsiveSlides.value);
const slideWidth = computed(() => 100 / slidesPerView.value);
const totalSlides = computed(() => normalizedProducts.value.length);
const maxSlide = computed(() => Math.max(0, normalizedProducts.value.length - slidesPerView.value));
const totalDots = computed(() => Math.max(1, normalizedProducts.value.length - slidesPerView.value + 1));

const translateX = computed(() => {
    if (totalSlides.value <= slidesPerView.value) return 0;
    return (currentSlide.value / totalSlides.value) * 100;
});

const canGoNext = computed(() => totalSlides.value > slidesPerView.value && currentSlide.value < maxSlide.value);
const canGoPrev = computed(() => totalSlides.value > slidesPerView.value && currentSlide.value > 0);

function clampSlide(val) {
    return Math.max(0, Math.min(val, maxSlide.value));
}

function next() {
    currentSlide.value = clampSlide(currentSlide.value + 1);
    if (currentSlide.value >= maxSlide.value) {
        stopAutoplay();
    }
}

function prev() {
    currentSlide.value = clampSlide(currentSlide.value - 1);
}

function goToSlide(dotIndex) {
    currentSlide.value = clampSlide(dotIndex);
}

function buyNow(productId) {
    window.location.href = `/checkout?product_id=${productId}&quantity=${quantities.value[productId] || 1}`;
}

function goToProduct(slug) {
    if (!slug) return;
    window.location.href = `/product/${slug}`;
}

// Autoplay
function startAutoplay() {
    stopAutoplay();
    if (totalSlides.value <= slidesPerView.value) return;
    autoplayTimer = setInterval(() => {
        if (currentSlide.value < maxSlide.value) {
            currentSlide.value++;
        } else {
            stopAutoplay();
        }
    }, props.autoplayInterval);
}
function stopAutoplay() { if (autoplayTimer) { clearInterval(autoplayTimer); autoplayTimer = null; } }
function pauseAutoplay() { stopAutoplay(); }
function resumeAutoplay() { startAutoplay(); }

// Touch/Swipe
function onTouchStart(e) { dragStartX.value = e.touches[0].clientX; }
function onTouchMove(e) { dragOffset.value = e.touches[0].clientX - dragStartX.value; }
function onTouchEnd() { handleSwipeEnd(dragOffset.value); dragOffset.value = 0; }

// Mouse drag
function onDragStart(e) {
    if (e.button !== 0) return;
    isDragging.value = true;
    dragStartX.value = e.clientX;
    pauseAutoplay();

    const move = (ev) => { dragOffset.value = ev.clientX - dragStartX.value; };
    const up = () => {
        isDragging.value = false;
        handleSwipeEnd(dragOffset.value);
        dragOffset.value = 0;
        resumeAutoplay();
        document.removeEventListener('mousemove', move);
        document.removeEventListener('mouseup', up);
    };
    document.addEventListener('mousemove', move);
    document.addEventListener('mouseup', up);
}

function handleSwipeEnd(offset) {
    const threshold = 50;
    if (offset < -threshold) next();
    else if (offset > threshold) prev();
}

// Utilities
function discountPercent(item) {
    if (!item.original_price || item.original_price === 0) return 0;
    return Math.round((1 - item.price / item.original_price) * 100);
}
function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(n).replace(/\d/g, d => b[d]);
}

// Lifecycle
function initSlider() {
    currentSlide.value = 0;
    quantities.value = {};
    dragOffset.value = 0;
    isDragging.value = false;
    windowWidth.value = window.innerWidth;
    startAutoplay();
}

onMounted(() => {
    initSlider();
    window.addEventListener('resize', updateWidth);
});

onUnmounted(() => {
    stopAutoplay();
    window.removeEventListener('resize', updateWidth);
});

// Reinitialize when products change (handles Inertia SPA navigation)
watch(normalizedProducts, () => {
    initSlider();
}, { deep: true });
</script>
