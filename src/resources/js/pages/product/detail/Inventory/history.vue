<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            入出庫履歴
            <span class="font-light border-l border-gray-200 pl-4 ml-4">{{
              branchName
            }}</span>
            <span class="font-light border-l border-gray-200 pl-4 ml-4">{{
              productName
            }}</span>
          </h1>

          <router-link
            :to="`/product/${productId}/inventory/`"
            class="button -white"
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
            在庫一覧
          </router-link>
        </div>
      </header>
    </template>

    <template>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <DataTable :headers="headers" :rows="histories">
            <!-- <template #tbody-in="{ item }">
                  {{ item.stock && item.stock || 0 }} 個
              </template>
              <template #tbody-out="{ item }">
                  {{ item.stock && item.stock || 0 }} 個
              </template> -->
            <!-- <template #tbody-stock="{ item }">
                  {{ item.stock && item.stock || 0 }} 個
              </template> -->
          </DataTable>

          <Pagenation :pagenate="pagenate" @getSearchResults="getHistories" />
        </div>
      </div>
    </template>
  </DefaultLayout>
</template>

<script>
import DataTable from '../../../../components/DataTable'
import Pagenation from '../../../../components/Pagenation'
import { RepositoryFactory } from '../../../../repositories/repositoryFactory'
const branchesRepository = RepositoryFactory.get('branches')
const productsRepository = RepositoryFactory.get('products')
const stocksRepository = RepositoryFactory.get('stocks')

export default {
  components: {
    DataTable,
    Pagenation,
  },
  props: {
    branchId: {
      type: [Number, String],
      required: true,
    },
    productId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      branchName: '',
      productName: '',
      product: [],
      histories: [],
      headers: [
        // {
        //   label: 'ID',
        //   content: 'id',
        // },
        {
          label: '入庫数',
          content: 'in',
        },
        {
          label: '出庫数',
          content: 'out',
        },
        {
          label: '在庫数',
          content: 'total',
        },
        {
          label: '更新日',
          content: 'update_at',
        },
        {
          label: 'ユーザー',
          content: 'updated_user_name',
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
    this.getBranch()
    this.getProduct()
    this.getHistories()
  },
  computed: {
    title() {
      return [this.productName, this.branchName, '入出庫履歴'].join(' | ')
    },
  },
  methods: {
    async getBranch() {
      const { data } = await branchesRepository.getBranch(this.branchId)
      this.branchName = data.branch.name
    },
    async getProduct() {
      const { data } = await productsRepository.getProduct(this.productId)
      this.productName = data.product.name
    },
    async getHistories(page = 1) {
      const { data } = await stocksRepository.getHistory(
        page,
        this.branchId,
        this.productId
      )
      const { current_page, last_page, from, to, total } = data.meta

      this.histories = data.data
      this.pagenate = {
        currentPage: current_page,
        lastPage: last_page,
        from,
        to,
        total,
      }
    },
  },
  head() {
    return {
      title: this.title,
    }
  },
}
</script>
