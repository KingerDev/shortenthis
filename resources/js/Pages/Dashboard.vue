<template>
    <Head title="Dashboard" />

  <main class="max-w-5xl mx-auto">
    <section class="mt-10 mx-3">
      <div class="card bg-neutral text-neutral-content">
        <div class="card-body items-center text-center">
          <h2 class="card-title">Create a short for</h2>
          <form class="flex space-x-2 w-full" @submit.prevent="uploadUrl">
            <input type="text" placeholder="Type here" class="input input-bordered w-full" :class="{'input-error': form.errors.url}" v-model="form.url" />
            <button class="btn">shorten</button>
          </form>
          <small v-if="form.errors.url" class="text-error self-start">
            {{ form.errors.url }}
          </small>
        </div>
      </div>
    </section>

    <section class="mt-10 mx-3">
      <h2 class="text-2xl font-bold">My URLs</h2>
      <div v-if="urls.length" class="flex flex-col space-y-7 mt-5">
        <div v-for="url in urls" :key="url.id" class="card bg-neutral text-neutral-content">
          <div class="flex justify-around items-center space-x-5 md:space-x-16 p-5">
            <div class="flex flex-col space-y-1">
              <a :href="route('click', {prefix: url.prefix})" class="text-primary text-lg" target="_blank">
                {{ `shortenthis.kinger.tech/${url.prefix}` }}
              </a>
              <a :href="url.original_url" target="_blank" class="text-gray-500">{{ cutString(url.original_url) }}</a>
            </div>
            <a href="#" class="text-primary" target="_blank">
              {{ url.clicks_count }}
              <span class="hidden md:inline-flex">clicks</span>
            </a>
            <div class="flex flex-col">
              <small class="text-gray-500">Date created</small>
              <span class="hidden md:inline-flex">{{ formatDate(url.created_at) }}</span>
            </div>
            <div class="dropdown dropdown-end">
              <label tabindex="0" class="btn m-1 flex">
                <i class="fa-solid fa-gear"></i>
              </label>
              <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <li @click="copyUrl(url.original_url)"><a>Copy link</a></li>
                <li>
                  <Link :href="route('url.show', {url: url.prefix})">Show stats</Link>
                </li>
                <li>
                  <Link :href="route('url.edit', url)">Edit link</Link>
                </li>
                <li>
                  <Link :href="route('url.destroy', url)" class="text-red-500 hover:text-red-500" as="button" method="delete">Delete link</Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <h3 v-else class="text-lg font-semibold mt-7 text-gray-500">No urls yet</h3>
    </section>
  </main>
</template>

<script setup>
import {computed, ref} from "vue";
import {useForm, Head, Link} from "@inertiajs/vue3";
import {copyText, cutString} from '@/Utils/general'
import alert from "@/Stores/alert.js";
import Edit from "@/Pages/Url/Edit.vue";

defineProps({
  urls: Array,
})

const url = ref('')

const form = useForm({
  url: "",
});

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"})
}

const uploadUrl = () => {
  form.post(route('url.store'));
}

const copyUrl = (url) => {
  copyText(url)

  alert.type = "success"
  alert.text = "Copied to clipboard"
}
</script>