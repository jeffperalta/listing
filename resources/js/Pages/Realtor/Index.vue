<template>
  <h1 class="text-3xl font-bold mb-4">Your Listings</h1>
  <section>
    <RealtorFilter :filters="filters" />
  </section>
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <Box 
      v-for="listing in listings" 
      :key="listing.id" 
      class=" p-4 shadow rounded"
      :class="{
        'bg-gray-200 border-gray-400': listing.deleted_at,
        'bg-white': !listing.deleted_at,
      }"
    >
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div>
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium"/>
            <ListingSpace :listing="listing" />
          </div>
          <ListingAddress :listing="listing" class="text-gray-600 mt-2"/>
        </div>
        <div class="flex items-center gap-1 text-gray-600 dark:text-gray-400">
          <!-- <Link class="btn-outline text-xs font-medium">Preview</Link>  
          <Link class="btn-outline text-xs font-medium">Edit</Link>   -->
          <Link 
            v-if="!listing.deleted_at"
            class="btn-outline text-xs font-medium" 
            :href="route('realtor.listing.destroy', { listing: listing.id })"
            as="button"
            method="delete"
          >
            Delete
          </Link>  
        </div>
      </div>
    </Box>
  </section>
</template>

<script setup>
  import Price from '@/Components/Price.vue';
  import ListingSpace from '@/Components/ListingSpace.vue';
  import ListingAddress from '@/Components/ListingAddress.vue';
  import Box from '@/Components/UI/Box.vue';
  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import RealtorFilter from '@/Pages/Realtor/Index/Components/RealtorFilter.vue';

  const props = defineProps({
    listings: Array,
    filters: Object,
  });

</script>