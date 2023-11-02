<template>
  <div class="block text-center mt-5">
    <div class="join">
      <Link v-if="obj.prev_page_url" :href="obj.prev_page_url" as="button" class="join-item btn">«</Link>
      <button class="join-item btn">Page {{ obj.current_page }}</button>
      <Link v-if="obj.next_page_url" :href="obj.next_page_url" as="button" class="join-item btn">»</Link>
    </div>
  </div>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
  obj: Object
})
</script>