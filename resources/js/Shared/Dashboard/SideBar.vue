<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/dashboard">
        <div :class="isUrl('dashboard') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/user/view">
        <div :class="isUrl('user/view') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Profile</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
  components: {
    Link,
  },
  props: {
    auth: Object,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
