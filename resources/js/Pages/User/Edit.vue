<template>
  <div>
    <Head :title="`${user.first_name} ${user.last_name}`" />
    <section>
      <div class="flex justify-start max-w-3xl">
        <h3 class="text-xl font-semibold">{{ user.first_name }} {{ user.last_name }}'s <span class="text-3xl font-bold inline-block">Profile</span></h3>
      </div>
      <hr />
    </section>

    <section id="profile" class="mt-10">
      <div class="flex justify-start mb-8 max-w-3xl">
        <h3 class="text-xl font-semibold inline-block">Personal Information</h3>
      </div>

        <flash-messages v-if="section === 'profile'" />

      <div class="max-w-3xl bg-gray-100 rounded-md shadow overflow-hidden relative">
        <form class="mb-0 mt-3 space-y-4 rounded-lg p-2 shadow-lg sm:p-6 lg:p-8" @submit.prevent="updateProfile">
          <div class="grid lg:grid-cols-2 grid-cols-1 gap-3 mb-7">
            <div>
              <text-input v-model:inputValue="profile_form.email" label="Email" placeholder="Enter email" :error="profile_form.errors.email" class="relative" type="email" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <email />
                </span>
              </text-input>
            </div>

            <div>
              <text-input v-model:inputValue="profile_form.first_name" label="First Name" placeholder="Enter first name" :error="profile_form.errors.first_name" class="relative" type="text" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <user />
                </span>
              </text-input>
            </div>

            <div>
              <text-input v-model:inputValue="profile_form.last_name" label="Last Name" placeholder="Enter last name" :error="profile_form.errors.last_name" class="relative" type="text" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <user />
                </span>
              </text-input>
            </div>

            <div>
              <text-input v-model:inputValue="profile_form.phone_number" label="Phone Number" placeholder="Enter phone number" :error="profile_form.errors.phone_number" class="relative" type="text" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <telephone />
                </span>
              </text-input>
            </div>

            <div class="absolute bottom-0 left-0">
              <button type="submit" class="block lg:mb-2 lg:ml-8 ml-3 mt-2 w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Update</button>
            </div>
          </div>
        </form>
      </div>
    </section>

    <section id="password" class="mt-10">
      <div class="flex justify-start mb-8 max-w-3xl">
        <h3 class="text-xl font-semibold inline-block">Change Password</h3>
      </div>

      <flash-messages v-if="section === 'password'" />

      <div class="max-w-3xl bg-gray-100 rounded-md shadow overflow-hidden relative">
        <form class="mb-0 mt-3 space-y-4 rounded-lg p-2 shadow-lg sm:p-6 lg:p-8" @submit.prevent="updatePassword">
          <div class="grid lg:grid-cols-2 grid-cols-1 gap-3 mb-7">
            <div>
              <text-input v-model:inputValue="password_form.old_password" label="Old Password" :error="password_form.errors.old_password" class="relative" type="password" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <password />
                </span>
              </text-input>
            </div>

            <div>
              <text-input v-model:inputValue="password_form.password" label="New Password" :error="password_form.errors.password" class="relative" type="password" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <password />
                </span>
              </text-input>
            </div>

            <div>
              <text-input v-model:inputValue="password_form.password_confirmation" label="Confirm Password" :error="password_form.errors.password_confirmation" class="relative" type="password" autofocus autocapitalize="off">
                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                  <password />
                </span>
              </text-input>
            </div>

            <div class="absolute bottom-0 left-0">
              <button type="submit" class="block lg:mb-2 lg:ml-8 ml-3 mt-2 w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Update</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Sidebar from '@/Shared/Dashboard/NavBar'
import TextInput from '@/Shared/Forms/TextInput'
import Telephone from '@/Shared/SVGs/Telephone'
import Email from '@/Shared/SVGs/Email'
import User from '@/Shared/SVGs/User'
import Password from '@/Shared/SVGs/Password'
import FlashMessages from '@/Shared/Flash/FlashMessages'

export default {
  components: {
    Head,
    Link,
    TextInput,
    User,
    Email,
    Telephone,
    Password,
    FlashMessages,
  },
  layout: Sidebar,
  props: {
    user: Object,
  },
  data() {
    return {
      section: '',
      profile_form: this.$inertia.form({
        _method: 'put',
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        email: this.user.email,
        phone_number: this.user.phone_number,
      }),

      password_form: this.$inertia.form({
        __method: 'put',
        password: '',
        old_password: '',
        password_confirmation: '',
      }),
    }
  },
  methods: {
    updateProfile() {
      this.section = 'profile'
      this.profile_form.post(`/user/update`)
    },
    updatePassword() {
      this.section = 'password'
      this.password_form.put('/auth/update/password', { preserveScroll: true })
    },
  },
}
</script>
