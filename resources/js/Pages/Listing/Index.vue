<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
    </div>
    <div v-if="listings.data.length" class="mt-8 mb-8 w-full flex justify-center">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
    import Listing from '@/Pages/Listing/Index/Components/Listing.vue';
    import Pagination from '@/Components/UI/Pagination.vue';
    import Filters from '@/Pages/Listing/Index/Components/Filters.vue';

    defineProps({
        listings: Object,
        filters: Object
    })
</script>
