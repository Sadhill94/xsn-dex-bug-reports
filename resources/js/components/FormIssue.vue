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
              :additional-infos="field.additionalInfos"
              :class="
                field.isRequired && hasError(field.key) ? 'has-error' : ''
              "
            >
              <template slot="label"
                >{{ field.label }} {{ field.isRequired ? '*' : '' }}
              </template>
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
                  @onChange="formFieldsValues[field.key] = $event.toString()"
                />

                <div v-else-if="field.type === 'files'" class="w-full">
                  <file-uploader
                    :has-submitted="hasSubmitted"
                    @onFilesChange="formFieldsValues[field.key] = $event"
                  />
                </div>

                <input
                  v-else
                  v-model="formFieldsValues[field.key]"
                  type="text"
                  class="input"
                />
              </template>
            </form-row>
          </div>
        </div>
      </div>

      <div class="pt-12 text-center">
        <button
          type="submit"
          class="btn btn--tertiary"
          :class="isLoading && 'cursor-not-allowed'"
          :disabled="isLoading"
        >
          Submit
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
  DEX_WALLET_GITHUB_REPO_URL,
  FILES_FIELD_KEY,
  REPORT_BUG_FORM_FIELDS,
  STATUS_ID_FIELD_KEY,
  VERSION_FIELD_KEY,
} from '@/constant/form';

import { ROUTES } from '@/constant/routes';
import FileUploader from '@/components/FileUploader';

export default {
  name: 'FormIssue',

  components: { BrandSelect, FileUploader, FormRow },

  props: {
    categories: {
      type: Array,
      default: () => [],
    },

    statuses: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      formFields: [],
      fieldsWithErrors: [],
      formFieldsValues: {},
      isLoading: false,
      hasSubmitted: false,
    };
  },

  mounted() {
    this.getLatestDexVersion();
    this.formFields = REPORT_BUG_FORM_FIELDS;
    this.resetFormValues();
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

    issue: {
      deep: true,
      handler(val) {
        if (val) {
          this.formFieldsValues = _.cloneDeep(val);
        } else {
          this.resetFormValues();
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
        const url = `${ROUTES.issues.url}/create`;
        const formData = this.setToFormData();
        const headers = {
          'Content-Type': 'multipart/form-data',
        };

        this.submitForm(url, formData, headers);
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
        if (field.isRequired) {
          if (field.key === FILES_FIELD_KEY) {
            if (this.formFieldsValues[field.key].length < 1) {
              fieldsWithErrors.push(field.key);
            }
          } else {
            if (_.isEmpty(this.formFieldsValues[field.key]?.trim())) {
              fieldsWithErrors.push(field.key);
            }
          }
        }
      });
      this.fieldsWithErrors = fieldsWithErrors;
    },

    hasError(field) {
      return this.fieldsWithErrors.includes(field);
    },

    /**
     *  Handler to transfer the formFieldsValues object into a formData
     *  Since we pass files to the server, we must create a FormData and the file case is
     *  very specific to handle
     * @returns {FormData}
     */
    setToFormData() {
      const data = new FormData();
      Object.keys(this.formFieldsValues).forEach((field) => {
        if (field === FILES_FIELD_KEY) {
          this.formFieldsValues[field].forEach((fileRecord, i) => {
            data.append(`files[${i}]`, fileRecord.file);
          });
        } else {
          data.append(field, this.formFieldsValues[field]);
        }
      });
      return data;
    },

    /**
     *  Handler to dispatch the http request
     * @param url - endpoint
     * @param data - FormData
     * @param headers - To allow multipart
     */
    submitForm(url, data, headers) {
      this.isLoading = true;
      axios
        .post(url, data, headers)
        .then((res) => {
          this.$displayNotification({
            message:
              res?.data?.message || 'Thanks for your bug report submission !',
            type: 'success',
          });

          // ux detail
          this.hasSubmitted = true;
          setTimeout(() => {
            this.resetFormValues();
          }, 600);
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
          // ux detail
          setTimeout(() => {
            this.isLoading = false;
          }, 1000);
        });
    },

    /**
     * Set the form field values to the default state and fill the options
     */
    resetFormValues() {
      this.formFieldsValues = _.cloneDeep(DEFAULT_FORM_FIELDS_VALUES);
      this.setCategoriesOptions();
      this.setDefaultCategory();
      this.hasSubmitted = false;
    },

    /**
     * Fill the options property of the status field in the formFields
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
     * Fill the options property of the category field in the formFields
     */
    setCategoriesOptions() {
      this.formFields = this.formFields.map((x) => {
        if (x.key === CATEGORY_ID_FIELD_KEY) {
          return { ...x, options: this.categories };
        }
        return x;
      });
    },

    /**
     * Set the default category visible on the select
     * If we have an issue as props, we display the issue category id
     * Otherwise the select the first value in the array of categories as default
     */
    setDefaultCategory() {
      if (this.issue) {
        this.formFieldsValues.category_id = this.issue.category_id;
      } else {
        this.formFieldsValues.category_id = this.categories[0].id.toString();
      }
    },

    async getLatestDexVersion() {
      axios.get(DEX_WALLET_GITHUB_REPO_URL).then((res) => {
        this.setLastDexVersionValueAndAsAdditionalInfos(
          res.data[0]?.tag_name || 'unknown'
        );
      });
    },

    setLastDexVersionValueAndAsAdditionalInfos(dexVersionAdditionalInfo) {
      // set additional info for dex version
      this.formFields = this.formFields.map((field) => {
        if (field.key === VERSION_FIELD_KEY) {
          const additionalInfos = [`Latest: ${dexVersionAdditionalInfo}`];
          return { ...field, additionalInfos };
        }
        return field;
      });

      // fill the default value for dex version if we are on the create mode only
      Object.keys(this.formFieldsValues).forEach((fieldKey) => {
        if (fieldKey === VERSION_FIELD_KEY) {
          this.formFieldsValues[fieldKey] = dexVersionAdditionalInfo;
        }
      });
    },
  },
};
</script>
