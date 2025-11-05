<template>
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <!-- Botón Volver -->
    <div class="mb-4">
  <Link
    :href="route('estudiantes.index')"
    class="bg-gray-300 text-gray-800 py-2 px-4 rounded-lg shadow hover:bg-gray-400 transition"
  >
    ← Volver
  </Link>
</div>


    <h1 class="text-2xl font-bold mb-6 text-indigo-600 text-center">
      Listado de Notas Simuladas
    </h1>

    <!-- Tabla de notas -->
    <div v-if="notas.length > 0" class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded-lg">
        <thead class="bg-indigo-600 text-white">
          <tr>
            <th class="py-3 px-4 text-left">#</th>
            <th class="py-3 px-4 text-left">Estudiante</th>
            <th class="py-3 px-4 text-center">Participación</th>
            <th class="py-3 px-4 text-center">Habilidades</th>
            <th class="py-3 px-4 text-center">Asistencia</th>
            <th class="py-3 px-4 text-center">Entregable</th>
            <th class="py-3 px-4 text-center">Examen Final</th>
            <th class="py-3 px-4 text-center">Video Test</th>
            <th class="py-3 px-4 text-center">Evaluación Parcial</th>
            <th class="py-3 px-4 text-center">Promedio</th>
            <th class="py-3 px-4 text-center">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(nota, index) in notas"
            :key="index"
            class="border-b hover:bg-gray-50 transition"
          >
            <td class="py-2 px-4">{{ index + 1 }}</td>
            <td class="py-2 px-4">{{ nota.estudiante ?? '—' }}</td>
            <td class="py-2 px-4 text-center">{{ nota.participacion }}</td>
            <td class="py-2 px-4 text-center">{{ nota.habilidades }}</td>
            <td class="py-2 px-4 text-center">{{ nota.asistencia }}</td>
            <td class="py-2 px-4 text-center">{{ nota.entregable }}</td>
            <td class="py-2 px-4 text-center">{{ nota.examen_final }}</td>
            <td class="py-2 px-4 text-center">{{ nota.video_test }}</td>
            <td class="py-2 px-4 text-center">{{ nota.evaluacion_parcial }}</td>
            <td class="py-2 px-4 text-center font-semibold text-indigo-600">
              {{ nota.promedio_final }}
            </td>
            <td
              class="py-2 px-4 text-center font-semibold"
              :class="nota.estado.includes('APROBADO') ? 'text-green-600' : 'text-red-600'"
            >
              {{ nota.estado }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-center py-6 text-gray-500">
      No se encontraron notas simuladas.
    </div>

    <div class="mt-6 text-center">
      <Link
        href="/notas/simulacion"
        class="bg-indigo-600 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-700 transition"
      >
        Ir a Simulación
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  notas: {
    type: Array,
    default: () => [],
  },
});
</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
}
</style>
