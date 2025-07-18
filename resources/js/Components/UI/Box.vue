<template>
  <div class="border border-gray-200 dark:order-gray-800 rounded-md shadow-sm p-4 dark:text-gray-300">
    <div class="text-gray-500 font-medium mb-4">
      <slot name="header"></slot>
    </div>
    <slot />
  </div>
</template>

<script>
  export default {
    name: 'Box',
    props: {
      // Define your props here
    }
  }
</script>
