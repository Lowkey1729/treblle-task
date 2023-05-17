<template>
  <div class="mt-10">
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Welcome Back, {{ auth.user.full_name }} !</h1>
    <p class="mb-8 text-black leading-normal">A mini technical task from treblle</p>
  </div>
</template>

<script>
import Sidebar from '@/Shared/Dashboard/NavBar.vue'
import { Head } from '@inertiajs/vue3'

export default {
  name: 'Index',
  components: {
    Head,
  },
  layout: Sidebar,
  props: {
    auth: Object,
  },
}
</script>

<style scoped></style>
