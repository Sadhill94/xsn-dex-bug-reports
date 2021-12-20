<template>
  <section class="mt-16">
    <form class="divide-gray-400" @submit.prevent="handleSubmit">
      <div class="space-y-8 divide-y divide-gray-400 sm:space-y-5">
        <div>
          <div>
            <h2>Report</h2>
            <slot name="form-header">
              <p class="mt-1 max-w-2xl text-white">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut
              </p>
            </slot>
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
                >{{ field.label }} {{ field.isRequired ? '*' : '' }}</template
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
                  :value="formFieldsValues[field.key]"
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
        <button type="submit" class="btn btn--tertiary">
          {{ method === FORM_METHODS.create ? 'Submit' : 'Save changes' }}
          <span v-show="isLoading">in progress...</span>
        </button>
      </div>
    </form>
  </section>
</template>

<script>
import axios from 'axios';
import _ from 'lodash';

import FormRow from '@/components/FormRow';
import BrandSelect from '@/components/BrandSelect';

import {
  CATEGORY_ID_FIELD_KEY,
  DEFAULT_FORM_FIELDS_VALUES,
  FORM_METHODS,
  PRIVATE_BUG_FORM_FIELDS,
  REPORT_BUG_FORM_FIELDS,
  STATUS_ID_FIELD_KEY,
} from '@/constant/form';
import { ROUTES } from '@/constant/routes';

export default {
  name: 'FormIssue',

  components: { BrandSelect, FormRow },

  props: {
    categories: {
      type: Array,
      default: () => [],
    },

    statuses: {
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

    method: {
      type: String,
      default: FORM_METHODS.create,
    },
  },

  data() {
    return {
      formFields: [],
      fieldsWithErrors: [],
      formFieldsValues: {},
      isLoading: false,
    };
  },

  mounted() {
    this.formFields = REPORT_BUG_FORM_FIELDS;

    if (!this.isOnPublicPage && this.issue) {
      this.formFields = [...PRIVATE_BUG_FORM_FIELDS, ...this.formFields];
      this.formFieldsValues = this.issue;
      this.setCategoriesOptions();
      this.setStatusesOptions();
    } else {
      this.resetFormValues();
    }
  },

  computed: {
    FORM_METHODS() {
      return FORM_METHODS;
    },
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
     * Handler for the submit process.
     * Validate / submit to backend / display error notification
     */
    handleSubmit() {
      this.validateFieldsAndSetErrors();

      if (this.fieldsWithErrors.length === 0) {
        this.isLoading = true;
        axios
          .post(`${ROUTES.issues.url}/${this.method}`, this.formFieldsValues)
          .then((res) => {
            this.$displayNotification({
              message:
                res?.data?.message || 'Thanks for your bug report submission !',
              type: 'success',
            });

            if (this.method === FORM_METHODS.create) {
              this.resetFormValues();
            }
          })
          .catch((err) => {
            this.$displayNotification({
              message:
                err?.response?.data?.message ||
                'Something went wrong, please notify @Sadhill in the discord.',
              type: 'error',
            });
          })
          .finally(() => {
            this.isLoading = false;
          });
      } else {
        this.$displayNotification({
          message: 'All fields marked by an * are mandatory',
          type: 'error',
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
        if (
          field.isRequired &&
          _.isEmpty(this.formFieldsValues[field.key]?.trim())
        ) {
          fieldsWithErrors.push(field.key);
        }
      });
      this.fieldsWithErrors = fieldsWithErrors;
    },

    hasError(field) {
      return this.fieldsWithErrors.includes(field);
    },

    /**
     * Set or reset the form field values to the default state
     */
    resetFormValues() {
      this.formFieldsValues = _.cloneDeep(DEFAULT_FORM_FIELDS_VALUES);
      this.setCategoriesOptions();
      this.setDefaultCategory();
    },

    /**
     * Set categories options for form field category (SWAP;CONNEXT;LND;...)
     */
    setStatusesOptions() {
      this.formFields = this.formFields.map((x) => {
        if (x.key === STATUS_ID_FIELD_KEY) {
          return { ...x, options: this.statuses };
        }
        return x;
      });
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
    },

    setDefaultCategory() {
      // eslint-disable-next-line camelcase
      if (this.issue) {
        // eslint-disable-next-line camelcase
        this.formFieldsValues.category_id = this.issue.category_id;
      } else {
        // eslint-disable-next-line camelcase
        this.formFieldsValues.category_id = this.categories[0].id.toString();
      }
    },
  },
};
</script>
