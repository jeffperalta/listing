<template>
    <div v-for="listing in listings" :key="listing.id" class="listing--container">
        <div>
            [<Link :href="route('listing.edit', {listing: listing.id})">
                Edit
            </Link>]
        </div>
        <div>
            [<Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE">
                Delete
            </Link>]
        </div>
        <div>
            <Link :href="route('listing.show', {listing: listing.id})">
                <ListingAddress :listing="listing" />
            </Link>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import ListingAddress from '@/Components/ListingAddress.vue'
    defineProps({
        listings: Array
    })
</script>

<style scope>
    .listing--container {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }
</style>
