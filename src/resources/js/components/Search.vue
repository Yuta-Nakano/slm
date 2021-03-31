<template>
  <div class="searh-Search flex item-center rounded-md overflow-hidden">
    <input
      ref="search"
      type="text"
      class="search-Search_Input"
      v-model="inputSearchCond"
      :placeholder="placeholder"
      @keyup.enter="getSearchResults"
    />
    <transition name="-fade">
      <button
        v-if="value.length"
        type="button"
        class="searh-Search_Cancel"
        @click.prevent="clearSearch"
      >
        <svg
          class="h-5 w-5 text-gray-600"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
            clip-rule="evenodd"
          />
        </svg>
      </button>
    </transition>
    <button
      type="button"
      class="search-Search_Submit"
      @click.prevent="getSearchResults"
    >
      <svg
        class="h-5 w-5 text-black"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
          clip-rule="evenodd"
        />
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      searchCond: '',
    }
  },
  computed: {
    inputSearchCond: {
      get() {
        return this.value
      },
      set(value) {
        this.$emit('update:value', value)
      },
    },
  },
  methods: {
    getSearchResults() {
      this.$emit('getSearchResults')
    },
    clearSearch() {
      this.$emit('update:value', '')
      this.getSearchResults()
    },
  },
}
</script>

<style lang="sass">
.searh-Search
  position: relative
  @apply border border-gray-200
  @apply flex-auto
  @apply sm:flex-initial
.searh-Search_Cancel
  @apply px-2
  margin-right: 2.75rem
  position: absolute
  top: 0
  bottom: 0
  right: 0
  &:focus
    outline: 0
  &.-fade-enter-active
    animation: fade .2s ease
  &.-fade-leave-active
    animation: fade .4s cubic-bezier(1.0, 0.5, 0.8, 1.0) reverse
.search-Search_Input
  width: 100%
  border: none
  @apply text-sm
  @apply md:text-base
  @apply leading-7
  @apply py-1
  @apply px-4
  &:focus
    outline: 0
.search-Search_Submit
  @apply py-1
  @apply px-3
  @apply bg-gray-100
  @apply border-l
  @apply border-gray-200
  outline: 0
  &:focus
    outline: 0
@keyframes fade
  0%
    opacity: 0
  100%
    opacity: 1
</style>
