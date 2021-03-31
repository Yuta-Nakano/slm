<template>
  <transition name="scale">
    <div class="tooltip">
      <slot>
        test
      </slot>
      <span class="tooltip-triangle -red"></span>
    </div>
  </transition>
</template>

<script>
export default {
  // props: {
  //   loading: {
  //     type: Boolean,
  //     required: true,
  //   },
  // },
}
</script>

<style lang="sass">
.tooltip
  width: 18rem
  background: rgba(55, 65, 81, .4)
  color: rgb(255, 255, 255)
  text-align: center
  padding: 10px 20px
  border-radius: 10px
  right: 0
  bottom: calc(100% + 11px)
.tooltip-triangle
  border-width: 0px 6px 6px
  transform: rotate(180deg) translateX(-50%)
  position: absolute
  bottom: -6px
  left: 76%
  &.-red
    border-color: transparent transparent rgba(55, 65, 81, .4)

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
