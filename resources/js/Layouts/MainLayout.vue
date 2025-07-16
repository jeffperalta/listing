<!-- resources/js/Layouts/MainLayout.vue -->
<template>
  <div>
    <nav>
      <Link href="/">Index</Link> &nbsp;
      <Link href="/show">Show Page</Link> &nbsp;
      <Link href="/listing">Listing Page</Link>
    </nav>
    <!--<div>{{ timer }}</div>-->
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot />
  </div>
</template>

<script setup>
    import { computed } from 'vue'
    import { Link, usePage } from '@inertiajs/vue3'
    // import { ref } from 'vue'
    // const timer = ref(0)
    // setInterval(() => {
    //  timer.value++
    //}, 1000)

    const page = usePage()
    const flashSuccess = computed(() => page.props.flash?.success ?? "")
</script>

<style scope>
    .success {
        background-color: green;
        color: white;
    }
</style>
