<template>
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-3">{{ c.brand_name }}</h3>
                    <p class="text-gray-400">
                        {{ c.brand_description }}
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">{{ c.quick_links_title }}</h4>
                    <ul class="space-y-2">
                        <li v-for="link in c.quick_links" :key="link.href">
                            <a :href="link.href" class="hover:text-green-400 transition-colors">{{ link.label }}</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">{{ c.contact_title }}</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center gap-2"><PhoneIcon class="w-4 h-4" />{{ c.contact_phone }}</li>
                        <li class="flex items-center gap-2"><EnvelopeIcon class="w-4 h-4" />{{ c.contact_email }}</li>
                        <li class="flex items-center gap-2"><MapPinIcon class="w-4 h-4" />{{ c.contact_address }}</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ new Date().getFullYear() }} {{ c.brand_name }}। সর্বস্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue';
import { PhoneIcon, EnvelopeIcon, MapPinIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    content: { type: Object, default: () => ({}) },
});

const c = computed(() => ({
    brand_name: 'অ্যারোমা ব্লেন্ড (Aroma Blend)',
    brand_description: 'সিলেটের পাহাড়ি বাগান থেকে বিশুদ্ধ জৈব চা পাতা - প্রকৃতির আসল স্বাদ আপনার কাপে।',
    quick_links_title: 'দ্রুত লিংক',
    quick_links: [
        { label: 'পণ্যসমূহ', href: '#products' },
        { label: 'অফার', href: '#offer' },
        { label: 'রিভিউ', href: '#reviews' },
        { label: 'যোগাযোগ', href: '#contact' },
    ],
    contact_title: 'যোগাযোগ',
    contact_phone: '+৮৮০ ১XXX-XXXXXX',
    contact_email: 'info@aromablend.com',
    contact_address: 'সিলেট, বাংলাদেশ',
    ...props.content,
}));
</script>
