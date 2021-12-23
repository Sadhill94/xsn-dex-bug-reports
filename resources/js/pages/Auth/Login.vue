<template>
  <section class="min-h-screen flex flex-col items-center justify-center p-12">
    <div v-show="Object.keys(errors).length > 0" class="mb-24">
      <ul class="space-y-4">
        <li v-for="(err, index) in errors" :key="index" class="text-red-600 h5">
          {{ err }}
        </li>
      </ul>
    </div>
    <div
      class="p-20 rounded-lg bg-secondary w-full max-w-5xl shadow-lg ring-tertiary ring-1"
    >
      <h1 class="h2">Login</h1>
      <div class="mt-16 flex flex-col w-full">
        <div>
          <label class="h5" for="username">Username</label>
          <input
            v-model="credentials.username"
            type="text"
            class="input max-w-full"
          />
        </div>
        <div class="mt-12">
          <label class="h5" for="password">Password</label>
          <input
            v-model="credentials.password"
            type="password"
            class="input max-w-full"
          />
        </div>
      </div>
      <div class="text-center mt-16">
        <button @click="handleSubmit" class="btn btn--quaternary">
          Submit
        </button>
      </div>
    </div>
    <div class="text-center mt-20 md:mt-32">
      <Link class="btn btn--tertiary" href="/"> Back to home </Link>
    </div>
  </section>
</template>

<script>
export default {
  name: 'index',
  props: ['errors'],
  data() {
    return {
      credentials: {
        username: '',
        password: '',
      },
    };
  },
  methods: {
    handleSubmit() {
      try {
        this.$inertia.post(this.route('login'), this.credentials);
      } catch (err) {
        alert('err');
      }
    },
  },
};
</script>
<style lang="scss" scoped>
input {
  @apply mt-2;
}
</style>
