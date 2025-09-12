<script setup>
import Box from "@/Components/UI/Box.vue";
import Price from "@/Components/Price.vue";
import { useForm } from '@inertiajs/vue3'
import {computed} from "vue";

const props = defineProps({
    listingId: Number,
    price: Number,
})

const form = useForm({
    amount: props.price
})

const difference = computed(() => {
    return form.amount - props.price
})

const max = computed(() => {
    return props.price * 2;
})

const min = computed(() => {
    return props.price / 2;
})

</script>

<template>
    <Box>
        <template #header>Make an Offer</template>
        <div>
            <form>
                <input v-model.number="form.amount"
                       type="text" class="input" placeholder="Make an Offer" />
                <input
                    v-model.number="form.amount"
                    type="range" :min="min" :max="max" step="10000"
                    class="mt-2 w-full h-4 bg-gray-200
                        rounded-lg appearance-none cursor-pointer
                        dark:bg-gray-700"
                />
                <button type="submit" class="btn btn-outline w-full text-sm">
                    Make an Offer
                </button>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<style scoped>

</style>
