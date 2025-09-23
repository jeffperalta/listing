<!-- resources/js/Layouts/MainLayout.vue -->
<template>
  <div>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">Laravel</Link>
                </div>
                <div v-if="user" class="flex gap-4 items-center">
                    <Link :href="route('notification.index')">
                        <div class="relative">
                            <svg class="w-6 h-6 text-gray-500 hover:text-gray-700 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span v-if="notificationCount > 0" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ notificationCount }}</span>
                        </div>
                    </Link>
                    <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{  user.name  }}</Link>
                    <Link v-if="showCreateListingButton" :href="route('realtor.listing.create')" class="btn-primary">+ New Listing</Link>
                    <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                </div>
                <div v-else class="flex gap-2 items-center">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Login</Link>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess" class="mb-4 border-2 rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
            {{ flashSuccess }}
        </div>
        <slot />
    </main>
  </div>
</template>

<script setup>
    import { computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    const page = usePage()
    const flashSuccess = computed(() => page.props.flash?.success ?? "")
    const user = computed(() => page.props.user ?? null)
    const showCreateListingButton = computed(() => true)
    const notificationCount = computed(() => Math.min(page.props.user.notificationCount, 9))
</script>
