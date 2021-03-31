<template>
  <div class="min-h-screen bg-gray-100">
    <Nav />

    <slot name="before-main" />

    <main>
      <slot />
    </main>

    <slot name="after-main" />
  </div>
</template>
