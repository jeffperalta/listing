<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-6 md:col-span-2">
        <label class="label">Beds</label>
        <input class="input" type="text" v-model.number="form.beds" />
        <InputError v-if="form.errors.beds" :message="form.errors.beds" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <label class="label">Baths</label>
        <input class="block w-full p-3 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" type="text" v-model.number="form.baths"/>
        <InputError v-if="form.errors.baths" :message="form.errors.baths" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <label class="label">Area</label>
        <input class="input" type="text" v-model.number="form.area"/>
        <InputError v-if="form.errors.area" :message="form.errors.area" />
      </div>

      <div class="col-span-6 md:col-span-4">
        <label class="label">City</label>
        <input class="input" type="text" v-model="form.city"/>
        <InputError v-if="form.errors.city" :message="form.errors.city" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <label class="label">Post Code</label>
        <input class="input" type="text" v-model="form.code"/>
        <InputError v-if="form.errors.code" :message="form.errors.code" />
      </div>

      <div class="col-span-6 md:col-span-4">
        <label class="label">Street</label>
        <input class="input" type="text" v-model="form.street"/>
        <InputError v-if="form.errors.street" :message="form.errors.street" />
      </div>

      <div class="col-span-6 md:col-span-2">
        <label class="label">Street Nr</label>
        <input class="input" type="text" v-model="form.street_nr"/>
        <InputError v-if="form.errors.street_nr" :message="form.errors.street_nr" />
      </div>

      <div class="col-span-6">
        <label class="label">Price</label>
        <input class="input" type="text" v-model.number="form.price"/>
        <InputError v-if="form.errors.price" :message="form.errors.price" />
      </div>

      <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
      </div>
    </div>
  </form>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3'
  import InputError from '../../Components/UI/InputError.vue';

  const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: '',
    code: '',
    street: '',
    street_nr: '',
    price: 0
  })

  const create = () => form.post(route('realtor.listing.store'))

</script>
