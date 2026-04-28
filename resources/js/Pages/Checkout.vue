<template>
    <Head title="চেকআউট - অর্গানিক চা" />
    <div class="min-h-screen bg-gray-50">
        <StickyRibbon />

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10 lg:py-16 mt-10 sm:mt-12">
            <!-- Back link -->
            <a href="/" class="inline-flex items-center gap-2 text-sm sm:text-base text-gray-600 hover:text-green-600 transition-colors mb-4 sm:mb-6">
                <ArrowLeftIcon class="w-4 h-4" />
                হোমে ফিরুন
            </a>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6 sm:mb-8">চেকআউট</h1>

            <!-- Steps indicator -->
            <div class="flex items-center justify-between sm:justify-center mb-6 sm:mb-10 gap-1 sm:gap-0">
                <div v-for="(step, i) in steps" :key="i" class="flex items-center">
                    <div :class="`flex items-center gap-2 ${i + 1 <= currentStep ? 'text-green-600' : 'text-gray-400'}`">
                        <div :class="`w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center text-xs sm:text-sm font-bold transition-all ${i + 1 < currentStep ? 'bg-green-600 text-white' : i + 1 === currentStep ? 'bg-green-100 text-green-700 ring-2 ring-green-600' : 'bg-gray-200 text-gray-500'}`">
                            <CheckIcon v-if="i + 1 < currentStep" class="w-3.5 h-3.5 sm:w-4 sm:h-4" />
                            <span v-else>{{ formatBangla(i + 1) }}</span>
                        </div>
                        <span class="text-xs sm:text-sm font-medium hidden sm:inline">{{ step }}</span>
                    </div>
                    <div v-if="i < steps.length - 1" :class="`w-8 sm:w-12 lg:w-20 h-0.5 mx-1.5 sm:mx-2 ${i + 1 < currentStep ? 'bg-green-600' : 'bg-gray-200'}`"></div>
                </div>
            </div>

            <div class="grid lg:grid-cols-5 gap-6 lg:gap-8">
                <!-- Order Form (3 cols) -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Step 1: Select Products -->
                    <div v-if="currentStep === 1" class="bg-white rounded-xl sm:rounded-2xl shadow-sm p-4 sm:p-6 lg:p-8 border border-gray-100">
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                            <ShoppingBagIcon class="w-5 h-5 text-green-600" />
                            পণ্য নির্বাচন
                        </h2>

                        <div class="space-y-3 sm:space-y-4 mb-6">
                            <div v-for="p in allProducts" :key="p.id"
                                 :class="`flex flex-wrap sm:flex-nowrap items-start sm:items-center gap-3 sm:gap-4 p-3 sm:p-4 rounded-lg sm:rounded-xl border-2 transition-all cursor-pointer hover:border-green-300 ${selectedProducts.find(s => s.id === p.id) ? 'border-green-600 bg-green-50' : 'border-gray-200'}`"
                                 @click="toggleProduct(p)">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg overflow-hidden flex-shrink-0 bg-green-100">
                                    <img :src="p.image" :alt="p.name" class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 min-w-0 pt-0.5">
                                    <h4 class="font-bold text-gray-900 text-sm sm:text-base truncate">{{ p.name }}</h4>
                                    <div class="flex items-baseline gap-1.5 sm:gap-2">
                                        <span class="text-green-600 font-bold text-sm sm:text-base">{{ formatBangla(p.price) }}৳</span>
                                        <span class="text-xs sm:text-sm text-gray-400 line-through">{{ formatBangla(p.original_price) }}৳</span>
                                    </div>
                                </div>
                                <!-- Qty controls (only if selected) -->
                                <div v-if="selectedProducts.find(s => s.id === p.id)" class="flex items-center gap-1.5 sm:gap-2 w-full sm:w-auto pl-[3.75rem] sm:pl-0">
                                    <button @click.stop="updateItemQty(p.id, -1)"
                                            class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-base sm:text-lg font-bold">-</button>
                                    <span class="w-7 sm:w-8 text-center font-bold text-sm">{{ selectedProducts.find(s => s.id === p.id)?.quantity }}</span>
                                    <button @click.stop="updateItemQty(p.id, 1)"
                                            class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg border-2 border-gray-200 hover:border-green-600 transition-colors flex items-center justify-center text-base sm:text-lg font-bold">+</button>
                                </div>
                                <div v-else class="w-7 h-7 sm:w-8 sm:h-8 rounded-full border-2 border-gray-300 flex items-center justify-center self-center sm:self-auto">
                                    <PlusIcon class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400" />
                                </div>
                            </div>
                        </div>

                        <button @click="nextStep" :disabled="selectedProducts.length === 0"
                                :class="`w-full py-3 sm:py-4 rounded-xl font-bold text-base sm:text-lg flex items-center justify-center gap-2 transition-all ${selectedProducts.length > 0 ? 'bg-green-600 hover:bg-green-700 text-white shadow-lg' : 'bg-gray-200 text-gray-400 cursor-not-allowed'}`">
                            পরবর্তী ধাপ
                            <ArrowRightIcon class="w-4 h-4 sm:w-5 sm:h-5" />
                        </button>
                    </div>

                    <!-- Step 2: Delivery Info -->
                    <div v-if="currentStep === 2" class="bg-white rounded-xl sm:rounded-2xl shadow-sm p-4 sm:p-6 lg:p-8 border border-gray-100">
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                            <TruckIcon class="w-5 h-5 text-green-600" />
                            ডেলিভারি তথ্য
                        </h2>
                        <form @submit.prevent="nextStep" class="space-y-4 sm:space-y-5">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">নাম *</label>
                                    <input v-model="form.name" type="text" required placeholder="আপনার নাম"
                                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm sm:text-base" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">ফোন *</label>
                                    <input v-model="form.phone" type="tel" required placeholder="০১XXXXXXXXX"
                                           class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm sm:text-base" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ইমেইল</label>
                                <input v-model="form.email" type="email" placeholder="example@email.com"
                                       class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm sm:text-base" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ঠিকানা *</label>
                                <textarea v-model="form.address" required rows="3" placeholder="বাড়ি নং, রোড, এলাকা"
                                          class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none text-sm sm:text-base"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">শহর/এলাকা *</label>
                                <select v-model="form.city" required
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors text-sm sm:text-base">
                                    <option value="">-- শহর নির্বাচন করুন --</option>
                                    <option v-for="area in deliveryChargesList" :key="area.key" :value="area.key">
                                        {{ area.name }} (ডেলিভারি: {{ formatBangla(area.charge) }}৳)
                                    </option>
                                </select>
                                <div v-if="form.city && selectedArea" class="mt-2 flex items-center gap-2 text-sm" :class="selectedArea.charge <= 60 ? 'text-green-600' : 'text-amber-600'">
                                    <MapPinIcon class="w-4 h-4" />
                                    <span>ডেলিভারি চার্জ: <strong>{{ formatBangla(selectedArea.charge) }}৳</strong></span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">বিশেষ অনুরোধ</label>
                                <textarea v-model="form.notes" rows="2" placeholder="কোনো বিশেষ অনুরোধ থাকলে লিখুন"
                                          class="w-full px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors resize-none text-sm sm:text-base"></textarea>
                            </div>
                            <div class="flex flex-col-reverse sm:flex-row gap-2 sm:gap-3">
                                <button type="button" @click="currentStep = 1"
                                        class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-4 rounded-xl border-2 border-gray-200 text-gray-600 hover:border-green-600 hover:text-green-600 font-bold text-sm sm:text-base transition-colors">
                                    পূর্ববর্তী
                                </button>
                                <button type="submit"
                                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2.5 sm:py-4 rounded-xl font-bold text-base sm:text-lg flex items-center justify-center gap-2 shadow-lg transition-all">
                                    পরবর্তী ধাপ
                                    <ArrowRightIcon class="w-4 h-4 sm:w-5 sm:h-5" />
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Step 3: Payment & Confirm -->
                    <div v-if="currentStep === 3" class="bg-white rounded-xl sm:rounded-2xl shadow-sm p-4 sm:p-6 lg:p-8 border border-gray-100">
                        <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                            <CreditCardIcon class="w-5 h-5 text-green-600" />
                            পেমেন্ট ও নিশ্চিতকরণ
                        </h2>

                        <!-- Payment method selector -->
                        <div class="space-y-3 mb-6">
                            <h3 class="text-sm font-medium text-gray-700 mb-3">পেমেন্ট পদ্ধতি নির্বাচন করুন</h3>
                            <label v-for="method in paymentMethodsList" :key="method.id"
                                   :class="`flex items-start sm:items-center gap-3 sm:gap-4 p-3 sm:p-4 rounded-lg sm:rounded-xl border-2 cursor-pointer transition-all ${form.payment_method === method.id ? 'border-green-600 bg-green-50' : 'border-gray-200 hover:border-green-300'}`">
                                <input type="radio" v-model="form.payment_method" :value="method.id" class="sr-only" />
                                <div :class="`w-9 h-9 sm:w-10 sm:h-10 rounded-lg flex items-center justify-center flex-shrink-0 ${form.payment_method === method.id ? 'bg-green-600' : 'bg-gray-100'}`">
                                    <component :is="getMethodIcon(method.id)" :class="`w-4 h-4 sm:w-5 sm:h-5 ${form.payment_method === method.id ? 'text-white' : 'text-gray-500'}`" />
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-gray-900 text-sm sm:text-base">{{ method.name }}</p>
                                    <p class="text-xs sm:text-sm text-gray-500">{{ method.desc }}</p>
                                    <p v-if="method.payment_number" class="text-xs text-green-700 font-semibold mt-0.5">পাঠান: {{ method.payment_number }}</p>
                                </div>
                                <div :class="`w-4 h-4 sm:w-5 sm:h-5 rounded-full border-2 flex items-center justify-center ${form.payment_method === method.id ? 'border-green-600' : 'border-gray-300'}`">
                                    <div v-if="form.payment_method === method.id" class="w-2 h-2 sm:w-3 sm:h-3 bg-green-600 rounded-full"></div>
                                </div>
                            </label>
                        </div>

                        <!-- bKash / Nagad transaction fields -->
                        <div v-if="selectedMethod && selectedMethod.requires_transaction" class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 space-y-4">
                            <p class="text-sm font-semibold text-amber-800">
                                {{ selectedMethod.payment_number ? selectedMethod.payment_number + ' নম্বরে পাঠিয়ে নিচের তথ্য দিন।' : 'পেমেন্ট পাঠিয়ে নিচের তথ্য দিন।' }}
                            </p>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">প্রেরকের নম্বর *</label>
                                <input v-model="form.payment_number" type="tel" placeholder="যে নম্বর থেকে পাঠিয়েছেন"
                                       class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition-colors text-sm" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ট্রানজেকশন আইডি *</label>
                                <input v-model="form.transaction_id" type="text" placeholder="Transaction ID"
                                       class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-amber-400 focus:border-amber-400 transition-colors text-sm" />
                            </div>
                        </div>

                        <!-- Review delivery info -->
                        <div class="bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-4 mb-6">
                            <h4 class="font-bold text-gray-700 text-xs sm:text-sm mb-1.5 sm:mb-2">ডেলিভারি তথ্য</h4>
                            <p class="text-gray-900 text-sm sm:text-base">{{ form.name }} - {{ form.phone }}</p>
                            <p class="text-gray-600 text-xs sm:text-sm">{{ form.address }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                {{ selectedArea ? selectedArea.name : form.city }}
                                · ডেলিভারি: {{ formatBangla(deliveryCharge) }}৳
                            </p>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row gap-2 sm:gap-3">
                            <button type="button" @click="currentStep = 2"
                                    class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-4 rounded-xl border-2 border-gray-200 text-gray-600 hover:border-green-600 hover:text-green-600 font-bold text-sm sm:text-base transition-colors">
                                পূর্ববর্তী
                            </button>
                            <button @click="submitOrder"
                                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2.5 sm:py-4 rounded-xl font-bold text-base sm:text-lg flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                                <CheckCircleIcon class="w-4 h-4 sm:w-5 sm:h-5" />
                                অর্ডার নিশ্চিত করুন
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Order Summary (2 cols) -->
                <div class="lg:col-span-2">
                    <!-- Mobile: show summary above form -->
                    <div class="lg:hidden mb-6">
                        <div class="bg-white rounded-xl sm:rounded-2xl shadow-sm p-4 sm:p-6 border border-gray-100">
                            <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-4">অর্ডার সারাংশ</h2>
                            <div v-if="selectedProducts.length > 0" class="space-y-3 mb-4">
                                <div v-for="item in selectedProducts" :key="item.id" class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-green-100">
                                        <img :src="item.image" :alt="item.name" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 text-sm truncate">{{ item.name }}</p>
                                        <p class="text-xs text-gray-500">{{ formatBangla(item.quantity) }} × {{ formatBangla(item.price) }}৳</p>
                                    </div>
                                    <span class="font-bold text-green-600 text-sm">{{ formatBangla(item.price * item.quantity) }}৳</span>
                                </div>
                            </div>
                            <!-- Price breakdown mobile -->
                            <div v-if="selectedProducts.length > 0" class="space-y-2 pt-3 border-t border-gray-200">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>সাবটোটাল</span>
                                    <span>{{ formatBangla(subtotal) }}৳</span>
                                </div>
                                <div class="flex justify-between text-sm text-green-600 font-medium">
                                    <span>প্রথম অর্ডার ছাড় (২০%)</span>
                                    <span>-{{ formatBangla(discount) }}৳</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>ডেলিভারি চার্জ</span>
                                    <span>{{ form.city ? formatBangla(deliveryCharge) + '৳' : '-' }}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-200">
                                    <span>মোট</span>
                                    <span class="text-green-600">{{ formatBangla(total) }}৳</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop: sticky sidebar -->
                    <div class="hidden lg:block bg-white rounded-2xl shadow-sm p-6 border border-gray-100 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">অর্ডার সারাংশ</h2>

                        <!-- Items -->
                        <div v-if="selectedProducts.length > 0" class="space-y-4 mb-6">
                            <div v-for="item in selectedProducts" :key="item.id" class="flex items-center gap-3">
                                <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-green-100">
                                    <img :src="item.image" :alt="item.name" class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-gray-900 text-sm truncate">{{ item.name }}</p>
                                    <p class="text-xs text-gray-500">{{ formatBangla(item.quantity) }} × {{ formatBangla(item.price) }}৳</p>
                                </div>
                                <span class="font-bold text-green-600">{{ formatBangla(item.price * item.quantity) }}৳</span>
                            </div>
                        </div>
                        <div v-else class="text-center py-8 text-gray-400">
                            <ShoppingBagIcon class="w-12 h-12 mx-auto mb-3 opacity-50" />
                            <p>কোনো পণ্য নির্বাচন করা হয়নি</p>
                        </div>

                        <!-- Price breakdown -->
                        <div v-if="selectedProducts.length > 0" class="space-y-3 pt-4 border-t border-gray-200">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>সাবটোটাল</span>
                                <span>{{ formatBangla(subtotal) }}৳</span>
                            </div>
                            <div class="flex justify-between text-sm text-green-600 font-medium">
                                <span>প্রথম অর্ডার ছাড় (২০%)</span>
                                <span>-{{ formatBangla(discount) }}৳</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>ডেলিভারি চার্জ</span>
                                <span>{{ form.city ? formatBangla(deliveryCharge) + '৳' : '-' }}</span>
                            </div>
                            <div class="flex justify-between font-bold text-xl pt-3 border-t border-gray-200">
                                <span>মোট</span>
                                <span class="text-green-600">{{ formatBangla(total) }}৳</span>
                            </div>
                        </div>

                        <!-- Savings badge -->
                        <div v-if="discount > 0" class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                            <p class="text-sm text-green-700 font-medium">
                                আপনি সাশ্রয় করছেন <strong>{{ formatBangla(discount) }}৳</strong>!
                            </p>
                        </div>

                        <!-- Trust badges -->
                        <div class="mt-6 pt-4 border-t border-gray-200 space-y-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <ShieldCheckIcon class="w-4 h-4 text-green-600" />
                                <span>নিরাপদ চেকআউট</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <ArrowPathIcon class="w-4 h-4 text-green-600" />
                                <span>৭ দিনের রিটার্ন পলিসি</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import StickyRibbon from '../Components/Landing/StickyRibbon.vue';
import {
    ArrowLeftIcon, ArrowRightIcon, CheckIcon, ShoppingBagIcon,
    TruckIcon, CreditCardIcon, BanknotesIcon, CheckCircleIcon,
    ShieldCheckIcon, ArrowPathIcon, MapPinIcon, PlusIcon, DevicePhoneMobileIcon,
} from '@heroicons/vue/24/outline';

const props = defineProps({
    products: { type: Object, default: () => ({}) },
    cartItems: { type: Array, default: () => [] },
    deliveryCharges: { type: Array, default: () => [] },
    paymentMethods: { type: Array, default: () => [] },
});

const currentStep = ref(props.cartItems.length > 0 ? 2 : 1);
const steps = ['পণ্য', 'ডেলিভারি', 'নিশ্চিতকরণ'];

const form = reactive({
    name: '', phone: '', email: '', address: '', city: '', notes: '',
    payment_method: '',
    payment_number: '',
    transaction_id: '',
});

// Build lists from props (fall back to hardcoded defaults if DB is empty)
const deliveryChargesList = computed(() => props.deliveryCharges.length ? props.deliveryCharges : [
    { key: 'dhaka', name: 'ঢাকা', charge: 60 },
    { key: 'chittagong', name: 'চট্টগ্রাম', charge: 60 },
    { key: 'outside', name: 'ঢাকা/চট্টগ্রামের বাইরে', charge: 120 },
]);

const paymentMethodsList = computed(() => props.paymentMethods.length ? props.paymentMethods : [
    { id: 'cod', name: 'ক্যাশ অন ডেলিভারি', desc: 'পণ্য পেয়ে ডেলিভারি ম্যানকে পেমেন্ট করুন', requires_transaction: false, payment_number: null },
]);

// Set default payment method to first active one
if (!form.payment_method && paymentMethodsList.value.length) {
    form.payment_method = paymentMethodsList.value[0].id;
}

const iconMap = {
    cod: BanknotesIcon,
    bkash: DevicePhoneMobileIcon,
    nagad: DevicePhoneMobileIcon,
};
function getMethodIcon(key) {
    return iconMap[key] ?? CreditCardIcon;
}

const selectedProducts = ref(props.cartItems.length ? [...props.cartItems] : []);

const allProducts = computed(() => Object.values(props.products));

function toggleProduct(product) {
    const existing = selectedProducts.value.find(s => s.id === product.id);
    if (existing) {
        selectedProducts.value = selectedProducts.value.filter(s => s.id !== product.id);
    } else {
        selectedProducts.value.push({ ...product, quantity: 1 });
    }
}

function updateItemQty(productId, delta) {
    const item = selectedProducts.value.find(s => s.id === productId);
    if (item) {
        item.quantity = Math.max(1, item.quantity + delta);
    }
}

function nextStep() {
    if (currentStep.value < 3) currentStep.value++;
}

function formatBangla(n) {
    const b = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
    return String(Math.round(n)).replace(/\d/g, d => b[d]);
}

const subtotal = computed(() => selectedProducts.value.reduce((sum, item) => sum + item.price * item.quantity, 0));
const discount = computed(() => Math.round(subtotal.value * 0.20));
const selectedArea = computed(() => deliveryChargesList.value.find(d => d.key === form.city) ?? null);
const deliveryCharge = computed(() => selectedArea.value ? selectedArea.value.charge : 0);
const selectedMethod = computed(() => paymentMethodsList.value.find(m => m.id === form.payment_method) ?? null);
const total = computed(() => subtotal.value - discount.value + (form.city ? deliveryCharge.value : 0));

function submitOrder() {
    // Validate transaction fields if required
    if (selectedMethod.value?.requires_transaction) {
        if (!form.payment_number.trim()) {
            alert('প্রেরকের নম্বর দিন।');
            return;
        }
        if (!form.transaction_id.trim()) {
            alert('ট্রানজেকশন আইডি দিন।');
            return;
        }
    }

    router.post('/checkout', {
        name: form.name,
        phone: form.phone,
        email: form.email || null,
        address: form.address,
        city: form.city,
        payment_method: form.payment_method,
        payment_number: form.payment_number || null,
        transaction_id: form.transaction_id || null,
        items: selectedProducts.value.map(item => ({
            product_id: item.id,
            quantity: item.quantity,
            unit_price: item.price,
        })),
        notes: form.notes || null,
    });
}
</script>
