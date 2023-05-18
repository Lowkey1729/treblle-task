<template>
  <div>
    <Head :title="`${this.user.first_name} ${this.user.last_name}`" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h3 class="text-xl font-semibold">{{ this.user.first_name }} {{ this.user.last_name }}'s <span class="text-3xl font-bold inline-block">Profile</span></h3>
    </div>
    <div class="max-w-3xl bg-gray-100 rounded-md shadow overflow-hidden relative">
      <form class="mb-0 mt-3 space-y-4 rounded-lg p-2 shadow-lg sm:p-6 lg:p-8" @submit.prevent="update">
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-3 mb-7">
          <div>
            <text-input v-model:inputValue="form.email" label="Email" placeholder="Enter email" :error="form.errors.email" class="relative" type="email" autofocus autocapitalize="off">
              <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <email />
              </span>
            </text-input>
          </div>

          <div>
            <text-input v-model:inputValue="form.first_name" label="First Name" placeholder="Enter first name" :error="form.errors.first_name" class="relative" type="text" autofocus autocapitalize="off">
              <span class="absolute inset-y-0 end-0 grid  place-content-center px-4">
                <user />
              </span>
            </text-input>
          </div>

          <div>
            <text-input v-model:inputValue="form.last_name" label="Last Name" placeholder="Enter last name" :error="form.errors.last_name" class="relative" type="text" autofocus autocapitalize="off">
              <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <user />
              </span>
            </text-input>
          </div>

          <div>
            <text-input v-model:inputValue="form.phone_number" label="Phone Number" placeholder="Enter phone number" :error="form.errors.phone_number" class="relative" type="text" autofocus autocapitalize="off">
              <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <telephone />
              </span>
            </text-input>
          </div>

            <div class="absolute  bottom-0 left-0">
                <button type="submit" class="block lg:mb-2 lg:ml-8 ml-3 mt-2 w-full  rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Update Details</button>
            </div>
        </div>


      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Sidebar from '@/Shared/Dashboard/NavBar.vue'
import TextInput from '@/Shared/Forms/TextInput'
import Telephone from '@/Shared/SVGs/Telephone'
import Email from '@/Shared/SVGs/Email'
import User from '@/Shared/SVGs/User'

export default {
  components: {
    Head,
    Link,
    TextInput,
    User,
    Email,
    Telephone,
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
