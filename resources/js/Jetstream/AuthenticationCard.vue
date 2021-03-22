<template>
  <div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover"
    style="background-image: url('/assets/fundo.jpg')"
  >
    <div
      class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-90 shadow-md overflow-hidden sm:rounded-lg"
    >
      <slot />
    </div>
  </div>
</template>
