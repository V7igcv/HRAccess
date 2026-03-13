<template>
  <aside 
    class="bg-[#FFFFFF] h-screen fixed left-0 top-0 transition-all duration-300 ease-in-out z-40 flex flex-col border border-[rgba(107,114,128,0.25)]"
    :class="isCollapsed ? 'w-20' : 'w-64'"
  >
    <!-- Logo and System Name Area -->
    <div class="flex items-center justify-center gap-1 p-4 h-[80px]">
      <div v-if="!isCollapsed" class="flex items-center gap-2 overflow-hidden">
        <!-- System Logo -->
        <img 
          :src="'/storage/logos/Ligao City Seal.png'" 
          class="w-12 h-12 rounded-full object-contain flex-shrink-0"
          alt="Ligao Logo"
        >
        <!-- System Name - hidden when collapsed -->
        <h2 v-if="!isCollapsed" class="font-extrabold">
          <span class="text-xl" style="color: #6A727D;">H.R.</span>
          <span class="text-xl" style="color: #104E92;">ACCESS</span>
        </h2>
      </div>
      
      <!-- Hamburger Icon - Minimize/Maximize button -->
        <button 
        @click="$emit('toggle-collapse')" 
        class="p-1 rounded-lg hover:bg-[#FCFCFC] transition-colors cursor-pointer"
        >
        <svg xmlns="http://www.w3.org/2000/svg" 
            class="h-8 w-8" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="#164980">
            <path stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-width="2" 
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        </button>
    </div>
    
    <!-- Navigation Menu - grows to take available space -->
    <nav class="flex-1 px-4 py-1 mt-4">
      <ul class="space-y-2">
        <!-- Office Management Button -->
        <li class="relative group">
        <button 
            @click="navigateTo('/superadmin')"
            class="w-full flex items-center gap-3 p-3 rounded-md transition-colors cursor-pointer"
            :class="{
            'bg-[#164980] text-white': isActive('/superadmin'),        
            'hover:bg-[#F5F5F5] text-[#474C55]': !isActive('/superadmin') 
            }"
        >
            <!-- Building Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" :class="isActive('/superadmin') ? 'text-white' : 'text-[#474C55]'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>

            <span v-if="!isCollapsed" class="text-sm font-medium whitespace-nowrap" :class="isActive('/superadmin') ? 'text-white' : 'text-[#474C55]'">Office Management</span>
        </button>

        <!-- Tooltip -->
        <div
          v-if="isCollapsed"
          class="absolute left-16 top-1/2 -translate-y-1/2 whitespace-nowrap 
                bg-[#164980] text-white text-sm px-3 py-1 rounded-md shadow-md
                opacity-0 group-hover:opacity-100 transition pointer-events-none z-50"
        >
          Office Management
        </div>
        </li>

        <!-- User Management Button -->
        <li class="relative group">
        <button 
            @click="navigateTo('/superadmin/users')"
            class="w-full flex items-center gap-3 p-3 rounded-md transition-colors cursor-pointer"
            :class="{
            'bg-[#164980] text-white': isActive('/superadmin/users'),        
            'hover:bg-[#F5F5F5] text-[#474C55]': !isActive('/superadmin/users') 
            }"
        >
            <!-- Users Group Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" :class="isActive('/superadmin/users') ? 'text-white' : 'text-[#474C55]'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>

            <span v-if="!isCollapsed" class="text-sm font-medium whitespace-nowrap" :class="isActive('/superadmin/users') ? 'text-white' : 'text-[#474C55]'">User Management</span>
        </button>

        <!-- Tooltip -->
        <div
          v-if="isCollapsed"
          class="absolute left-16 top-1/2 -translate-y-1/2 whitespace-nowrap 
                bg-[#164980] text-white text-sm px-3 py-1 rounded-md shadow-md
                opacity-0 group-hover:opacity-100 transition pointer-events-none z-50"
        >
          User Management
        </div>
        </li>
      </ul>
    </nav>
    
    <!-- User Info and Logout Section - fixed at bottom -->
    <div class="p-4">
    <div class="border-t border-gray-200 w-11/12 mx-auto mb-4"></div>
      <!-- Logout Button -->
      <button 
        @click="$emit('logout')"
        class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#F5F5F5] transition-colors text-[#474C55] cursor-pointer relative group"
        :class="{ 'justify-center': isCollapsed}"
      >
        <!-- Logout Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        <span v-if="!isCollapsed" class="text-sm font-medium whitespace-nowrap">Log Out</span>
        <!-- Tooltip -->
        <div
          v-if="isCollapsed"
          class="absolute left-16 top-1/2 -translate-y-1/2 whitespace-nowrap 
                bg-[#164980] text-white text-sm px-3 py-1 rounded-md shadow-md
                opacity-0 group-hover:opacity-100 transition pointer-events-none z-50"
        >
          Log Out
        </div>
      </button>
    </div>
  </aside>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router';

const props = defineProps({
  isCollapsed: {
    type: Boolean,
    default: false
  }
});

defineEmits(['toggle-collapse', 'logout']);

const route = useRoute();
const router = useRouter();

const navigateTo = (path) => {
  router.push(path);
};

// Check if current route matches the button path
const isActive = (path) => {
  if (path === '/superadmin') {
    return route.path === '/superadmin';
  }
  return route.path.startsWith(path);
};
</script>
