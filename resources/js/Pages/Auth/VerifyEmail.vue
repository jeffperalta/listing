<template>
  <div class="flex flex-col justify-center items-center">
    <div>You need to be verified first to see this</div>
    <div>
      <Link 
        :href="route('verification.send')"
        method="post"
        as="button"
        class="text-indigo-600 dark:text-indigo-400 "
      >
        Resend verification email
      </Link>
    </div>
  </div>
  
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>