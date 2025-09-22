<template>
  <h1 class="text-3xl font-bold mb-4">Your Listings</h1>
  <section>
    <RealtorFilter :filters="filters" />
  </section>
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <Box 
      v-for="listing in listings.data" 
      :key="listing.id" 
      class=" p-4 shadow rounded"
      :class="{
        'bg-gray-200 border-gray-400 border-dashed': listing.deleted_at,
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
        <section>
          <div class="flex items-center gap-1 text-gray-600 dark:text-gray-400">
            <a class="btn-outline text-xs font-medium" 
              :href="route('listing.show', { listing: listing.id })"
              target="_blank"
              v-if="!listing.deleted_at" 
            >Preview</a>  
            <Link class="btn-outline text-xs font-medium"
              :href="route('realtor.listing.edit', { listing: listing.id })"
            >Edit</Link>
            <Link 
              class="btn-outline text-xs font-medium" 
              :href="route('realtor.listing.destroy', { listing: listing.id })"
              as="button"
              method="delete"
              v-if="!listing.deleted_at"
            >
              Delete
            </Link>  
            <Link 
              class="btn-outline text-xs font-medium" 
              :href="route('realtor.listing.restore', { listing: listing.id })"
              as="button"
              method="put"
              v-else
            >
              Restore
            </Link>  
          </div>
          <div class="mt-2">
            <Link 
              :href="route('realtor.listing.image.create', { listing: listing.id })"
              class="block w-full btn-outline text-xs font-medium text-center"
            >Images ({{ listing.images_count }})</Link>
          </div>
          <div class="mt-2">
            <Link 
              :href="route('realtor.listing.show', { listing: listing.id })"
              class="block w-full btn-outline text-xs font-medium text-center"
            >Offers ({{ listing.offers_count }})</Link>
          </div>
        </section>
        
      </div>
    </Box>
  </section>
  <div v-if="listings.data.length" class="mt-8 mb-8 w-full flex justify-center">
      <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
  import Price from '@/Components/Price.vue';
  import ListingSpace from '@/Components/ListingSpace.vue';
  import ListingAddress from '@/Components/ListingAddress.vue';
  import Box from '@/Components/UI/Box.vue';
  import { defineProps } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import RealtorFilter from '@/Pages/Realtor/Index/Components/RealtorFilter.vue';
  import Pagination from '@/Components/UI/Pagination.vue';

  const props = defineProps({
    listings: Object,
    filters: Object,
  });

</script>