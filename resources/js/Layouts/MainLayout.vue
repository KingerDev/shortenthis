<template>
  <header class="w-full bg-primary">
    <div class="navbar bg-base-100">
      <div class="navbar-start">
        <Link class="btn btn-ghost normal-case text-xl" :href="route('/')">
          <img :src="route('images.logoSmall')" class="w-10" alt="logo">
          ShortenThis
        </Link>
      </div>
      <div class="navbar-end">
        <div class="tooltip tooltip-bottom" data-tip="Find out stats of your url">
          <button class="btn btn-ghost btn-circle" onclick="find_modal.showModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
          </button>
        </div>
        <Link v-if="!$page.props.auth.user" :href="route('register')" class="btn">Get Started</Link>
        <div v-else class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-primary m-1">{{ $page.props.auth.user.name }}</label>
          <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
            <li><a>Dashboard</a></li>
            <li><Link :href="route('profile.edit')">Settings</Link></li>
            <li><a>Log out</a></li>
          </ul>
        </div>
      </div>
    </div>

  </header>

  <FindModal />

  <main class="">
    <slot>Default</slot>

    <Alert />
  </main>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/vue3'
import Alert from "@/Components/Alert.vue";
import FindModal from "@/Pages/Url/Components/FindModal.vue";

const page = usePage()
</script>
