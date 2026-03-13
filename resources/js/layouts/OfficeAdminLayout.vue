<template>
  <div class="bg-gray-50 font-sans leading-normal tracking-normal flex">
    
    <!-- Sidebar Component -->
    <OfficeSidebar 
      :is-collapsed="isSidebarCollapsed" 
      @toggle-collapse="toggleSidebar"
      @logout="handleLogout"
    />

    <!-- Main Content wrapper, margined left depending on sidebar state -->
    <div 
      class="flex-1 flex flex-col min-h-screen transition-all duration-300 ease-in-out"
      :class="isSidebarCollapsed ? 'ml-20' : 'ml-64'"
    >
      <!-- Header Component -->
      <Header :user="user" />

      <!-- Main Page View Content -->
      <main class="flex-1 p-6 z-0 mt-8">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import Header from '../components/Header.vue'
import OfficeSidebar from '../components/OfficeSidebar.vue'

const router = useRouter()
const user = ref(null)
const isSidebarCollapsed = ref(false)

const toggleSidebar = () => {
  isSidebarCollapsed.value = !isSidebarCollapsed.value
}

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
