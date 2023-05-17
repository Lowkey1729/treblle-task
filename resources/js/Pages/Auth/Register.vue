<template>
  <Head title="Login" />
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />

      <form class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8" @submit.prevent="register">
        <flash-messages />
        <p class="text-center text-lg font-medium">Register with us</p>

        <div>
          <text-input v-model:inputValue="form.email" placeholder="Enter email" :error="form.errors.email" class="relative" type="email" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <email />
            </span>
          </text-input>
        </div>

        <div>
          <text-input v-model:inputValue="form.first_name" placeholder="Enter first name" :error="form.errors.first_name" class="relative" type="text" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <user />
            </span>
          </text-input>
        </div>

        <div>
          <text-input v-model:inputValue="form.last_name" placeholder="Enter last name" :error="form.errors.last_name" class="relative" type="text" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <user />
            </span>
          </text-input>
        </div>

        <div>
          <text-input v-model:inputValue="form.phone_number" placeholder="Enter phone number" :error="form.errors.phone_number" class="relative" type="text" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <telephone />
            </span>
          </text-input>
        </div>

        <div>
          <text-input v-model:inputValue="form.password" placeholder="Enter password" :error="form.errors.password" class="relative" type="password" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <password />
            </span>
          </text-input>
        </div>

        <div>
          <text-input v-model:inputValue="form.password_confirmation" placeholder="Confirm your password" :error="form.errors.password_confirmation" class="relative" type="password" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <password />
            </span>
          </text-input>
        </div>

        <button type="submit" class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Create Account</button>

        <p class="text-center text-sm text-gray-500">
          Already have an account?
          <a class="underline" href="/auth/login">Sign in</a>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/vue3'
import Logo from '@/Shared/Logos/Logo.vue'
import TextInput from '@/Shared/Forms/TextInput.vue'
import Email from '@/Shared/SVGs/Email.vue'
import Password from '@/Shared/SVGs/Password.vue'
import Telephone from '@/Shared/SVGs/Telephone.vue'
import User from '@/Shared/SVGs/User.vue'
import FlashMessages from '@/Shared/Flash/FlashMessages.vue'

export default {
  components: {
    Telephone,
    Password,
    User,
    Head,
    Logo,
    TextInput,
    Email,
    FlashMessages,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: '',
        first_name: '',
        last_name: '',
        phone_number: '',
        password: '',
        password_confirmation: '',
      }),
    }
  },
  methods: {
    register() {
      this.form.post(route('auth.web.register-user'))
    },
  },
}
</script>
