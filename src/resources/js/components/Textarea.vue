<template>
  <div>
    <label :for="field" class="field-Label">
      備考<span class="required"></span>
    </label>
    <textarea
      v-model="inputValue"
      :id="field"
      :name="field"
      :placeholder="placeholder"
      rows="3"
      class="field-String"
    ></textarea>
    <ul v-if="isError">
      <li
        v-for="(error, i) in errors[field]"
        :key="`error-${_uid}-${field}-${i}`"
      >
        {{ error }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      default: '',
    },
    field: {
      type: String,
      default: '',
    },
    placeholder: {
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
