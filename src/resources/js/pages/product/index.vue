<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            商品<span class="font-light border-l border-gray-200 pl-4 ml-4"
              >一覧</span
            >
          </h1>

          <Search
            class="mr-4"
            :value.sync="searchCond"
            placeholder="商品名で検索"
            @getSearchResults="getProducts"
          />

          <router-link to="/product/add" class="button -indigo">
            <svg
              class="-ml-1 mr-2 h-5 w-5 text-white"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
              />
            </svg>
            新規作成
          </router-link>
        </div>
      </header>
    </template>

    <template>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <DataTable :headers="headers" :rows="products">
            <template #tbody-name="{ item }">
              <span class="font-medium text-gray-900">
                {{ item.name }}
              </span>
            </template>
            <template #tbody-action="{ item }">
              <div class="text-right">
                <router-link :to="`/product/${item.id}`" class="link -indigo">
                  詳細
                </router-link>
              </div>
            </template>
          </DataTable>

          <Pagenation :pagenate="pagenate" @getSearchResults="getProducts" />
        </div>
      </div>
    </template>
  </DefaultLayout>
</template>

<script>
import Search from '../../components/Search'
import DataTable from '../../components/DataTable'
import Pagenation from '../../components/Pagenation'
import { RepositoryFactory } from '../../repositories/repositoryFactory'
const productsRepository = RepositoryFactory.get('products')

export default {
  components: {
    Search,
    DataTable,
    Pagenation,
  },
  data() {
    return {
      searchCond: '',
      products: [],
      headers: [
        {
          label: '商品名',
          content: 'name',
        },
        {
          label: '商品コード',
          content: 'code',
        },
        // {
        //   label: '備考',
        // },
        {
          label: '登録者',
          content: 'registrant_user_name',
          class: ['hidden', 'sm:table-cell'],
        },
        {
          label: '最終更新者',
          content: 'updated_user_name',
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
    this.getProducts()
  },
  methods: {
    async getProducts(page = 1) {
      const { data } = await productsRepository.get(page, this.searchCond)
      const { current_page, last_page, from, to, total } = data.meta
      this.products = data.products
      this.pagenate = {
        currentPage: current_page,
        lastPage: last_page,
        from,
        to,
        total,
      }
    },
  },
  head: {
    title: '商品一覧',
  },
}
</script>
