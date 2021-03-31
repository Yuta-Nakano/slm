<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            商品<span class="font-light border-l border-gray-200 pl-4 ml-4"
              >新規作成</span
            >
          </h1>
        </div>
      </header>
    </template>

    <template>
      <div class="page-content">
        <div class="sm:px-0 shadow overflow-hidden rounded-md">
          <div class="px-4 py-5 bg-white">
            <div class="grid grid-cols-8 gap-6">
              <Input
                :value.sync="form.name"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-4"
                field="name"
                label="商品名"
              />
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <Input
                :value.sync="form.code"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-4"
                field="code"
                label="商品コード"
              />
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <Textarea
                :value.sync="form.remarks"
                :required="true"
                :errors="errors"
                class="col-span-full"
                field="remarks"
                label="備考"
              />
            </div>
          </div>

          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button
              type="button"
              class="button -white"
              @click.prevent="$router.back()"
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
              戻る
            </button>
            <button
              type="button"
              class="button -indigo"
              @click.prevent="save()"
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
          </div>
        </div>
      </div>
    </template>
  </DefaultLayout>
</template>

<script>
import Input from '../../components/Input'
import Textarea from '../../components/Textarea'
import { RepositoryFactory } from '../../repositories/repositoryFactory'
const productsRepository = RepositoryFactory.get('products')

export default {
  components: {
    Input,
    Textarea,
  },
  data() {
    return {
      form: {
        code: '',
        name: '',
        remarks: '',
      },
      errors: {
        name: [],
        postal_code: [],
        prefecture: [],
        municipality: [],
        address: [],
        building: [],
        charge_name: [],
        phone_number: [],
        remarks: [],
      },
    }
  },
  methods: {
    async save() {
      const fd = new FormData()
      Object.keys(this.form).map(k => fd.append(k, this.form[k]))
      await productsRepository
        .createProduct(fd)
        .then(({ data }) => {
          this.$router.push(`/product/${data.product.id}`)
        })
        .catch(({ response }) => {
          this.errors = response.data.errors
        })
    },
  },
  head: {
    title: '新規作成 | 商品',
  },
}
</script>

<style lang="sass">
.select
  appearance: none
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e")
  background-position: right 0.5rem center
  background-repeat: no-repeat
  background-size: 1.5em 1.5em
  padding-right: 2.5rem
  -webkit-print-color-adjust: exact
  color-adjust: exact
  @apply text-sm w-full py-0 px-3 mt-1 border border-gray-300 bg-white rounded-md h-10
  &:focus
    @apply outline-none border-blue-300

@mixin enter
  @apply transition ease-out duration-100
@mixin leave
  @apply transition ease-out duration-75
.scale-enter-active
  @include enter
  @apply transform opacity-0 scale-95
.scale-enter-to
  @include enter
  @apply transform opacity-100 scale-100
.scale-leave-active
  @include leave
  @apply transform opacity-100 scale-100
.scale-leave-to
  @include leave
  @apply transform opacity-0 scale-95
</style>
