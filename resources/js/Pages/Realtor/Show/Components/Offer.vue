<template>
<Box>
  <template #header>Offers #{{ offer.id }} 
    <span v-if="offer.accepted_at" class="dark:bg-green-800 bg-green-200 text-green-800 dark:text-green-200 px-2 py-1 rounded-md text-xs font-medium uppercase ml-2">
      Accepted
    </span>
    <span v-else-if="offer.rejected_at" class="dark:bg-red-800 bg-red-200 text-red-800 dark:text-red-200 px-2 py-1 rounded-md text-xs font-medium uppercase ml-2">
      Rejected
    </span>
  </template>
  <section class="flex items-center justify-between">
    <div>
      <Price :price="offer.amount" class="text-xl font-bold"/>
      <div class="text-gray-500"> 
        Difference <Price :price="difference" />
      </div>
      <div class="text-gray-500 text-sm"> 
        Made by {{ offer.bidder.name }}
      </div>
      <div class="text-gray-500 text-sm"> 
        Made on {{  madeOn }}
      </div>
    </div>
    <div>
      <Link 
        v-if="!isSold"
        class="btn-outline text-xs font-medium cursor-pointer" 
        as="button" 
        :href="route('realtor.accept.offer', { offer: offer.id })"
        method="put"
      >
        Accept
      </Link>
    </div>
  </section>
</Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue';
import { Link } from '@inertiajs/vue3';
import Price from '@/Components/Price.vue';
import { computed } from 'vue';

const props = defineProps({
  offer: Object,
  listingPrice: Number,
  isSold: Boolean
})

const difference = computed(() => {
  return props.offer.amount - props.listingPrice;
});

const madeOn = computed(() => {
  return new Date(props.offer.created_at).toLocaleDateString();
});

const acceptedOn = computed(() => {
  return new Date(props.offer.accepted_at).toLocaleDateString();
});

const rejectedOn = computed(() => {
  return new Date(props.offer.rejected_at).toLocaleDateString();
});


</script>