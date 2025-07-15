<template>
  <div>
    Hello {{ counter }}! {{ name }}
  </div>
</template>

<script setup>
  import {ref} from 'vue';

  defineProps({
    name: String,
  });

  const counter = ref(0)
  setInterval(() => {
    counter.value++
  }, 1000);
</script>

