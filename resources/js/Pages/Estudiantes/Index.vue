<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  estudiantes: Array
})

// 🔒 Cerrar sesión
const logout = () => {
  router.post('/logout')
}
</script>

<template>
  <div
    class="min-h-screen flex flex-col items-center px-6 py-10 text-white"
    style="background: linear-gradient(-45deg, #0f172a, #1e1b4b, #3b0764, #450a0a);
           background-size: 400% 400%;
           animation: gradientShift 12s ease infinite;"
  >
    <!-- Encabezado -->
    <header
      class="flex items-center justify-between w-full max-w-6xl px-6 py-4 bg-white/10 backdrop-blur-lg border-b border-white/20 shadow-md rounded-t-2xl"
    >
      <h1 class="text-3xl font-extrabold tracking-wide text-yellow-300 drop-shadow-lg">
        🎓 Listado de Estudiantes
      </h1>

      <div class="flex items-center gap-3">
        <!-- Enlace a Notas -->
        <Link
          href="/notas/index"
          class="bg-gradient-to-r from-sky-500 to-blue-600 hover:from-blue-600 hover:to-sky-500 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-blue-400/40 transition-all duration-200 flex items-center gap-2"
        >
          📘 Ver Notas
        </Link>

        <!-- Nuevo Estudiante -->
        <Link
          href="/estudiantes/create"
          class="bg-gradient-to-r from-violet-600 to-indigo-500 hover:from-indigo-500 hover:to-violet-600 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-violet-400/40 transition-all duration-200 flex items-center gap-2"
        >
          ➕ Nuevo Estudiante
        </Link>

        <!-- 🔒 Cerrar sesión -->
        <form @submit.prevent="logout" class="inline">
          <button
            type="submit"
            class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold px-5 py-2 rounded-xl shadow-md hover:shadow-red-400/40 transition-all duration-200 flex items-center gap-2"
          >
            🚪 Cerrar sesión
          </button>
        </form>
      </div>
    </header>

    <!-- Tabla -->
    <main class="w-full max-w-6xl mt-8 bg-white/10 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20 animate-fadeIn">
      <table class="w-full text-sm text-left border-collapse">
        <thead class="text-yellow-300 uppercase border-b border-white/30 text-sm">
          <tr>
            <th class="px-4 py-3">#</th>
            <th class="px-4 py-3">Código</th>
            <th class="px-4 py-3">Nombres</th>
            <th class="px-4 py-3">Apellidos</th>
            <th class="px-4 py-3">DNI</th>
            <th class="px-4 py-3">Carrera</th>
            <th class="px-4 py-3 text-center">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(est, index) in props.estudiantes"
            :key="est.id"
            class="border-b border-white/10 hover:bg-white/10 transition-colors"
          >
            <td class="px-4 py-3 text-gray-300">{{ index + 1 }}</td>
            <td class="px-4 py-3">{{ est.codigo }}</td>
            <td class="px-4 py-3">{{ est.nombres }}</td>
            <td class="px-4 py-3">{{ est.pri_ape }} {{ est.seg_ape }}</td>
            <td class="px-4 py-3">{{ est.dni }}</td>
            <td class="px-4 py-3">{{ est.carrera }}</td>

            <td class="px-4 py-3 text-center flex justify-center gap-2">
              <Link
                :href="`/estudiantes/edit/${est.id}`"
                class="bg-gradient-to-r from-yellow-500 to-orange-400 hover:from-orange-500 hover:to-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-yellow-400/40 transition-all"
              >
                ✏️ Editar
              </Link>

              <Link
                :href="`/estudiantes/delete/${est.id}`"
                class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-red-400/40 transition-all"
              >
                🗑️ Eliminar
              </Link>

              <!-- 📄 Notas del estudiante -->
              <Link
                :href="`/notas/index?estudiante_id=${est.id}`"
                class="bg-gradient-to-r from-sky-600 to-cyan-500 hover:from-cyan-500 hover:to-sky-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:shadow-cyan-400/40 transition-all"
              >
                📄 Ver Notas
              </Link>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="!props.estudiantes.length" class="text-center text-white/70 mt-6 text-lg">
        No hay estudiantes registrados aún 😔
      </div>
    </main>
  </div>
</template>

<style scoped>
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
</style>
