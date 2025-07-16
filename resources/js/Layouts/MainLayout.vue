<!-- resources/js/Layouts/MainLayout.vue -->
<template>
  <div>
    <nav class="main-nav">
      <Link href="/listing">Listings</Link>
      <Link href="/listing/create">New Listing</Link>
    </nav>
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot />
  </div>
</template>

<script setup>
    import { computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    const page = usePage()
    const flashSuccess = computed(() => page.props.flash?.success ?? "")
</script>

<style scope>
    .success {
        padding: 10px;
        border: 2px solid darkgreen;
        background-color: green;
        color: white;
        border-radius: 5px;
        margin: 10px 5px;
    }

    .main-nav {
        min-height: 30px;
        a {
            margin: 2px;
            border: 1px solid black;
            border-radius: 5px 5px 0 0;
            padding: 5px;
        }
    }
</style>
