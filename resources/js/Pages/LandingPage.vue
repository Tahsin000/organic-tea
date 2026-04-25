<template>
    <Head title="অর্গানিক - প্রাকৃতিক চা" />
    <div class="min-h-screen">
        <StickyRibbon :content="site.ribbon" />
        <HeroSection v-if="site.hero" :products="products" :content="site.hero" @go-product="goToProduct" />
        <ProductOverview v-if="site.product_overview" :products="products" :content="site.product_overview" />
        <OfferSection v-if="site.offer" :content="site.offer" />
        <ProductGallery v-if="site.product_gallery" :content="site.product_gallery" />
        <ReviewCarousel v-if="site.review" :reviews="reviews" :content="site.review" />
        <!-- <ContactForm :products="products" /> -->
        <FooterSection v-if="site.footer" :content="site.footer" />
    </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
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
    reviews: { type: Array, default: () => [] },
    site: { type: Object, default: () => ({}) },
});

function goToProduct(id) {
    router.visit(`/product/${id}`);
}
</script>
