<template>
  <form 
    method="POST" 
    :action="route('realtor.listing.image.store', {listing: listing.id})"
    enctype="multipart/form-data"
  >
    <input type="hidden" name="_token" :value="csrf">
    <input type="file" class="input" multiple name="images[]" />
    <button type="submit">Send</button>
  </form>
</template>

<script setup>
  import { ref } from 'vue';

  defineProps({
    listing: Object
  });

  const csrf = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

</script>