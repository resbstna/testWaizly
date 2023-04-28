<script setup>
import Header from './views/admin/layout/Header.vue'
import { RouterLink, RouterView } from 'vue-router';
import Menu from './views/admin/layout/Menu.vue'
import Footer from './views/admin/layout/Footer.vue'
import { initFlowbite } from 'flowbite'

</script>

  
<template>
    <span v-if="!$route.meta.hideNavigation">
        <Header />
        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
            <Menu />
            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                <main>

                    <RouterView />
                </main>

                <Footer />
            </div>

        </div>
    </span>

    <span v-else>
        <div>
            <main>

                <RouterView />
            </main>
        </div>

    </span>
</template>


<script>

// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark')
}

</script>