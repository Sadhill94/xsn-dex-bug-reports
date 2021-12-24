<template>
  <app-layout>
    <section class="issue-page brand-container brand-container--xxl">
      <div class="issue">
        <div class="header">
          <div class="informations">
            <h3>#32 Issue Information</h3>
            <dl class="status">
              <div>
                <dt>Status</dt>
                <dd><span>IN PROGRESS</span></dd>
              </div>
            </dl>
          </div>
        </div>
        <div class="body">
          <div class="details">
            <!-- FIRST ROWS -->
            <div class="details-row">
              <dl>
                <div class="details-column">
                  <dt>Bug category</dt>
                  <dd>
                    <span>LND</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Dex version</dt>
                  <dd>
                    <span>0.4.4.0</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Short description</dt>
                  <dd>
                    <span>Margot Foster</span>
                  </dd>
                </div>
              </dl>
            </div>

            <!-- SECOND ROWS-->
            <div class="details-row">
              <dl>
                <div class="details-column">
                  <dt>Operating system</dt>
                  <dd>
                    <span>Windows 11</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Assignee</dt>
                  <dd>
                    <span>Margot Foster</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Reported by</dt>
                  <dd>
                    <span>Sadhill#5749</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Github link</dt>
                  <dd>
                    <span>
                      <a
                        href="https://dex-bug-reports.stakenet.info/manager/dashboard"
                        target="_blank"
                      >
                        View
                      </a></span
                    >
                  </dd>
                </div>
              </dl>
            </div>
          </div>

          <div class="rich-contents">
            <dl class="rich-contents-row">
              <div class="rich-contents-column">
                <dt>Steps to reproduce</dt>
                <dd>
                  <span>
                    Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim
                    incididunt cillum culpa consequat. Excepteur qui ipsum
                    <br />
                    aliquip consequat sint. Sit id mollit nulla mollit nostrud
                    in ea officia proident. Irure nostrud pariatur mollit ad
                    <br />
                    adipisicing reprehenderit deserunt qui eu. Fugiat ipsum
                    ipsum deserunt culpa aute sint do nostrud anim incididunt
                    cillum culpa consequat. Excepteur qui ipsum aliquip
                    consequat sint. Sit id mollit nulla mollit nostrud in ea
                    officia proident. Irure nostrud pariatur mollit ad
                    adipisicing reprehenderit deserunt qui eu.
                  </span>
                </dd>
              </div>
              <div class="rich-contents-column">
                <dt>Extra infos</dt>
                <dd>
                  <span>
                    Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim
                  </span>
                </dd>
              </div>
            </dl>
          </div>

          <!--        <div class="mt-5 border-t border-gray-200">-->
          <!--          <dl class="divide-y divide-gray-200">-->
          <!--            <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">-->
          <!--              <dt class="text-sm font-medium text-gray-500">-->
          <!--                Salary expectation-->
          <!--              </dt>-->
          <!--              <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">-->
          <!--                <span class="flex-grow"> $120,000</span>-->
          <!--                <span class="ml-4 flex-shrink-0">-->
          <!--                  <button-->
          <!--                    type="button"-->
          <!--                    class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                  >-->
          <!--                    Update-->
          <!--                  </button>-->
          <!--                </span>-->
          <!--              </dd>-->
          <!--            </div>-->
          <!--            <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">-->
          <!--              <dt class="text-sm font-medium text-gray-500">About</dt>-->
          <!--              <dd class="mt-1 flex text-sm text-gray-900 sm:mt-0 sm:col-span-2">-->
          <!--                <span class="flex-grow">-->
          <!--                  Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim-->
          <!--                  incididunt cillum culpa consequat. Excepteur qui ipsum aliquip-->
          <!--                  consequat sint. Sit id mollit nulla mollit nostrud in ea-->
          <!--                  officia proident. Irure nostrud pariatur mollit ad adipisicing-->
          <!--                  reprehenderit deserunt qui eu.-->
          <!--                </span>-->
          <!--                <span class="ml-4 flex-shrink-0">-->
          <!--                  <button-->
          <!--                    type="button"-->
          <!--                    class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                  >-->
          <!--                    Update-->
          <!--                  </button>-->
          <!--                </span>-->
          <!--              </dd>-->
          <!--            </div>-->
          <!--            <div class="py-4 sm:grid sm:py-5 sm:grid-cols-3 sm:gap-4">-->
          <!--              <dt class="text-sm font-medium text-gray-500">Attachments</dt>-->
          <!--              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">-->
          <!--                <ul-->
          <!--                  role="list"-->
          <!--                  class="border border-gray-200 rounded-md divide-y divide-gray-200"-->
          <!--                >-->
          <!--                  <li-->
          <!--                    class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"-->
          <!--                  >-->
          <!--                    <div class="w-0 flex-1 flex items-center">-->
          <!--                      &lt;!&ndash; Heroicon name: solid/paper-clip &ndash;&gt;-->
          <!--                      <svg-->
          <!--                        class="flex-shrink-0 h-5 w-5 text-gray-400"-->
          <!--                        xmlns="http://www.w3.org/2000/svg"-->
          <!--                        viewBox="0 0 20 20"-->
          <!--                        fill="currentColor"-->
          <!--                        aria-hidden="true"-->
          <!--                      >-->
          <!--                        <path-->
          <!--                          fill-rule="evenodd"-->
          <!--                          d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"-->
          <!--                          clip-rule="evenodd"-->
          <!--                        />-->
          <!--                      </svg>-->
          <!--                      <span class="ml-2 flex-1 w-0 truncate">-->
          <!--                        resume_back_end_developer.pdf-->
          <!--                      </span>-->
          <!--                    </div>-->
          <!--                    <div class="ml-4 flex-shrink-0 flex space-x-4">-->
          <!--                      <button-->
          <!--                        type="button"-->
          <!--                        class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                      >-->
          <!--                        Update-->
          <!--                      </button>-->
          <!--                      <span class="text-gray-300" aria-hidden="true">|</span>-->
          <!--                      <button-->
          <!--                        type="button"-->
          <!--                        class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                      >-->
          <!--                        Remove-->
          <!--                      </button>-->
          <!--                    </div>-->
          <!--                  </li>-->
          <!--                  <li-->
          <!--                    class="pl-3 pr-4 py-3 flex items-center justify-between text-sm"-->
          <!--                  >-->
          <!--                    <div class="w-0 flex-1 flex items-center">-->
          <!--                      &lt;!&ndash; Heroicon name: solid/paper-clip &ndash;&gt;-->
          <!--                      <svg-->
          <!--                        class="flex-shrink-0 h-5 w-5 text-gray-400"-->
          <!--                        xmlns="http://www.w3.org/2000/svg"-->
          <!--                        viewBox="0 0 20 20"-->
          <!--                        fill="currentColor"-->
          <!--                        aria-hidden="true"-->
          <!--                      >-->
          <!--                        <path-->
          <!--                          fill-rule="evenodd"-->
          <!--                          d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"-->
          <!--                          clip-rule="evenodd"-->
          <!--                        />-->
          <!--                      </svg>-->
          <!--                      <span class="ml-2 flex-1 w-0 truncate">-->
          <!--                        coverletter_back_end_developer.pdf-->
          <!--                      </span>-->
          <!--                    </div>-->
          <!--                    <div class="ml-4 flex-shrink-0 flex space-x-4">-->
          <!--                      <button-->
          <!--                        type="button"-->
          <!--                        class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                      >-->
          <!--                        Update-->
          <!--                      </button>-->
          <!--                      <span class="text-gray-300" aria-hidden="true">|</span>-->
          <!--                      <button-->
          <!--                        type="button"-->
          <!--                        class="bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
          <!--                      >-->
          <!--                        Remove-->
          <!--                      </button>-->
          <!--                    </div>-->
          <!--                  </li>-->
          <!--                </ul>-->
          <!--              </dd>-->
          <!--            </div>-->
          <!--          </dl>-->
          <!--        </div>-->
        </div>
        <div class="actions">actions</div>
      </div>
    </section>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';
