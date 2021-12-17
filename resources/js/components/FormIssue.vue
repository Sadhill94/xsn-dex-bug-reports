<template>
  <section class="mt-16">
    <form class="divide-gray-400" @submit.prevent="handleSubmit">
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
            <form-row
              v-for="field in formFields"
              :key="field.key"
              class="form-group"
              :class="
                field.isRequired && hasError(field.key) ? 'has-error' : ''
              "
            >
              <template slot="label"
                >{{ field.label }} {{ field.isRequired && '*' }}</template
              >
              <template slot="inputs">
                <textarea
                  v-if="field.type === 'textarea'"
                  rows="8"
                  class="input"
                  v-model="formFieldsValues[field.key]"
                ></textarea>

                <brand-select
                  v-else-if="field.type === 'select'"
                  :options="field.options"
                  class="input"
                  @change="formFieldsValues[field.key] = $event.toString()"
                />
                <input
                  v-else
                  type="text"
                  v-model="formFieldsValues[field.key]"
                  class="input"
                />
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
import { POSITION } from 'vue-toastification';

import FormRow from '@/components/FormRow';
import BrandSelect from '@/components/BrandSelect';

import { CATEGORY_ID_FIELD_KEY, REPORT_BUG_FORM_FIELDS } from '@/constant/form';

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
      formFields: [],
      fieldsWithErrors: [],
      /* eslint-disable */
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
      /* eslint-enable */
    };
  },

  mounted() {
    this.buildForm();
    this.formFields = REPORT_BUG_FORM_FIELDS;
    if (this.issue) {
      this.formFieldsValues = this.issue;
    }
    this.setCategoriesOptions();
  },

  watch: {
    /**
     * Handler to call the set categories options for form field category in the case the props came after the mounted
     */
    categories: {
      deep: true,
      handler(val) {
        if (val.length > 0) {
          this.setCategoriesOptions();
        }
      },
    },
  },
  methods: {
    /**
     * TODO UPDATE DOC
     * Set the form fields from the constant to allow dynamic data to be filled in (eg: the categories )
     */
    buildForm() {
      this.formFields = REPORT_BUG_FORM_FIELDS;
      if (this.issue) {
        this.formFieldsValues = this.issue;
      }
      this.setCategoriesOptions();
    },

    /**
     * Handler for the submit process.
     * Validate / submit to backend / display error notification
     */
    handleSubmit() {
      this.validateFieldsAndSetErrors();

      if (this.fieldsWithErrors.length === 0) {
        // TODO submit
      } else {
        this.$toast('All fields marked by an * are mandatory', {
          timeout: 1500,
          type: 'error',
          position: POSITION.TOP_CENTER,
          toastClassName: 'xsn-toast',
          closeButton: false,
          hideProgressBar: true,
        });
      }
    },

    /**
     * Handler that loop through all formFields and verify the required one have values.
     * Set fieldsWithErrors data property with the result of the loop
     */
    validateFieldsAndSetErrors() {
      const fieldsWithErrors = [];
      this.formFields.forEach((field) => {
        if (field.isRequired && !this.formFieldsValues[field.key].trim()) {
          fieldsWithErrors.push(field.key);
        }
      });
      this.fieldsWithErrors = fieldsWithErrors;
    },

    hasError(field) {
      return this.fieldsWithErrors.includes(field);
    },

    /**
     * Set categories options for form field category (SWAP;CONNEXT;LND;...)
     */
    setCategoriesOptions() {
      this.formFields = this.formFields.map((x) => {
        if (x.key === CATEGORY_ID_FIELD_KEY) {
          return { ...x, options: this.categories };
        }
        return x;
      });
      // eslint-disable-next-line camelcase
      this.formFieldsValues.category_id = this.categories[0].id.toString();
    },
  },
};
</script>
