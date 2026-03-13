<template>
  <div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">CSM Data Entry</h2>
    
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm text-blue-700">
            <strong>Verification Success:</strong> You are viewing the CSM Data Entry page for Office Admin: <span class="font-semibold">{{ officeName }}</span>
          </p>
        </div>
      </div>
    </div>

    <!-- Placeholder Form -->
    <div class="border rounded-md border-gray-200">
      <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
        <h3 class="font-medium text-gray-700">Data Entry Form Placeholder</h3>
      </div>
      <div class="p-4 space-y-4">
        <div class="h-10 bg-gray-100 rounded w-full border border-dashed border-gray-300"></div>
        <div class="h-10 bg-gray-100 rounded w-full border border-dashed border-gray-300"></div>
        <div class="h-10 bg-gray-100 rounded w-full border border-dashed border-gray-300"></div>
        <div class="h-24 bg-gray-100 rounded w-full border border-dashed border-gray-300"></div>
        <div class="flex justify-end pt-2">
           <div class="h-10 bg-gray-200 rounded w-24 border border-dashed border-gray-300"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// In a real app, this would come from a store or API based on the authenticated user
const officeName = ref('[Your Office Name Here]');
</script>
