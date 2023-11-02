<template>
  <Head title="Edit URL" />

  <div class="max-w-3xl mx-auto mt-10">
    <form @submit.prevent="update">
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Url to short</span>
        </label>
        <input type="text" class="input input-bordered w-full" v-model="form.original_url" />
        <small v-if="form.errors.original_url" class="text-error self-start">
          {{ form.errors.original_url }}
        </small>
      </div>

      <div class="form-control w-full max-w-xs mt-5">
        <label class="label">
          <span class="label-text">Clicks limit</span>
        </label>
        <input type="text" class="input input-bordered w-full max-w-xs" v-model.number="form.clicks_limit" />
        <small v-if="form.errors.clicks_limit" class="text-error self-start">
          {{ form.errors.clicks_limit }}
        </small>
      </div>

      <button class="btn btn-primary mt-5">Update</button>
    </form>
  </div>
</template>

<script setup>

import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
  url: Object
})

const form = useForm({
  original_url: props.url.original_url,
  clicks_limit: props.url.clicks_limit
})

const update = () => {
  form.put(route('url.update', props.url));
}

</script>