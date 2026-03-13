<template>
  <header class="bg-[#164980] px-6 py-5 sticky top-0 z-50 shadow-md w-full">
    <div class="flex items-center justify-between w-full h-full">
      
      <!-- Left side: Date and Time -->
      <div class="flex items-center gap-2 text-white">
        <!-- Single Icon -->
        <Calendar class="w-8 h-8 opacity-90" />
        
        <!-- Text container stacked to the right -->
        <div class="flex flex-col gap-1">
          <span class="text-md font-medium leading-tight">{{ currentDate }}</span>
          <span class="text-sm font-normal opacity-90 leading-tight">{{ currentTime }}</span>
        </div>
      </div>

      <!-- Right side: Welcome text and Notifications -->
      <div class="flex items-center gap-4 text-white">
        
        <!-- Text container stacked and aligned to the right -->
        <div class="flex flex-col text-right hidden sm:flex gap-1">
          <span class="font-bold text-lg tracking-wide leading-tight">
            Welcome, <span class="capitalize">{{ user?.username || 'User' }}</span>
          </span>
          <span v-if="user?.office?.name" class="text-xs text-gray-200 opacity-90 leading-tight">
            {{ user.office.name }}
          </span>
          <span v-else-if="user?.role?.name === 'SUPERADMIN' || user?.role === 'SUPERADMIN'" class="text-xs text-gray-200 opacity-90 leading-tight">
            Super Admin
          </span>
        </div>
        
        <button class="relative p-2 bg-[#0c2e54] hover:bg-[#08203b] rounded-full transition-colors focus:outline-none shadow-sm">
          <Bell class="w-5 h-5 text-white" />
          <!-- Notification Badge -->
          <span class="absolute top-0 right-0 flex h-2.5 w-2.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
          </span>
        </button>
      </div>
      
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Calendar, Clock, Bell } from 'lucide-vue-next';

const props = defineProps({
  user: {
    type: Object,
    default: null
  }
});

const currentDate = ref('');
const currentTime = ref('');

let timer = null;

const updateDateTime = () => {
  const now = new Date();
  
  // Format Date (e.g., "Monday, March 13, 2026")
  currentDate.value = now.toLocaleDateString('en-US', {
    weekday: 'long', 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric' 
  });
  
  // Format Time (e.g., "09:39:05 AM")
  currentTime.value = now.toLocaleTimeString('en-US', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: true
  });
};

onMounted(() => {
  updateDateTime();
  // Update time every second
  timer = setInterval(updateDateTime, 1000);
});

onUnmounted(() => {
  if (timer) clearInterval(timer);
});
</script>
