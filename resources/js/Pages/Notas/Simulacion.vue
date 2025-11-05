<template>
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-center text-indigo-600">
      Simulación de Notas
    </h2>

    <form @submit.prevent="calcular">
      <div
        v-for="campo in camposNumericos"
        :key="campo.name"
        class="mb-4"
      >
        <label :for="campo.name" class="block text-sm font-semibold text-gray-800">
          {{ campo.label }}
        </label>
        <input
          v-model.number="form[campo.name]"
          type="number"
          :id="campo.name"
          :name="campo.name"
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800"
          required
          step="0.01"
          min="0"
          max="20"
        />
      </div>

      <!-- Campos de lista -->
      <div class="mb-4">
        <label for="video_test" class="block text-sm font-semibold text-gray-800">
          Video Test (1-4)
        </label>
        <input
          v-model="form.video_test"
          id="video_test"
          type="text"
          placeholder="Ejemplo: 15,16,14,17"
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800"
          required
        />
      </div>

      <div class="mb-4">
        <label for="evaluacion_parcial" class="block text-sm font-semibold text-gray-800">
          Evaluación Parcial (1-4)
        </label>
        <input
          v-model="form.evaluacion_parcial"
          id="evaluacion_parcial"
          type="text"
          placeholder="Ejemplo: 12,14,16,18"
          class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800"
          required
        />
      </div>

      <button
        type="submit"
        class="bg-indigo-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full"
      >
        Calcular Promedio
      </button>
    </form>

    <!-- Resultado -->
    <div v-if="resultado" class="mt-8 text-center">
      <h3 class="text-2xl font-semibold text-indigo-600">
        Promedio Final: {{ resultado.promedio_final }} / 20
      </h3>
      <h3
        class="text-lg font-semibold mt-2"
        :class="resultado.estado.includes('APROBADO') ? 'text-green-600' : 'text-red-600'"
      >
        Estado: {{ resultado.estado }}
      </h3>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";

const form = reactive({
  participacion: "",
  habilidades: "",
  asistencia: "",
  video_test: "",
  evaluacion_parcial: "",
  entregable: "",
  examen_final: "",
});

const resultado = ref(null);

const camposNumericos = [
  { name: "participacion", label: "Participación" },
  { name: "habilidades", label: "Habilidades" },
  { name: "asistencia", label: "Asistencia" },
  { name: "entregable", label: "Entregable" },
  { name: "examen_final", label: "Examen Final" },
];

// Acción para enviar los datos a Laravel (ruta inertia)
const calcular = () => {
  router.post(route("notas.simulacion.calcular"), form, {
    onSuccess: (page) => {
      resultado.value = page.props.resultado || null; // 👈 usamos resultado directamente
    },
  });
};
</script>
