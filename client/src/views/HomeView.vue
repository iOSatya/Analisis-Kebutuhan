<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-10">
    <h1 class="text-2xl font-semibold mb-6">Selamat Datang</h1>

    <div class="flex gap-4">
      <RouterLink
        :to="{ name: 'login' }"
        class="w-32 text-center py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
      >
        Login
      </RouterLink>

      <RouterLink
        :to="{ name: 'register' }"
        class="w-32 text-center py-2 px-4 bg-green-300 text-gray-800 font-semibold rounded-full shadow-md hover:bg-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
      >
        Register
      </RouterLink>
    </div>
  </div>
</template>
