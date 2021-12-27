<template>
  <app-layout>
    <section
      class="flex flex-col justify-center items-center absolute inset-0 brand-container brand-container--lg"
    >
      <h1 class="uppercase tracking-widest font-bold">404</h1>
      <h2 class="uppercase tracking-widest text-center mt-4 leading-normal">
        The page/stuff you were looking doesn't seems to exist anymore
      </h2>
      <a href="/" class="mt-12 py-4 px-8 bg-quaternary rounded-md uppercase"
        >Back to home</a
      >
    </section>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';

export default {
  name: 'index',
  components: { AppLayout },
};
</script>
