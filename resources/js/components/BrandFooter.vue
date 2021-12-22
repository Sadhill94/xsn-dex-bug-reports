<template>
  <footer class="bg-secondary" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>

    <div class="brand-container brand-container--xxl">
      <div class="py-12 px-4 sm:px-6 lg:py-32 xl:py-38 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
          <!-- Footer first part -->
          <div class="hidden xl:block space-y-4 xl:col-span-1 self-center">
            <p class="text-gray-400 mb-0">Enjoyed your visit ?</p>
            <p class="text-gray-400 pr-12">
              If you want to support the lost soul (named Sadhill), that made
              this website :
            </p>
            <p class="text-gray-400">
              XSN:
              <button
                class="hover:text-white transition-colors duration-200"
                @click="copyAddress"
              >
                {{ xsnAddress }}
              </button>
            </p>
          </div>

          <!-- Footer links -->
          <div
            class="md:mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 xl:mt-0 xl:col-span-2"
          >
            <div
              class="sm:grid sm:grid-cols-2 md:gap-8 col-span-1 md:col-span-2"
            >
              <div>
                <h3 class="font-semibold tracking-wider uppercase">Socials</h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="social in socialsUntil(0, 3)" :key="social.url">
                    <footer-link :href="social.url">
                      {{ social.name }}
                    </footer-link>
                  </li>
                </ul>
              </div>
              <div>
                <h3 class="hidden sm:block invisible">Socials</h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="social in socialsUntil(4, 7)" :key="social.url">
                    <footer-link :href="social.url">
                      {{ social.name }}
                    </footer-link>
                  </li>
                </ul>
              </div>
            </div>

            <div class="md:grid md:grid-cols-1 md:gap-8 col-span-1">
              <div class="mt-4 md:mt-0">
                <h3 class="font-semibold tracking-wider uppercase">Legal</h3>
                <ul role="list" class="mt-4 space-y-4">
                  <li v-for="legal in legals" :key="legal.url">
                    <footer-link :href="legal.url">
                      {{ legal.name }}
                    </footer-link>
                  </li>
                </ul>
              </div>
            </div>

            <!-- First part for < xl-->
            <div class="xl:hidden md:col-span-3 space-y-4 md:mt-6">
              <p class="text-gray-400 mb-0">Enjoyed your visit ?</p>
              <p class="text-gray-400 max-w-lg sm:max-w-3xl md:max-w-7xl">
                If you want to support the lost soul (named Sadhill), that made
                this website :
              </p>
              <p class="text-gray-400">
                XSN:
                <button
                  class="hover:text-white transition-colors duration-200"
                  @click="copyAddress"
                >
                  {{ xsnAddress }}
                </button>
              </p>
            </div>
          </div>
        </div>

        <div class="mt-12 border-t border-gray-400 pt-8">
          <p class="text-gray-400 xl:text-center">
            &copy; {{ new Date().getFullYear() }} Stakenet community. All rights
            reserved.
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
import { SOCIALS, LEGALS } from '@/constant/footerLinks';
import FooterLink from '@/components/FooterLink';
import { POSITION } from 'vue-toastification';

const XSN_ADDRESS = '7T7spTX1K7KjZWDnDs4QrUKDJ1nHRTVQgM';

export default {
  name: 'BrandFooter',
  components: { FooterLink },
  computed: {
    socials() {
      return SOCIALS;
    },
    legals() {
      return LEGALS;
    },
    xsnAddress() {
      return XSN_ADDRESS;
    },
  },
  methods: {
    socialsUntil(fromIndex, toIndex) {
      return this.socials.filter(
        (link, index) => index >= fromIndex && index <= toIndex
      );
    },
    copyAddress() {
      navigator.clipboard.writeText(XSN_ADDRESS);
      this.$displayNotification({
        message: 'Copied to clipboard!',
      });
    },
  },
};
</script>
