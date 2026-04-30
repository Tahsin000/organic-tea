<template>
    <Head title="অ্যারোমা ব্লেন্ড - প্রাকৃতিক চা" />
    <div class="min-h-screen" :key="$page.url">
        <StickyRibbon :content="site.ribbon" />
        <HeroSection :highlighted-products="highlightedProducts" :content="site.hero || {}" />
        <ProductOverview v-if="Object.keys(products).length" :products="products" :content="site.product_overview || {}" />
        <OfferSection v-if="site.offer" :content="site.offer" />
        <ProductGallery v-if="site.product_gallery" :content="site.product_gallery" />
        <ReviewCarousel v-if="site.review" :reviews="reviews" :content="site.review" />
        <!-- <ContactForm :products="products" /> -->
        <FooterSection v-if="site.footer" :content="site.footer" />
    </div>

    <!-- Success Toast -->
    <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 -translate-y-4" enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-4">
        <div v-if="showToast" class="fixed top-4 sm:top-6 left-1/2 -translate-x-1/2 z-50 px-3 sm:px-0 w-full sm:w-auto">
            <div class="flex items-center gap-3 bg-green-600 text-white px-5 py-3.5 rounded-2xl shadow-2xl mx-auto w-full sm:w-auto max-w-xl">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-semibold text-sm break-words">{{ toastMessage }}</span>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import StickyRibbon from '../Components/Landing/StickyRibbon.vue';
import HeroSection from '../Components/Landing/HeroSection.vue';
import ProductOverview from '../Components/Landing/ProductOverview.vue';
import OfferSection from '../Components/Landing/OfferSection.vue';
import ProductGallery from '../Components/Landing/ProductGallery.vue';
import ReviewCarousel from '../Components/Landing/ReviewCarousel.vue';
import ContactForm from '../Components/Landing/ContactForm.vue';
import FooterSection from '../Components/Landing/FooterSection.vue';

defineProps({
    products: { type: Object, default: () => ({}) },
    highlightedProducts: { type: Array, default: () => [] },
    reviews: { type: Array, default: () => [] },
    site: { type: Object, default: () => ({}) },
});

const showToast = ref(false);
const toastMessage = ref('');

const page = usePage();

onMounted(() => {
    const flash = page.props.flash;
    if (flash?.success) {
        toastMessage.value = flash.success;
        showToast.value = true;
        setTimeout(() => { showToast.value = false; }, 4000);
    }
});
</script>
