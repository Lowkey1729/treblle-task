<template>
    <div>
        <div id="dropdown"/>
        <div class="md:flex md:flex-col">
            <div class="md:flex md:flex-col md:h-screen">
                <div class="md:flex md:flex-shrink-0">
                    <div
                        class="flex items-center justify-between px-6 py-4 bg-gray-100 md:flex-shrink-0 md:justify-center md:w-56">
                        <Link class="mt-1" href="/">
                            <logo class="fill-white" width="120" height="28"/>
                        </Link>
                    </div>
                    <div
                        class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-12 md:py-0">
                        <div class="mr-4 mt-1">
                            <p class="text-black">{{ auth.user.full_name }}</p>
                        </div>

                        <div>
                            <Link class="mt-1" href="#" @click="logout" > Logout</Link>
                        </div>
                    </div>
                </div>
                <div class="md:flex md:flex-grow md:overflow-hidden">
                    <main-menu :auth="auth"
                               class="hidden flex-shrink-0 p-12 w-56 bg-indigo-800 overflow-y-auto md:block"/>
                    <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
                        <flash-messages/>
                        <slot/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/vue3'
// import Icon from '@/Shared/Icon'
import Logo from '@/Shared/Logos/Logo'
// import Dropdown from '@/Shared/Dropdown'
import MainMenu from '@/Shared/Dashboard/MainMenu'
import FlashMessages from '@/Shared/Flash/FlashMessages'

export default {
    components: {
        // Dropdown,
        FlashMessages,
        // Icon,
        Link,
        Logo,
        MainMenu,
    },
    props: {
        auth: Object,
    },
    methods: {
        logout() {
            if (confirm('Are you sure you want to logout?')) {
                this.$inertia.get(route('auth-web.logout-user'))
            }
        }
    }
}
</script>
