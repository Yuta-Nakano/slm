<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            商品<span
              class="font-light border-l border-gray-200 pl-2 ml-2 lg:pl-4 lg:ml-4"
              >{{ detail.name }}</span
            >
          </h1>

          <button
            type="button"
            class="button -white mr-4"
            @click.prevent="toggle('showModalBranch')"
          >
            <svg
              class="-ml-1 mr-2 h-5 w-5 text-black"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"
              />
            </svg>
            管理拠点の追加
          </button>

          <router-link
            v-if="detail.num_of_inventores"
            :to="`/product/${productId}/inventory`"
            class="button -white mr-4"
          >
            <svg
              class="-ml-1 mr-2 h-5 w-5 text-black"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
              />
            </svg>
            在庫一覧
          </router-link>

          <router-link to="/product" class="button -white">
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
            商品一覧
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
                    title="Branch"
                    class="h-4 w-4 inline-block"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                      clip-rule="evenodd"
                    />
                  </svg>
                  <span class="text-xs">Branch</span>
                </dt>
                <dd
                  class="border-l border-gray-200 pl-2 ml-2 mr-4 text-sm font-medium text-gray-500"
                >
                  {{ detail.num_of_inventores }}
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
                  商品名
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">{{ detail.name }}</dd>
              </div>
              <div class="col-span-full sm:col-span-4">
                <dt class="text-xs font-medium text-gray-500">
                  商品コード
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">{{ detail.code }}</dd>
              </div>

              <div class="col-span-full">
                <dt class="text-xs font-medium text-gray-500">
                  備考
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.remarks }}
                </dd>
              </div>

              <div class="col-span-full sm:col-span-4">
                <dt class="text-xs font-medium text-gray-500">
                  登録者
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.registrant_user_name }}
                </dd>
              </div>
              <div class="col-span-full sm:col-span-4">
                <dt class="text-xs font-medium text-gray-500">
                  最終更新者
                </dt>
                <dd class="text-lg text-gray-900 sm:mt-1">
                  {{ detail.updated_user_name }}
                </dd>
              </div>
            </dl>
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <router-link
              :to="`/product/${productId}/edit`"
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

          <!-- 管理拠点の追加 -->
          <Modal v-if="showModalBranch" @close="toggle('showModalBranch')">
            <template #content>
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                  <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10"
                  >
                    <svg
                      class="h-6 w-6 text-indigo-600"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"
                      />
                    </svg>
                  </div>
                  <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3
                      class="text-lg leading-6 font-medium text-gray-900"
                      id="modal-headline"
                    >
                      管理拠点の追加
                    </h3>
                    <div class="py-1">
                      <p class="text-sm text-gray-500 mb-4">
                        商品を管理する拠点を選択してください
                      </p>
                      <div
                        v-for="branch in branches"
                        :key="branch.id"
                        class="my-1"
                      >
                        <label>
                          <input
                            v-model="checked"
                            :value="branch.id"
                            type="checkbox"
                            class="mr-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                          />
                          {{ branch.name }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <Pagenation
                :pagenate="pagenate"
                @getSearchResults="getBranchesNotIn"
              />
            </template>

            <template #footer>
              <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
                @click.prevent="setProductToBranches"
              >
                <svg
                  class="-ml-1 mr-2 h-5 w-5 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  />
                </svg>
                保存
              </button>
              <button
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                @click.prevent="toggle('showModalBranch')"
              >
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
                キャンセル
              </button>
            </template>
          </Modal>

          <!-- 削除 -->
          <Modal
            v-if="showModalAlert"
            :options="{ title: `商品: ${detail.name} を削除しますか？` }"
            @close="toggle('showModalAlert')"
          >
            <template #content="{ options }">
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-center">
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
                @click.prevent="destroy"
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
import Modal from '../../../components/Modal'
import Pagenation from '../../../components/Pagenation'
import { RepositoryFactory } from '../../../repositories/repositoryFactory'
const productsRepository = RepositoryFactory.get('products')
const inventoriesRepository = RepositoryFactory.get('inventories')

export default {
  components: {
    Modal,
    Pagenation,
  },
  props: {
    productId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      showModalBranch: false,
      showModalAlert: false,
      detail: [],
      checked: [],
      searchCond: '',
      branches: [],
      pagenate: {
        currentPage: 1,
        lastPage: 1,
        total: 1,
        from: 0,
        to: 0,
      },
    }
  },
  created() {
    this.getDetail()
    this.getBranchesNotIn()
  },
  computed: {
    title() {
      return (this.detail.name || null) + ' | 商品'
    },
    pages() {
      let start = _.max([this.currentPage - 2, 1])
      let end = _.min([start + 5, this.lastPage + 1])
      start = _.max([end - 5, 1])
      return _.range(start, end)
    },
  },
  methods: {
    async getDetail() {
      const { data } = await productsRepository.getProduct(this.productId)
      this.detail = data.product
    },
    async getBranchesNotIn(page) {
      page = page || 1
      const { data } = await axios.get(
        `/api/branch/product/${this.productId}/not-in?search_cond=${this.searchCond}&page=${page}`
      )
      const { current_page, last_page, from, to, total } = data.meta
      this.branches = data.branches
      this.pagenate = {
        currentPage: current_page,
        lastPage: last_page,
        from,
        to,
        total,
      }
    },
    setProductToBranches() {
      const { checked, productId, pagenate } = this
      checked.map(async (k, i) => {
        const fd = new FormData()
        fd.append('product_id', productId)
        fd.append('branch_id', checked[i])
        await inventoriesRepository.createInventory(fd)
        if (i === checked.length - 1) {
          this.getDetail()
          this.getBranchesNotIn(pagenate.currentPage)
          this.toggle('showModalBranch')
        }
      })
    },
    async destroy() {
      const { productId, detail } = this
      const params = new URLSearchParams()
      params.append('code', detail.code)
      params.append('name', detail.name)
      await productsRepository
        .updateProduct(productId, params)
        .then(async () => {
          await productsRepository.destroyProduct(productId)
          this.$router.push({
            name: 'product',
            params: { productId },
          })
        })
    },
    clearSearch() {
      this.searchCond = ''
      this.getBranchesNotIn()
    },
    change(page) {
      page = page || 1
      if (page >= 1 && page <= this.lastPage) this.getBranchesNotIn(page)
    },
  },
  head() {
    return {
      title: this.title,
    }
  },
}
</script>
