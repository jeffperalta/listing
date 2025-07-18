import { computed, isRef } from 'vue';

export const useMonthlyPayment = (principal, interestRate, duration) => {
    const monthlyPayment = computed(() => {
        const rate = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12;
        const n = (isRef(duration) ? duration.value : duration) * 12;
        return (principal * rate) / (1 - Math.pow(1 + rate, -n));
    });
    return { monthlyPayment };
}