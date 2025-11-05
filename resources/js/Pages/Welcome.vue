<script setup>
import { Head, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const processing = ref(false)
const showToast = ref(false)

const logout = () => {
  if (processing.value) return
  processing.value = true

  router.post('/logout', {}, {
    onSuccess: () => {
      showToast.value = true
      // Espera 2 segundos, oculta el toast y redirige al login
      setTimeout(() => {
        showToast.value = false
        window.location.href = '/login'
      }, 2000)
    },
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>

<template>
  <Head title="Bienvenido" />

  <!-- Fondo animado -->
  <div class="min-h-screen flex flex-col font-sans text-white bg-[length:400%_400%] animate-[gradientShift_12s_ease_infinite] bg-[linear-gradient(-45deg,#0f172a,#1e1b4b,#3b0764,#450a0a)]">

    <!-- Toast superior centrado -->
    <transition name="fade">
      <div
        v-if="showToast"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 text-sm font-medium animate-fadeIn z-50"
      >
        ✅ Sesión cerrada correctamente
      </div>
    </transition>

    <!-- Barra superior -->
    <header class="flex items-center justify-between px-8 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md">
      <!-- Logo -->
      <div class="flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-10 h-10 text-yellow-300 drop-shadow-lg">
          <circle cx="32" cy="32" r="30" fill="currentColor" opacity="0.15" />
          <path
            d="M16 36l8 8 24-24"
            fill="none"
            stroke="currentColor"
            stroke-width="4"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
        <h1 class="text-2xl font-extrabold tracking-wide">
          <span class="text-yellow-300">Gestor</span> de Notas
        </h1>
      </div>

      <!-- Botón cerrar sesión -->
      <button
        @click="logout"
        :disabled="processing"
        class="bg-gradient-to-r from-red-600 to-rose-600 hover:from-rose-600 hover:to-red-600 transition-all duration-200 px-5 py-2 rounded-xl font-semibold shadow-md hover:shadow-rose-400/30 flex items-center gap-2 hover-glow disabled:opacity-60 disabled:cursor-not-allowed"
      >
        <span v-if="processing" class="flex items-center gap-2">
          <svg class="w-5 h-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
          </svg>
          Cerrando sesión...
        </span>
        <span v-else>🚪 Cerrar sesión</span>
      </button>
    </header>

    <!-- Contenido principal -->
    <main class="flex-grow flex flex-col justify-center items-center px-6 py-10">
      <div class="text-center bg-white/10 backdrop-blur-xl p-10 rounded-3xl shadow-2xl border border-white/20 w-[90%] md:w-[500px] animate-fadeIn">
        <h2 class="text-4xl font-extrabold mb-6 drop-shadow-md">
          🌙 ¡Bienvenido de nuevo!
        </h2>

        <div class="flex flex-col gap-6 mt-4">
          <!-- Enlace estudiantes -->
          <a
            href="/estudiantes"
            class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold py-4 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all transform hover:-translate-y-1 hover-glow flex items-center justify-center gap-3 text-lg"
          >
            🎓 <span>Estudiantes</span>
          </a>
        </div>

        <p class="text-sm text-white/60 mt-10">
          © {{ new Date().getFullYear() }} —
          <span class="text-violet-400 font-medium">Gestor de Notas</span><br />
          Todos los derechos reservados.
        </p>
      </div>
    </main>
  </div>
</template>

<style>
@keyframes gradientShift {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}

.hover-glow:hover {
  box-shadow: 0 0 20px rgba(139, 92, 246, 0.4);
  transform: translateY(-2px);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
