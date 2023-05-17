<template>
  <div :class="$attrs.class">
    <input :type="type" :value="inputValue" class="w-full rounded-lg border-gray-200 p-4 pe-12 text-sm shadow-sm" :class="{ error: error }" v-bind="{ ...$attrs, class: null }" :placeholder="placeholder" @input="$emit('update:inputValue', $event.target.value)" />
    <slot />
  </div>
  <div v-if="error" class="form-error">{{ error }}</div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
  name: 'TestInput',
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    error: String,
    label: String,
    inputValue: String,
    placeholder: {
      type: String,
      default() {
        return 'Enter value'
      },
    },
  },
  emits: ['update:inputValue'],
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
  },
}
</script>

<style scoped></style>
