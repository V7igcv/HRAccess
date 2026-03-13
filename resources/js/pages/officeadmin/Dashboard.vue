<template>
  <div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Office Admin Dashboard</h2>
    
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm text-blue-700">
            <strong>Verification Success:</strong> You are viewing the Office Admin Dashboard as: <span class="font-semibold">{{ officeName }}</span>
          </p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="border rounded-md p-4 bg-gray-50 flex items-center justify-center h-32 text-gray-400">
        Placeholder Widget 1
      </div>
      <div class="border rounded-md p-4 bg-gray-50 flex items-center justify-center h-32 text-gray-400">
        Placeholder Widget 2
      </div>
      <div class="border rounded-md p-4 bg-gray-50 flex items-center justify-center h-32 text-gray-400">
        Placeholder Widget 3
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// In a real app, this would come from a store or API based on the authenticated user
const officeName = ref('[Your Office Name Here]');
</script>
