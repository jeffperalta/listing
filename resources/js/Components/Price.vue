vue
<template>
    <span>{{ formattedPrice }}</span>
</template>

<script>
export default {
    props: {
        price: {
            type: [Number, String],
            required: true
        }
    },
    computed: {
        formattedPrice() {
            const value = parseFloat(this.price);
            if (isNaN(value)) {
                return this.price; 
            }

            return new Intl.NumberFormat('en-AU', {
                style: 'currency',
                currency: 'AUD'
            }).format(value);
        }
    }
}
</script>