<template>
  <Head title="Login" />
  <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-lg">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />

      <form class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8" @submit.prevent="login">
        <flash-messages />
        <p class="text-center text-lg font-medium">Sign in to your account</p>

        <div>
          <text-input v-model:inputValue="form.email" placeholder="Enter email" :error="form.errors.email" class="relative" type="email" autofocus autocapitalize="off">
            <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
              <email />
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

        <button type="submit" class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white">Sign in</button>

        <p class="text-center text-sm text-gray-500">
          No account?
          <a class="underline" href="">Sign up</a>
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
import FlashMessages from '@/Shared/Flash/FlashMessages.vue'

export default {
  components: {
    Password,
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
        password: '',
      }),
    }
  },
  methods: {
    login() {
      this.form.post(route('auth-web.login-user'))
    },
  },
}
</script>
