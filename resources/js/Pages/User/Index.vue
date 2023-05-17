<template>
  <div>
    <Head :title="`${form.first_name} ${form.last_name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">{{ form.first_name }} {{ form.last_name }} Profile</h1>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model:inputValue="form.first_name" placeholder="Enter first name" :error="form.errors.first_name" class="pb-8 pr-6 w-full lg:w-1/2" label="First name" />
          <text-input v-model:inputValue="form.last_name" placeholder="Enter last name" :error="form.errors.last_name" class="pb-8 pr-6 w-full lg:w-1/2" label="Last name" />
          <text-input v-model:inputValue="form.email" placeholder="Enter email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model:inputValue="form.phone_number" placeholder="Enter phone number" :error="form.errors.phone_number" class="pb-8 pr-6 w-full lg:w-1/2" type="text" autocomplete="hone_number" label="Phone Number" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100" />

        <button type="submit" class="block ml-auto w-full m-1 rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Update Details</button>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Sidebar from '@/Shared/Dashboard/Sidebar'
import TextInput from '@/Shared/Forms/TextInput'

export default {
  components: {
    Head,
    Link,
    TextInput,
  },
  layout: Sidebar,
  props: {
    user: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        email: this.user.email,
        phone_number: this.user.phone_number,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/user/update/${this.user.uuid}`)
    },
  },
}
</script>