import '../../../scss/base/typography.scss';

export default {
  name: 'index',
  components: { AppLayout },
  props: {
    issue: {
      type: Object,
      default: null,
    },
  },
  mounted() {
    console.log('this.data', this.issue);
  },
};
</script>
<style lang="scss">
.issue-page {
  .issue {
    @apply bg-secondary p-10 rounded-md;

    @screen lg {
      @apply p-20;
    }
    .header {
      .informations {
        @screen lg {
          @apply w-full flex flex-row justify-between items-center;
        }
      }

      .status {
        @apply border-b border-gray-200 py-6;
        dd {
          @apply uppercase;
        }

        @screen lg {
          @apply border-b-0 py-0;
          dt {
            @apply hidden;
          }
          dd {
            @apply p-3 bg-quaternary rounded-md font-semibold;
          }
        }
        @screen lg {
          dd {
            @apply p-5;
          }
        }
      }
    }

    .body {
      @screen lg {
        @apply mt-12;
      }
      .details {
        @apply flex flex-col items-center w-full divide-y divide-gray-200;

        @screen lg {
          @apply flex-row justify-between items-start divide-y-0;
        }

        .details-row {
          @apply w-full;

          @screen lg {
            @apply w-1/2 max-w-5xl;
          }

          &:first-child {
            @screen lg {
              @apply pr-12;
            }
            @screen xl {
              @apply pr-24;
            }
          }
          &:last-child {
            @screen lg {
              @apply pl-12;
            }
            @screen xl {
              @apply pl-24;
            }
          }

          dl {
            @apply divide-y divide-gray-200;
          }
        }

        .details-column {
          @apply py-6;

          @screen lg {
            @apply py-4;
          }

          dt {
            @apply mb-3;
            @screen lg {
              @apply mb-0;
            }
          }
          dd {
            @apply mt-1 flex mb-0;

            span {
              @apply flex-grow;

              a {
                @apply font-normal border-b;

                &:hover {
                  @apply text-quaternary border-quaternary;
                }
              }
            }

            @screen sm {
              @apply mt-0 col-span-2;
            }
          }

          @screen lg {
            @apply py-5 grid grid-cols-3 gap-4;
          }
        }
      }

      .rich-contents {
        @apply mt-2;

        @screen lg {
          @apply mt-8;
        }
        .rich-contents-row {
          @apply flex flex-col-reverse;
          @screen lg {
            @apply flex-row;
          }
        }

        .rich-contents-column {
          @apply w-full;

          @screen lg {
            @apply w-1/2;
          }

          &:first-child {
            @apply mt-8;
            @screen lg {
              @apply pr-12 mt-0;
            }
            @screen xl {
              @apply pr-24;
            }
          }
          &:last-child {
            @screen lg {
              @apply pl-12;
            }
            @screen xl {
              @apply pl-24;
            }
          }
          dt {
            //@apply h6;
          }
          dd {
            @apply max-w-7xl;
          }
        }
      }
    }
  }
}
</style>
