const mixin = {
  methods: {
    toggle(name) {
      this[name] = !this[name]
    },
  },
}

export default mixin
