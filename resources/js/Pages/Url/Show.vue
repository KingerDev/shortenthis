<template>
  <section class="py-16 bg-neutral px-10">
    <div class="relative group">
      <h1 class="text-center font-bold text-xl md:text-4xl mb-10 hover:text-primary hover:underline cursor-pointer" title="Copy" @click="copyUrl">
        {{ click }}
      </h1>
      <small
        class="hidden group-hover:block copy bg-primary text-white py-2 px-3 rounded-md font-semibold text-md cursor-pointer"
        @click="toggleCopyText"
      >
        {{ copyTextValue }}
      </small>
    </div>
    <div class="block text-center">
      <fwb-button outline @click="() => isVisibleQrCode = !isVisibleQrCode">
        Generate QR code
        <template #prefix>
          <i class="fa-solid fa-qrcode"></i>
        </template>
      </fwb-button>
    </div>
    <span v-if="isVisibleQrCode" ref="qrcode" class="flex flex-col items-center space-y-5 mt-10">
      <qrcode-vue :value="qr" :size="150" level="H" class="p-3 bg-gray-50 rounded" />
      <fwb-button outline @click="downloadQrCode">
          Download an image
          <template #prefix>
            <i class="fa-solid fa-download"></i>
          </template>
        </fwb-button>
    </span>
  </section>

  <section class="mt-10 max-w-3xl mx-auto px-5">
    <div class="stats bg-neutral text-primary-content w-full">

      <div class="stat">
        <div class="stat-title">Total visits</div>
        <div class="stat-value">{{ url.clicks_count }}</div>
      </div>

      <div class="stat">
        <div class="stat-title">Unique visits</div>
        <div class="stat-value">{{ uniqueVisits }}</div>
      </div>

      <div class="stat">
        <div class="stat-title">QR scans</div>
        <div class="stat-value">{{ qrScans }}</div>
      </div>

    </div>

    <div class="stats bg-neutral text-primary-content w-full mt-10">

      <div class="stat">
        <div class="stat-title">Average daily clicks</div>
        <div class="stat-value">{{ dailyAverage }}</div>
      </div>

      <div class="stat">
        <div class="stat-title">Average weekly clicks</div>
        <div class="stat-value">{{ weeklyAverage }}</div>
      </div>

      <div class="stat">
        <div class="stat-title">Average monthly clicks</div>
        <div class="stat-value">{{ monthlyAverage }}</div>
      </div>

    </div>

    <div class="mt-10 overflow-x-auto bg-neutral rounded-xl p-5">
      <h2 class="text-2xl font-semibold mb-3">Logs</h2>
      <table class="table">
        <!-- head -->
        <thead>
        <tr>
          <th></th>
          <th>User agent</th>
          <th>Type</th>
          <th>When</th>
        </tr>
        </thead>
        <tbody>
          <tr v-for="(click, index) in clicks.data" :key="index">
            <th>{{ index + 1 }}</th>
            <td>{{ click.user_agent }}</td>
            <td>{{ getType(click.type) }}</td>
            <td>{{ moment(click.created_at).fromNow() }}</td>
          </tr>
        </tbody>
      </table>
      <Pagination :obj="clicks" />
    </div>
  </section>
</template>

<script setup>
import {computed, ref} from "vue";
import { FwbButtonGroup, FwbButton } from 'flowbite-vue'
import QrcodeVue from 'qrcode.vue'
import { copyText } from "@/Utils/general.js";
import moment from 'moment';
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
  url: Object,
  clicks: Object,
  uniqueVisits: Number,
  qrScans: Number,
  dailyAverage: Number,
  weeklyAverage: Number,
  monthlyAverage: Number,
  siteUrl: String,
})

const qr = `${props.siteUrl}/qr/${props.url.prefix}`;
const click = `${props.siteUrl}/click/${props.url.prefix}`;
const copyTextValue = ref("Copy");
const isVisibleQrCode = ref(false);
const qrcode = ref(null)

const getType = (type) => {
  return type === "qr" ? "QR code" : "Click"
}

const copyUrl = () => {

  copyText(click);

  copyTextValue.value = "Copied";

  // Reset the copy text back to "Copy" after a brief delay
  setTimeout(() => {
    copyTextValue.value = "Copy";
  }, 1000); // Adjust the delay duration as needed
};

const toggleCopyText = () => {
  // Toggle between "Copy" and "Copied" when clicked
  copyTextValue.value = copyTextValue.value === "Copy" ? "Copied" : "Copy";
};

const downloadQrCode = () => {
  if (isVisibleQrCode.value) {

    let canvasImage = qrcode.value.getElementsByTagName('canvas')[0].toDataURL('image/png');
    let xhr = new XMLHttpRequest();
    xhr.responseType = 'blob';

    xhr.onload = function () {

      let a = document.createElement('a');
      a.href = window.URL.createObjectURL(xhr.response);
      a.download = 'qrcode.png';
      a.style.display = 'none';
      document.body.appendChild(a);
      a.click();
      a.remove();

    };

    xhr.open('GET', canvasImage);
    xhr.send();
  }
};
</script>

<style scoped>
.copy {
  position: absolute;
  top: 50%;
  right: 0;
  transform: translateY(-50%);
}
</style>
