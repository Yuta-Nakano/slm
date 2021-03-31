<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            在庫一覧
            <span class="font-light border-l border-gray-200 pl-4 ml-4">{{
              product.name
            }}</span>
          </h1>

          <router-link :to="`/product/${productId}`" class="button -white">
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
            商品詳細
          </router-link>
        </div>
      </header>
    </template>

    <template>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <DataTable
            :headers="headers"
            :rows="inventories"
            @changeStock="changeStock"
          >
            <template #tbody-stock="{ item }">
              <span class="font-medium text-gray-900">
                {{ (item.stock && item.stock.total) || 0 }} 個
              </span>
            </template>

            <template #tbody-action-stock="{ item }">
              <input
                :ref="`input-stock-${item.branchId}`"
                type="text"
                size="4"
                class="align-bottom shadow-sm inline-block sm:text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="0"
              />
              <button
                class="button -indigo sm:px-2"
                @click.prevent="changeStock('in', item)"
              >
                <svg
                  class="h-5 w-5 text-white"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
              <button
                class="button -white sm:px-2"
                @click.prevent="changeStock('out', item)"
              >
                <svg
                  class="h-5 w-5 text-gray-700"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </template>

            <template #tbody-action="{ item }">
              <div class="text-right">
                <router-link
                  :to="`/product/${productId}/branch/${item.branchId}/history`"
                  class="link -indigo"
                >
                  履歴
                </router-link>
                <span
                  v-if="
                    item.stock === null ||
                      (item.stock && item.stock.total === 0)
                  "
                  class="border-l border-gray-200 pl-2 ml-2"
                >
                  <button
                    type="button"
                    class="link -red"
                    @click.prevent="
                      toggle('showModalAlert'), (modalOption = item)
                    "
                  >
                    削除
                  </button>
                </span>
              </div>
            </template>
          </DataTable>

          <Pagenation :pagenate="pagenate" @getSearchResults="getInventories" />
        </div>

        <!-- 削除 -->
        <Modal
          v-if="showModalAlert"
          :options="{ title: `拠点: ${modalOption.name} を削除しますか？` }"
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
              @click.prevent="destroy(modalOption.id)"
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
    </template>
  </DefaultLayout>
</template>

<script>
import DataTable from '../../../../components/DataTable'
import Pagenation from '../../../../components/Pagenation'
import Modal from '../../../../components/Modal'
import { RepositoryFactory } from '../../../../repositories/repositoryFactory'
const productsRepository = RepositoryFactory.get('products')
const stocksRepository = RepositoryFactory.get('stocks')
const inventoriesRepository = RepositoryFactory.get('inventories')

export default {
  components: {
    DataTable,
    Pagenation,
    Modal,
  },
  props: {
    productId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      showModalAlert: false,
      modalOptions: {},
      searchCond: '',
      product: [],
      inventories: [],
      headers: [
        {
          label: '拠点',
          content: 'name',
        },
        {
          label: '在庫数',
          content: 'stock',
        },
        {
          label: '',
          content: 'action-stock',
        },
        {
          label: '',
          content: 'action',
        },
      ],
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
    this.getProduct()
    this.getInventories()
  },
  computed: {
    title() {
      return (this.product.name || null) + ' | 在庫一覧'
    },
  },
  methods: {
    async destroy(id) {
      await inventoriesRepository.destroyInventory(id)
      this.getInventories(this.pagenate.currentPage)
      this.toggle('showModalAlert')
    },
    async getProduct() {
      const { data } = await productsRepository.getProduct(this.productId)
      this.product = data.product
    },
    async getInventories(page = 1) {
      const { data } = await inventoriesRepository.getInProduct(
        page,
        this.productId
      )
      const { current_page, last_page, from, to, total } = data.meta
      this.inventories = data.inventories
      this.pagenate = {
        currentPage: current_page,
        lastPage: last_page,
        from,
        to,
        total,
      }
    },
    async changeStock(formula, item) {
      const { inventories, $refs } = this
      const index = inventories.findIndex(elm => elm.branchId === item.branchId)
      const value = $refs[`input-stock-${item.branchId}`].value - 0 || 0
      if (!value) return

      const fd = new FormData()
      fd.append('product_id', item.productId)
      fd.append('branch_id', item.branchId)
      fd.append(formula, value)
      item.stock && fd.append('total', item.stock.total)

      const { data } = await stocksRepository.createStock(fd)
      inventories[index].stock = data.stock
    },
  },
  head() {
    return {
      title: this.title,
    }
  },
}
</script>
