<template>
  <Box>
    <template #header>Upload New Images</template>
    <form @submit.prevent="upload">
      <div class="mb-4">
        <input type="hidden" name="_token" :value="csrf">
        <input type="file" class="input" multiple @input="addFiles" />
      </div>
      <div class="flex gap-2">
        <button type="submit" class="btn-outline">Upload</button>
        <button type="reset" @click="reset" class="btn-outline">Reset</button>
      </div>
    </form>
  </Box>
</template>

<script setup>
  import { ref } from 'vue';
  import Box from '@/Components/UI/Box.vue';
  import { useForm } from '@inertiajs/vue3';
  const csrf = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

  const props = defineProps({
    listing: Object
  });

  const form = useForm({
    _token: csrf,
    images: []
  })

  const upload = () => {
    form.post(
      route('realtor.listing.image.store', {listing: props.listing.id}),
      { onSuccess: reset }
    );
  }

  const addFiles = (event) => {
    for(const image of event.target.files) {
      form.images.push(image);
    }
  }

  const reset = () => {
    form.reset('images');
  }
  
</script>