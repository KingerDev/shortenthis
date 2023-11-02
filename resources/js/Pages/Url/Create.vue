<template>
  <section class="py-16 bg-accent px-10">
    <h1 class="text-center font-bold text-5xl mb-10 text-white">SHORTEN THIS</h1>
    <form @submit.prevent="uploadUrl">
      <fwb-input
        v-model="form.url"
        placeholder="paste the URL here"
        size="lg"
      >
        <template #suffix>
          <button class="btn btn-primary btn-sm">Shorten</button>
        </template>
      </fwb-input>
    </form>
  </section>
</template>

<script lang="ts" setup>
import { ref } from 'vue'
import { FwbButton, FwbInput } from 'flowbite-vue'
import {useForm} from "@inertiajs/vue3";

const url = ref('')

const form = useForm({
  url: "",
});

const uploadUrl = () => {
  form.post(route('url.store'));
}
</script>