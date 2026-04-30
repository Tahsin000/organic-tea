<template>
    <section id="products" class="bg-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-flex items-center gap-2 text-green-600 font-semibold text-sm uppercase tracking-wider">
                    <SparklesIcon class="w-4 h-4" />
                    {{ c.badge }}
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-3" v-html="c.title_1 + '<span class=text-green-600>' + c.title_highlight + '</span>' + c.title_2">
                </h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">
                    {{ c.description }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                <div v-for="(feature, i) in c.features" :key="i"
                     class="group bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 text-center hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border border-green-100 scroll-reveal"
                     :style="`animation-delay: ${i * 0.15}s`">
                    <div class="w-16 h-16 mx-auto bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-200 group-hover:scale-110 transition-all duration-300">
                        <component :is="iconMap(feature.icon)" class="w-8 h-8 text-green-600" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ feature.title }}</h3>
                    <p class="text-gray-600 text-sm">{{ feature.desc }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-bold text-center text-gray-900 mb-10">
                    {{ c.popular_title }}
                </h3>
                <ProductSlider :products="productsList" />
            </div>
        </div>
    </section>
</template>

<script setup>
import { computed } from 'vue';
import ProductSlider from './ProductSlider.vue';
import {
    SparklesIcon,
    ShieldCheckIcon,
    TruckIcon,
    StarIcon,
    BoltIcon,
} from '@heroicons/vue/24/outline';

const props = defineProps({
    products: { type: Object, required: true },
    content: { type: Object, default: () => ({}) },
});

const iconRegistry = {
    shield: ShieldCheckIcon,
    truck: TruckIcon,
    star: StarIcon,
    bolt: BoltIcon,
};

function iconMap(name) {
    return iconRegistry[name] || ShieldCheckIcon;
}

const c = computed(() => ({
    badge: 'আমাদের বিশেষত্ব',
    title_1: 'কেন ',
    title_highlight: 'অ্যারোমা ব্লেন্ড',
    title_2: ' চা সেরা?',
    description: 'প্রতিটি কাপে প্রকৃতির বিশুদ্ধতা',
    features: [
        { icon: 'shield', title: '১০০% জৈব', desc: 'কোনো রাসায়নিক সার বা কীটনাশক নেই' },
        { icon: 'truck', title: 'পাহাড়ি বাগান', desc: 'সিলেটের পাহাড়ি এলাকায় গাছ থেকে সংগ্রহ' },
        { icon: 'star', title: 'হাতে তোলা', desc: 'অভিজ্ঞ কর্মীদের দ্বারা যত্ন সহকারে সংগ্রহ' },
        { icon: 'bolt', title: 'তাজা প্যাকেজিং', desc: 'ভ্যাকুয়াম সিল প্যাকেজিং' },
    ],
    popular_title: 'আমাদের জনপ্রিয় পণ্যসমূহ',
    ...props.content,
}));

const productsList = computed(() => Object.values(props.products));
</script>
