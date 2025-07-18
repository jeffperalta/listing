<template>
  <div class="input-error">{{ message }}</div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  message: String
})
</script>
