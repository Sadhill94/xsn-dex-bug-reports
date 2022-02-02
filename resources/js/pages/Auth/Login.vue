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
        <div class="relative inline-flex items-center mt-12">
          <div class="flex items-center h-6">
            <input
              id="remember"
              name="remember"
              type="checkbox"
              :value="credentials.remember"
              v-model="credentials.remember"
              class="focus:ring-primary h-6 w-6 bg-quaternary text-quaternary border-primary rounded"
            />
          </div>
          <div class="min-w-0 ml-6">
            <label
              for="remember"
              class="uppercase font-medium select-none text-body-md"
              >Remember me</label
            >
          </div>
        </div>
      </div>
      <div class="text-center mt-16">
        <button @click="handleSubmit" class="btn btn--quaternary">
          Submit
        </button>
      </div>
    </div>
    <div class="text-center mt-20 md:mt-32">
      <Link class="btn btn--quaternary" href="/"> Back to home </Link>
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
        remember: false,
      },
    };
  },

  mounted() {
    if (JSON.parse(localStorage.getItem('sdx-remember-me'))) {
      this.credentials.remember = true;
    }
  },

  watch: {
    'credentials.remember'(newValue) {
      if (newValue) {
        localStorage.setItem('sdx-remember-me', true);
      } else {
        localStorage.setItem('sdx-remember-me', false);
      }
    },
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
