<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Superadmin Top Navbar Placeholder -->
    <header class="bg-indigo-600 text-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">HR Access - Superadmin Panel</h1>
        <div class="flex items-center gap-4">
          <span class="text-sm font-medium">Welcome, {{ user?.username || 'Admin' }}</span>
          <button @click="handleLogout" class="bg-indigo-700 hover:bg-indigo-800 px-4 py-2 rounded text-sm font-medium transition-colors cursor-pointer">
            Logout
          </button>
        </div>
      </div>
    </header>

    <!-- Main Content Area with Sidebar Placeholder -->
    <div class="flex-1 flex max-w-7xl mx-auto w-full">
      <!-- Sidebar Placeholder -->
      <aside class="w-64 bg-white shadow-sm hidden md:block border-r border-gray-200">
        <nav class="h-full py-4">
          <ul class="space-y-1">
            <li>
              <router-link to="/superadmin" class="block px-6 py-2 hover:bg-gray-50 text-indigo-700 font-medium">
                Office Management
              </router-link>
            </li>
            <li>
              <router-link to="/superadmin/users" class="block px-6 py-2 hover:bg-gray-50 text-gray-700">
                User Management
              </router-link>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Page Content Placeholder -->
      <main class="flex-1 p-6 md:p-8">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const router = useRouter()
const user = ref(null)

onMounted(() => {
  const userStr = localStorage.getItem('user')
  if (userStr) {
    user.value = JSON.parse(userStr)
  }
})

const handleLogout = async () => {
  try {
    await axios.post('/api/logout', {}, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('auth_token')}`
      }
    })
  } catch (error) {
    console.error('Error logging out on server:', error)
  } finally {
    localStorage.removeItem('auth_token')
    localStorage.removeItem('user')
    router.push('/login')
  }
}
</script>
