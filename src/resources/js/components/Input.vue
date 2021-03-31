<template>
  <div>
    <label :for="field" class="field-Label">
      {{ label }}
      <svg
        v-if="required"
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
    <input
      v-model="inputValue"
      :id="field"
      :name="field"
      :autocomplete="field"
      type="text"
      class="field-String"
    />
    <ul v-if="isError" class="field-Error">
      <li
        v-for="(error, i) in errors[field]"
        :key="`error-${_uid}-${field}-${i}`"
        class="field-Error_Item"
      >
        {{ error }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    required: {
      type: Boolean,
      default: false,
    },
    label: {
      type: String,
      default: '',
    },
    field: {
      type: String,
      default: '',
    },
    value: {
      type: String,
      default: '',
    },
    errors: {
      type: Object,
      default: () => {},
    },
  },
  computed: {
    isError() {
      const { field, errors } = this
      if (field && errors[field] && errors[field].length) {
        return true
      }
      return false
    },
    inputValue: {
      get() {
        return this.value
      },
      set(value) {
        this.$emit('update:value', value)
      },
    },
  },
}
</script>
