<template>
  <Box>
    <template #header>Upload New Images</template>
    <form @submit.prevent="upload">
      <section class="flex items-center gap-2 mb-4">
        <input type="hidden" name="_token" :value="csrf">
        <input type="file" class="w-lg border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4" multiple @input="addFiles" />
        <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
        <button type="reset" @click="reset" class="btn-outline">Reset</button>
      </section>
    </form>
  </Box>
  <Box v-if="listing.images.length" class="mt-4">
    <template #header>Images</template>
    <section class="grid grid-cols-2 gap-4">
      <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
        <img :src="image.src" class="w-full h-auto rounded-md" />
        <Link 
          :href="route('realtor.listing.image.destroy', {listing: props.listing.id, image: image.id})" 
          method="delete" as="button" class="mt-2 btn-outline btn-danger"
        >
        Remove
      </Link>
      </div>
    </section>
  </Box>
</template>

<script setup>
  import { ref, computed } from 'vue';
  import Box from '@/Components/UI/Box.vue';
  import { useForm, Link } from '@inertiajs/vue3';
  import { Inertia } from '@inertiajs/inertia';
  import NProgress from 'nprogress';

  const csrf = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

  const props = defineProps({
    listing: Object
  });

  Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
      NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
  });

  const form = useForm({
    _token: csrf,
    images: []
  })

  const canUpload = computed(() => form.images.length > 0);

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