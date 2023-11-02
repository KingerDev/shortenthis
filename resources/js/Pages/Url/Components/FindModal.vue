<template>
  <dialog id="find_modal" class="modal">
    <div class="modal-box">
      <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
      <form @submit.prevent="find">
        <div class="form-control w-full">
          <label class="label">
            <span class="label-text">Paste generated url here</span>
          </label>
          <input type="url" v-model="form.url" class="input input-bordered w-full" required />
        </div>
        <button class="btn btn-primary mt-5">See stats</button>
      </form>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
  </dialog>
</template>

<script setup>

import {useForm} from "@inertiajs/vue3";

const form = useForm({
  url: ""
})

const find = () => {
  document.getElementById('find_modal').close()
  form.post(route('find-url'))
}
</script>