<template>
  <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 w-full">
    <div class="flex-1 flex justify-between sm:hidden">
      <a
        href="#"
        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
        :class="{'disabled': pagenate.currentPage <= 1}"
        @click.prevent="paging(pagenate.currentPage - 1)"
      >
        Previous
      </a>
      <a
        href="#"
        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"
        :class="{'disabled': pagenate.currentPage >= pagenate.lastPage}"
        @click.prevent="paging(pagenate.currentPage + 1)"
      >
        Next
      </a>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          全 <span class="font-medium">{{ pagenate.total }}</span>件 <span class="font-medium">{{ pagenate.from }}</span> 〜 <span class="font-medium">{{ pagenate.to }}</span>件表示
        </p>
      </div>
      <div v-if="pagenate.lastPage >= 2">
        <nav class="relative z-0 inline-flex shadow-sm -space-x-px" aria-label="Pagination">
          <a
            href="#"
            class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
            :class="{'disabled': pagenate.currentPage <= 1}"
            @click.prevent="paging(pagenate.currentPage - 1)"
          >
            <span class="sr-only">Previous</span>
            <!-- Heroicon name: chevron-left -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </a>
          <a
            :key="page"
            v-for="page in pages"
            href="#"
            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
            :class="{'active': page === pagenate.currentPage}"
            @click.prevent="paging(page)"
          >
            {{ page }}
          </a>
          <a
            href="#"
            class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
            :class="{'disabled': pagenate.currentPage >= pagenate.lastPage}"
            @click.prevent="paging(pagenate.currentPage + 1)"
          >
            <span class="sr-only">Next</span>
            <!-- Heroicon name: chevron-right -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    pagenate: {
      type: Object,
      default: {
        currentPage: 1,
        lastPage: 1,
        total: 1,
        from: 0,
        to: 0,
      },
    },
  },
  computed: {
    pages() {
      let start = _.max([this.pagenate.currentPage - 2, 1])
      let end = _.min([start + 5, this.pagenate.lastPage + 1])
      start = _.max([end - 5, 1])
      return _.range(start, end)
    },
  },
  methods: {
    paging(page) {
      if (page >= 1 && page <= this.pagenate.lastPage) this.$emit('getSearchResults', page)
    },
  },
}
</script>
