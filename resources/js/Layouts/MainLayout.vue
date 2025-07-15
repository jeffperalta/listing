<!-- resources/js/Layouts/MainLayout.vue -->
<template>
  <div>
    <nav>
      <Link href="/">Index</Link> &nbsp;
      <Link href="/show">Show Page</Link> &nbsp;
      <Link href="/listing">Listing Page</Link>
    </nav>
    <div>{{ timer }}</div>
    <slot />
  </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
    import { ref } from 'vue'

    const timer = ref(0)
    setInterval(() => {
      timer.value++
    }, 1000)
</script>
