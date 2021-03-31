<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="page-header">
          <h1 class="page-title">
            拠点<span class="font-light border-l border-gray-200 pl-4 ml-4"
              >編集</span
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
                label="拠点名"
              />
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <Input
                :value.sync="form.charge_name"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-2"
                field="charge_name"
                label="担当者名"
              />
              <Input
                :value.sync="form.phone_number"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-2"
                field="phone_number"
                label="電話番号"
              />
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <Input
                :value.sync="form.postal_code"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-2"
                field="postal_code"
                label="郵便番号"
              />
              <div class="col-span-full sm:col-span-2">
                <label for="prefecture" class="field-Label">
                  都道府県
                  <svg
                    class="h-4 w-4 text-red-400 inline -mt-0.5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"
                    />
                  </svg>
                </label>
                <select
                  v-model="form.prefecture"
                  name="prefecture"
                  id="prefecture"
                  class="field-Select"
                >
                  <option value="">都道府県を選択</option>
                  <option
                    v-for="_prefecture in prefectures"
                    :key="`${_uid}-${_prefecture}`"
                    :value="_prefecture"
                  >
                    {{ _prefecture }}
                  </option>
                </select>
                <ul
                  v-if="
                    errors &&
                      errors['prefecture'] &&
                      errors['prefecture'].length
                  "
                  class="field-Error"
                >
                  <li
                    v-for="(error, i) in errors['prefecture']"
                    class="field-Error_Item"
                    :key="`error-${_uid}-${'prefecture'}-${i}`"
                  >
                    {{ error }}
                  </li>
                </ul>
              </div>
              <div class="hidden sm:block sm:col-span-4"><!-- spacer --></div>

              <Input
                :value.sync="form.municipality"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-4"
                field="municipality"
                label="市区町村"
              />
              <Input
                :value.sync="form.address"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-2"
                field="address"
                label="番地"
              />
              <Input
                :value.sync="form.building"
                :required="true"
                :errors="errors"
                class="col-span-full sm:col-span-2"
                field="building"
                label="建物・部屋番号"
              />

              <Textarea
                :value.sync="form.remarks"
                :required="true"
                :errors="errors"
                class="col-span-full mb-4"
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
const branchesRepository = RepositoryFactory.get('branches')
const prefecturesRepository = RepositoryFactory.get('prefectures')

export default {
  components: {
    Input,
    Textarea,
  },
  props: {
    branchId: {
      type: [Number, String],
      required: true,
    },
  },
  data() {
    return {
      prefectures: [],
      form: {
        name: '',
        postal_code: '',
        prefecture: '',
        municipality: '',
        address: '',
        building: '',
        charge_name: '',
        phone_number: '',
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
  created() {
    this.getPrefectures()
    this.getDetail()
  },
  methods: {
    async getPrefectures() {
      const { data } = await prefecturesRepository.get()
      this.prefectures = data.prefectures
    },
    async getDetail() {
      const { form, branchId } = this
      const { data } = await branchesRepository.getBranch(branchId)
      Object.keys(form).map(k => (form[k] = data.branch[k]))
    },
    async save() {
      const { form, branchId } = this
      const params = new URLSearchParams()
      Object.keys(form).map(k => params.append(k, form[k]))
      await branchesRepository
        .updateBranch(branchId, params)
        .then(({ data }) => {
          this.$router.push(`/branch/${data.branch.id}`)
        })
        .catch(({ response }) => {
          this.errors = response.data.errors
        })
    },
  },
  head: {
    title: '拠点編集 | 商品',
  },
}
</script>
