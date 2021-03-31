<template>
  <DefaultLayout>
    <template #before-main>
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold leading-tight text-gray-900">
            Template
          </h1>
        </div>
      </header>
    </template>

    <template>
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
          <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
            エリア
          </div>
        </div>
      </div>
    </template>
  </DefaultLayout>
</template>

<script>
export default {
  head: {
    title: 'Template',
  },
}
</script>
