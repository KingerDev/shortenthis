<template>
  <Create />
  <section class="max-w-4xl mx-auto">
    <h2 class="font-bold text-4xl my-10">About</h2>
    <p class="leading-7 tracking-wide text-gray-500">
      Welcome to ShortenThis, the premier destination for all your URL shortening needs.
      We understand that in today's fast-paced digital world, every character counts, and we're here to make your online experience as efficient and
      convenient as possible.

      At ShortenThis, we're passionate about simplifying long and complex URLs. Whether you're sharing links on social media, in emails,
      or in any other context, our URL shortener service is designed to provide you with a hassle-free solution.
    </p>
    <h2 class="font-bold text-4xl my-10">Why choose ShortenThis?</h2>
    <ul class="list-disc list-inside">
      <li class="my-5">
        <span class="font-bold">Quick and Easy:</span>
        <p class="ml-7 text-gray-500">
          Our user-friendly interface allows you to shorten your URLs in seconds. It's as simple as paste, click, and share.
        </p>
      </li>
      <li class="my-5">
        <span class="font-bold">Custom Short URLs:</span>
        <p class="ml-7 text-gray-500">
          Personalize your shortened links to make them more memorable and branded to your needs.
        </p>
      </li>
      <li class="my-5">
        <span class="font-bold">Performance Analytics:</span>
        <p class="ml-7 text-gray-500">
          Track and monitor the performance of your links. Find out who's clicking and when.
        </p>
      </li>
      <li class="my-5">
        <span class="font-bold">Reliable and Secure:</span>
        <p class="ml-7 text-gray-500">
          We take security seriously. Rest assured that your data and links are safe with us.
        </p>
      </li>
      <li class="my-5">
        <span class="font-bold">No Registration Required:</span>
        <p class="ml-7 text-gray-500">
          You don't need an account to use our service. Simply shorten your URLs and get on with what you do best.
        </p>
      </li>
    </ul>
  </section>
  <section class="py-10 w-full bg-accent my-10 text-center">
    <h3 class="text-4xl text-gray-50 font-bold mb-10">So, what to wait for?</h3>
    <button class="btn btn-primary">Get Started</button>
  </section>
</template>

<script setup>

import Create from "@/Pages/Url/Create.vue";
</script>