<template>
  <form>
    <div class="flex flex-wrap gap-4 mb-4 mt-4">
      <div class="flex flex-nowrap items-center gap-2">
        <input 
          v-model="state.drafts"
          type="checkbox" 
          id="drafts" 
          name="drafts" 
          value="1" 
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
        />
        <label for="drafts" class="text-sm">Show Drafts</label>
        <input 
          v-model="state.deleted"
          type="checkbox" 
          id="deleted" 
          name="deleted" 
          value="1" 
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
        />
        <label for="deleted" class="text-sm">Show Deleted</label>
      </div>

      <div>
        <select v-model="state.by" class="input-filter-l w-30" name="by" id="by">
          <option value="price">Price</option>
          <option value="created_at">Added</option>
        </select>
        <select v-model="state.order" class="input-filter-r w-40" name="order" id="order">
           <option 
            v-for="option in sortOptions" 
            :key="option.value" 
            :value="option.value"
          >
            {{ option.text }}
          </option>
        </select>
      </div>
    </div>
  </form>
</template>

<script setup>
  import { computed, reactive, watch } from 'vue';  
  import { Inertia } from '@inertiajs/inertia';
  import { debounce } from 'lodash';

  const sortLabels = {
    price: [
      { value: 'asc', text: 'Cheapest' },
      { value: 'desc', text: 'Pricey' }
    ],
    created_at: [
      { value: 'asc', text: 'Earliest' },
      { value: 'desc', text: 'Latest' }
    ],
    other: [
      { value: 'asc', text: 'Ascending' },
      { value: 'desc', text: 'Descending' }
    ]
  }

  const props = defineProps({
    filters: Object,
  });

  const state = reactive({
    drafts: props.filters.drafts ?? false,
    deleted: props.filters.deleted ?? false,
    by: props.filters.by ?? '',
    order: props.filters.order ?? '',
  });

  const sortOptions = computed(() => {
    return sortLabels[state.by] || sortLabels['other'];
  });

  watch(
    state, 
    debounce(() => {
      Inertia.get(
        route('realtor.listing.index'), 
        state, 
        { 
          preserveState: true, 
          preserveScroll: true
        }
      );
    }, 1000)
  );

</script>