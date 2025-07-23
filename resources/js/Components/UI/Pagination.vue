<template>
  <div class="flex gap-1">
    <Link
      v-for="(link, index) in links" :key="index"
      :href="link.url ?? ''"
      :class="{
        'px-4 py-2 rounded-md': true,
        'bg-indigo-500 dark:bg-indigo-800 text-gray-300 hover:underline': link.active,
        'text-gray-500': !link.active
      }"
      v-html="link.label" 
      :aria-label="link.label"
    >
    </Link>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  links: Array
});
</script>