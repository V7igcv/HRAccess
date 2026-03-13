<template>
  <div class="relative min-h-screen flex items-center justify-center bg-gray-100">
    <!-- Background Image -->
    <div class="absolute inset-0">
      <img 
        :src="'/storage/images/LGU-Ligao.jpg'" 
        class="w-full h-full object-cover opacity-90 brightness-90" 
        alt="Background" 
      />
    </div>

    <!-- Login card -->
    <div class="relative z-10 bg-white/60 p-15 rounded-xl shadow-xl w-130">
      <!-- Header with Logo -->
      <div class="text-center mb-8">
        <div class="h-20 w-20 bg-white/80 rounded-full mx-auto mb-4 flex items-center justify-center shadow-sm">
          <img :src="'/storage/logos/Ligao City Seal.png'" 
          class="h-20 w-20 rounded-full object-contain"
          alt="Ligao Logo">
        </div>
        <h2 class="text-4xl font-extrabold">
            <span style="color: #6A727D;">H.R. </span>
            <span style="color: #104E92;">ACCESS</span>
        </h2>
        <p class="text-md text-[#1F4E79]">Human Resource Assistance and Citizen Charter Electronic Service System</p>
        <p class="text-lg text-[#474C55] mt-5">Login to continue</p>
      </div>
      
      <!-- Login Form -->
      <form @submit.prevent="handleLogin">
        <!-- Username Field -->
        <div class="mb-4">
          <label class="block text-[#474C55] text-sm font-medium mb-2 text-left">
            Username
          </label>
          <input
            v-model="form.username"
            type="text"
            placeholder="Enter your Username"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#474C55] focus:border-transparent bg-white/80"
            required
          />
        </div>
        
        <!-- Password Field with Eye Icon -->
        <div class="mb-6">
          <label class="block text-[#474C55] text-sm font-medium mb-2 text-left">
            Password
          </label>
          <div class="relative">
            <input
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
              placeholder="Enter your Password"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#474C55] focus:border-transparent pr-10 bg-white/80"
              required
            />
            <!-- Eye icon button -->
            <button 
              type="button"
              @click="togglePasswordVisibility"
              class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-[#474C55] focus:outline-none cursor-pointer"
            >
              <EyeOff v-if="showPassword" class="w-5 h-5" />
              <Eye v-else class="w-5 h-5" />
            </button>
          </div>
        </div>
        
        <!-- Error Message -->
        <div v-if="error" class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-lg text-sm text-center">
          {{ error }}
        </div>
        
        <!-- Login Button -->
        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-[#164980] text-white py-2 px-4 rounded-lg hover:bg-[#24568C] disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200 font-medium cursor-pointer"
        >
          <span v-if="loading">Logging in...</span>
          <span v-else>Login</span>
        </button>
      </form>
      
      <!-- Footer Note -->
      <p class="mt-4 text-xs text-center text-gray-500">
        This system is for authorized personnel only
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { Eye, EyeOff } from 'lucide-vue-next'
import axios from 'axios'

const form = ref({
  username: '',
  password: ''
})

const showPassword = ref(false)
const loading = ref(false)
const error = ref('')

const router = useRouter()

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value
}

const handleLogin = async () => {
  loading.value = true
  error.value = ''
  
  try {
    const response = await axios.post('/api/login', {
      username: form.value.username,
      password: form.value.password
    }, {
      headers: {
        'Accept': 'application/json'
      }
    })
    
    // Store the token and user data
    localStorage.setItem('auth_token', response.data.token)
    localStorage.setItem('user', JSON.stringify(response.data.user))
    
    // Redirect based on the backend's response
    router.push(response.data.redirect_to)
    
  } catch (err) {
    if (err.response && err.response.data && err.response.data.message) {
      error.value = err.response.data.message
    } else {
      error.value = 'An error occurred during login. Please try again.'
    }
  } finally {
    loading.value = false
  }
}
</script>
