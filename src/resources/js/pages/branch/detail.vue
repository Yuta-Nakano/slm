<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            拠点<span class="font-light border-l border-gray-200 pl-4 ml-4">{{
              detail.name
            }}</span>
          </h1>

          <router-link to="/branch" class="button -white">
            <svg
              class="-ml-1 mr-2 h-5 w-5 text-black"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"
              />
            </svg>
            拠点一覧
          </router-link>
        </div>
      </header>
    </template>

    <template>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <div class="px-4 py-5 bg-gray-50 border-b border-gray-100">
            <dl class="flex justify-end">
              <div class="flex items-center">
                <dt class="text-indigo-600 flex items-center">
                  <svg
                    title="Product"
                    class="h-4 w-4 inline-block"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="text-xs">Product</span>
                </dt>
                <dd
                  class="border-l border-gray-200 pl-2 ml-2 mr-4 text-sm font-medium text-gray-500"
                >
                  {{ detail.num_of_product }}
                </dd>
              </div>
              <div class="flex items-center">
                <dt class="text-indigo-600 flex items-center">
                  <svg
                    title="Stock"
                    class="h-4 w-4 inline-block"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                    />
                  </svg>
                  <span class="text-xs">Stock</span>
                </dt>
                <dd
                  class="border-l border-gray-200 pl-2 ml-2 mr-4 text-sm font-medium text-gray-500"
                >
                  {{ detail.num_of_stock }}
                </dd>
              </div>
            </dl>
          </div>
          <div class="px-4 py-5 bg-white">
            <dl class="grid grid-cols-8 gap-6">
              <div class="col-span-full sm:col-span-4">
                <dt class="text-xs font-medium text-gray-500">
                  拠点名
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.name }}
                </dd>
              </div>
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  担当者名
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.charge_name }}
                </dd>
              </div>
              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  電話番号
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.phone_number }}
                </dd>
              </div>
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  郵便番号
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.postal_code }}
                </dd>
              </div>
              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  都道府県
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.prefecture }}
                </dd>
              </div>
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <div class="col-span-full sm:col-span-4">
                <dt class="text-xs font-medium text-gray-500">
                  市区町村
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.municipality }}
                </dd>
              </div>
              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  番地
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.address }}
                </dd>
              </div>
              <div class="col-span-full sm:col-span-2">
                <dt class="text-xs font-medium text-gray-500">
                  建物・部屋番号
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.building }}
                </dd>
              </div>

              <div class="col-span-full mb-4">
                <dt class="text-xs font-medium text-gray-500">
                  備考
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.remarks }}
                </dd>
              </div>
            </dl>
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <router-link
              :to="`/branch/${branchId}/edit`"
              class="button -indigo"
            >
              <svg
                class="-ml-1 mr-2 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                />
              </svg>
              編集する
            </router-link>
            <button
              v-if="detail.can_delete"
              type="button"
              class="button -red"
              :class="{ 'disabled:opacity-50': !detail.can_delete }"
              :disabled="!detail.can_delete"
              @click.prevent="toggle('showModalAlert')"
            >
              <svg
                class="-ml-1 mr-2 h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"
                />
              </svg>
              削除
            </button>
          </div>

          <!-- 削除 -->
          <Modal
            v-if="showModalAlert"
            :options="{ title: `拠点: ${detail.name} を削除しますか？` }"
            @close="toggle('showModalAlert')"
          >
            <template #content="{ options }">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start sm:items-center">
                  <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                  >
                    <!-- Heroicon name: exclamation -->
                    <svg
                      class="h-6 w-6 text-red-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                      />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3
                      class="text-lg leading-6 font-medium text-gray-900"
                      id="modal-headline"
                    >
                      {{ options && options.title }}
                    </h3>
                  </div>
                </div>
              </div>
            </template>

            <template #footer>
              <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                @click.prevent="destroy()"
              >
                削除
              </button>
              <button
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                @click.prevent="toggle('showModalAlert')"
              >
                キャンセル
              </button>
            </template>
          </Modal>
        </div>
      </div>
    </template>
  </DefaultLayout>
</template>

<script>
import Modal from '../../components/Modal'
import { RepositoryFactory } from '../../repositories/repositoryFactory'
const branchesRepository = RepositoryFactory.get('branches')

export default {
  components: {
    Modal,
  },
  props: {
    branchId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      showDeleteTooltip: false,
      showModalAlert: false,
      detail: [],
    }
  },
  computed: {
    title() {
      if (this.detail && this.detail.name) {
        return this.detail.name
      }
      return null
    },
  },
  created() {
    this.getDetail()
  },
  computed: {
    title() {
      return (this.detail.name || null) + ' | 拠点'
    },
  },
  methods: {
    async getDetail() {
      const { data } = await branchesRepository.getBranch(this.branchId)
      this.detail = data.branch
    },
    async destroy() {
      const { branchId, detail } = this
      const params = new URLSearchParams()
      Object.keys(detail).map(k => params.append(k, detail[k]))
      await branchesRepository.updateBranch(branchId, params).then(async () => {
        /**
         * TODO: Error処理をどうするか
         * - そもそもインベントリーが存在する場合には削除ボタンが押せない
         */
        await branchesRepository.destroyBranch(branchId)
        this.$router.push({
          name: 'branch',
          params: { branchId },
        })
      })
    },
  },
  head() {
    return {
      title: this.title,
    }
  },
}
</script>
