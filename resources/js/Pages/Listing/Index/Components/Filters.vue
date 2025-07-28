<template>
  <form @submit.prevent="filter" @reset="reset">
    <div class="mb-9 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input v-model="filterForm.priceFrom" type="text" class="input input-filter-l w-30" placeholder="Price from"/>
        <input v-model="filterForm.priceTo" type="text" class="input input-filter-r w-30" placeholder="Price to"/>
      </div>
      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.beds" class="input input-filter-l w-25">
          <option value="null">Beds</option>
          <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
          <option value="6+">6+</option>
        </select>
         <select v-model="filterForm.baths" class="input input-filter-r w-25">
          <option value="null">Baths</option>
          <option v-for="i in 5" :key="i" :value="i">{{ i }}</option>
          <option value="6+">6+</option>
        </select>
      </div>
      <div class="flex flex-nowrap items-center">
        <input v-model="filterForm.minArea" type="text" class="input input-filter-l w-30" placeholder="Min Area"/>
        <input v-model="filterForm.maxArea" type="text" class="input input-filter-r w-30" placeholder="Max Area"/>
      </div>
      <button type="submit" class="btn btn-normal">Search</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  filters: Object
});

const filterForm = useForm({
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
  beds: props.filters.beds ?? null,
  baths: props.filters.baths ?? null,
  minArea: props.filters.minArea ?? null,
  maxArea: props.filters.maxArea ?? null
});

const filter = () => {
  filterForm.get(route('listing.index'), {
    preserveState: true,
    preserveScroll: true
  });
};

const reset = () => {
  filterForm.priceFrom = null;
  filterForm.priceTo = null;
  filterForm.beds = null;
  filterForm.baths = null;
  filterForm.minArea = null;
  filterForm.maxArea = null;
  filter()
};

</script>