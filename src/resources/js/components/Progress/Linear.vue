<template>
  <div v-show="loading" class="w-full">
    <div class="progress">
      <div class="progress-bg -green"></div>
      <div class="progress-buffer"></div>
      <div class="progress-indeterminate">
        <div class="progress-bar -long -green"></div>
        <div class="progress-bar -short -green"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      required: true,
    },
  },
  mounted() {
    console.log(this.loading)
  },
}
</script>

<style lang="sass">
.progress
  @apply bg-transparent overflow-hidden relative w-full
  height: inherit
  transition: .2s cubic-bezier(.4,0,.6,1)
.progress-bg
  @apply top-0 bottom-0 left-0 absolute
  transition:inherit
  // optional
  @apply opacity-30 w-full
  left: 0%
  &.-green
    @apply bg-green-600 border-green-600
.progress-buffer
  @apply absolute top-0 left-0 w-full
  height: inherit
  transition: inherit
.progress-indeterminate
  //
.progress-bar
  &.-green
    @apply bg-green-600 border-green-600
  &.-long
  &.-short
    @apply absolute top-0 right-auto bottom-0 left-0 w-auto
    height: inherit
    will-change: left,right
    animation-duration: 2.2s
    animation-iteration-count: infinite
  &.-long
    animation-name: indeterminate-ltr
  &.-short
    animation-name: indeterminate-short-ltr

@keyframes indeterminate-ltr
  0%
    left: -90%
    right: 100%
  60%
    left: -90%
    right: 100%
  to
    left: 100%
    right: -35%

@keyframes indeterminate-short-ltr
  0%
    left: -200%
    right: 100%
  60%
    left: 107%
    right: -8%
  to
    left: 107%
    right: -8%
</style>
