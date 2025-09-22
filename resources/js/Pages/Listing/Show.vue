<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="listing.images.length" class="md:col-span-7 flex items-center justify-center">
            <div class="grid grid-cols-2 gap-2">
                <img v-for="image in listing.images" :key="image.id" :src="image.src" class="w-full h-auto rounded-md" />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center justify-center">No Images</EmptyState>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic Information
                </template>
                <Price :price="listing.price" class="text-2xl font-bold text-gray-600" />
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Interest Rate ({{ interestRate }}%)</label>
                    <input
                        v-model.number="interestRate"
                        type="range" min="0.1" max="30" step="0.1"
                        class="w-full h-4 bg-gray-200
                        rounded-lg appearance-none cursor-pointer
                        dark:bg-gray-700"
                    />

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range" min="3" max="35" step="1"
                        class="w-full h-4 bg-gray-200
                        rounded-lg appearance-none cursor-pointer
                        dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl font-bold text-gray-600" />
                    </div>

                    <div class="text-gray-500 dark:text-gray-300 mt-2">
                        <div class="flex justify-between">
                            <div>Total Paid</div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <Price :price="listing.price" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <div>Total Interest</div>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer
                v-if="user && !offerMade"
                :listing-id="listing.id"
                :price="listing.price"
                @offer-updated="offerUpdatedHandler"
            />
            <OfferMade 
                v-if="user && offerMade" 
                :offer="offerMade" 
            />
        </div>
    </div>
</template>

<script setup>
    import ListingAddress from '@/Components/ListingAddress.vue'
    import ListingSpace from '@/Components/ListingSpace.vue';
    import Price from '@/Components/Price.vue';
    import Box from '@/Components/UI/Box.vue';
    import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
    import {computed, ref} from 'vue';
    import { useMonthlyPayment } from '@/Compasables/useMonthlyPayment';
    import { usePage } from '@inertiajs/vue3'
    import OfferMade from './Show/Components/OfferMade.vue';
import EmptyState from '../../Components/UI/EmptyState.vue';

    const interestRate = ref(2.5);
    const duration = ref(25);
    const page = usePage();

    const props = defineProps({
        listing: Object,
        offerMade: Object
    });

    const offer = ref(props.listing.price);

    const { monthlyPayment, totalPaid, totalInterest } =
        useMonthlyPayment(
            offer,
            interestRate,
            duration
        );

    const user = computed(() => page.props.user ?? null);

    const offerUpdatedHandler = (value) => {
        offer.value = value;
    };
</script>
