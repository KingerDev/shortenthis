<template>
  <div v-if="alert.text.length"
       class="alert absolute bottom-5 w-auto right-5"
       :class="{'alert-success': alert.type === 'success', 'alert-info': alert.type === 'info', 'alert-error': alert.type === 'error'}">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>{{ alert.text }}</span>
    <button @click="closeAlert" class="btn border-gray-800 text-gray-800 hover:bg-gray-800 hover:text-gray-50 hover:border-gray-900 btn-sm btn-outline">close</button>
  </div>
</template>

<script setup>
  import alert from "@/Stores/alert.js";
  import {usePage} from "@inertiajs/vue3";
  import {watch} from "vue";

  const page = usePage()

  watch(() => page.props.flash, (newFlash, oldFlash) => {
    if (newFlash.success) {
      alert.text = newFlash.success;
      alert.type = 'success';
    }

    if (newFlash.info) {
      alert.text = newFlash.info;
      alert.type = 'info';
    }

    if (newFlash.error) {
      alert.text = newFlash.error;
      alert.type = 'error';
    }
  });

  const closeAlert = () => {
    alert.text = ""
  }

  setTimeout(() => {
    alert.text = "";
  }, 5000);
</script>