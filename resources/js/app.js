import {createApp, h} from 'vue'
import {createInertiaApp} from '@inertiajs/vue3'
import Sidebar from "@/Shared/Dashboard/Sidebar.vue";

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
    let page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Sidebar
    return page
  },
  setup({el, App, props, plugin}) {
    createApp({render: () => h(App, props)})
      .use(plugin)
      .mount(el)
  },
})
