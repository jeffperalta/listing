<template>
  <Box :key="listing.id">
      <div>
          <Link :href="route('listing.show', {listing: listing.id})">
              <div class="flex flex-row gap-2 items-center">
                  <Price :price="listing.price" class="text-2xl font-bold text-gray-600" />
                  <div class="text-xs text-gray-500">
                      <Price :price="monthlyPayment" /> pm
                  </div>
              </div>
              <ListingSpace :listing="listing" class="text-lg"/>
              <ListingAddress :listing="listing" class="text-gray-500" />
          </Link>
      </div>
      <div class="flex gap-2 mt-2 text-gray-500 dark:text-gray-300 font-light">
          <Link class="hover:font-bold" :href="route('listing.edit', {listing: listing.id})">
              Edit
          </Link>
          <Link class="hover:font-bold cursor-pointer" :href="route('listing.destroy', {listing: listing.id})" method="DELETE">
              Delete
          </Link>
      </div>
  </Box>
</template>

<script setup>
    import { useMonthlyPayment } from '@/Compasables/useMonthlyPayment';
    import { Link } from '@inertiajs/vue3';
    import ListingAddress from '@/Components/ListingAddress.vue'
    import Box from '@/Components/UI/Box.vue';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import Price from '@/Components/Price.vue';


    const props = defineProps({
      listing: Object
    })

    const { monthlyPayment } = useMonthlyPayment(
        props.listing.price,
        2.5,
        25
    );

</script>