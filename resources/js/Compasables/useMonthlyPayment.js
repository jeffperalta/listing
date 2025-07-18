import { computed, isRef } from 'vue';

export const useMonthlyPayment = (principal, interestRate, duration) => {
    const monthlyPayment = computed(() => {
        const rate = (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12;
        const n = (isRef(duration) ? duration.value : duration) * 12;
        return ((isRef(principal) ? principal.value : principal) * rate) / (1 - Math.pow(1 + rate, -n));
    });

    const totalPaid = computed(() => {
        return monthlyPayment.value * (isRef(duration) ? duration.value : duration) * 12;
    });

    const totalInterest = computed(() => {
        return totalPaid.value - (isRef(principal) ? principal.value : principal);
    });

    return { monthlyPayment, totalPaid, totalInterest  };
}