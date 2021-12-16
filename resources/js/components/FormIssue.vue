<template>
  <section class="mt-16">
    <form class="divide-gray-400">
      <div class="space-y-8 divide-y divide-gray-400 sm:space-y-5">
        <div>
          <div>
            <h2>Form</h2>
            <p class="mt-1 max-w-2xl text-white">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut
            </p>
          </div>

          <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
            <form-row>
              <template slot="label">Short Description</template>
              <template slot="inputs">
                <input
                  type="text"
                  v-model="formFieldsValues.description"
                  class="input"
                />
              </template>
            </form-row>

            <form-row>
              <template slot="label">Bug category</template>
              <template slot="inputs">
                <brand-select
                  :options="categories"
                  class="input"
                  @change="formFieldsValues.category_id = $event"
                />
              </template>
            </form-row>

            <form-row>
              <template slot="label">Operating system</template>
              <template slot="inputs">
                <brand-select
                  :options="osOptions"
                  class="input"
                  @change="formFieldsValues.os = $event"
                />
              </template>
            </form-row>

            <form-row>
              <template slot="label">DEX version</template>
              <template slot="inputs">
                <input
                  type="text"
                  v-model="formFieldsValues.version"
                  class="input"
                />
              </template>
            </form-row>

            <form-row>
              <template slot="label">Steps to reproduce</template>
              <template slot="inputs">
                <textarea
                  name="about"
                  rows="8"
                  class="input"
                  v-model="formFieldsValues.steps_to_reproduce"
                ></textarea>
              </template>
            </form-row>

            <form-row>
              <template slot="label">Discord username</template>
              <template slot="inputs">
                <input
                  type="text"
                  v-model="formFieldsValues.user_discord_id"
                  class="input"
                />
              </template>
            </form-row>

            <form-row>
              <template slot="label">Extra infos</template>
              <template slot="inputs">
                <textarea
                  name="about"
                  rows="8"
                  class="input"
                  v-model="formFieldsValues.extra_infos"
                ></textarea>
              </template>
            </form-row>
          </div>
        </div>
      </div>

      <div class="pt-12 text-center">
        <button type="submit" class="btn btn--tertiary">Submit</button>
      </div>
    </form>
  </section>
</template>

<script>
import FormRow from '@/components/FormRow';
import BrandSelect from '@/components/BrandSelect';

export default {
  name: 'FormIssue',
  components: { BrandSelect, FormRow },
  props: {
    categories: {
      type: Array,
      default: () => [],
    },
    isOnPublicPage: {
      type: Boolean,
      default: true,
    },
    issue: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      formFieldsValues: {
        description: '',
        category_id: '',
        os: 'Windows',
        version: '',
        steps_to_reproduce: '',
        user_discord_id: '',
        extra_infos: '',
        status_id: '',
        github_link: '',
      },
    };
  },
  computed: {
    osOptions() {
      return [
        {
          name: 'Windows',
        },
        {
          name: 'MacOs',
        },
        {
          name: 'Linux',
        },
      ];
    },
  },
  mounted() {
    if (this.issue) {
      this.formFieldsValues = this.issue;
    }
  },
};
</script>
