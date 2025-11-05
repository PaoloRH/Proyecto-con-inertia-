<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
  <Head title="Register" />

  <main class="container">
    <!-- Lado izquierdo: información de la app -->
    <section class="brand-card">
      <div class="logo">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="g" x1="0" x2="1" y1="0" y2="1">
              <stop offset="0" stop-color="#8b5cf6"/>
              <stop offset="1" stop-color="#0ea5e9"/>
            </linearGradient>
          </defs>
          <rect width="100" height="100" rx="18" fill="url(#g)" />
          <circle cx="50" cy="50" r="18" fill="#0f172a" opacity="0.9" />
        </svg>

        <div>
          <div class="brand-title">Gestor de Notas</div>
          <div class="brand-sub">Registro de nuevo usuario</div>
        </div>
      </div>

      <p class="hero">
        Crea tu cuenta para acceder al sistema de gestión académica 🌌
      </p>

      <p class="foot-note">
        © {{ new Date().getFullYear() }} Gestor de Notas — Seguridad primero.
      </p>
    </section>

    <!-- Lado derecho: formulario de registro -->
    <section class="form-card">
      <h1>Registro</h1>

      <form @submit.prevent="submit" novalidate>
        <div>
          <label for="name">Nombre</label>
          <input
            id="name"
            type="text"
            v-model="form.name"
            class="input"
            placeholder="Nombre completo"
            required
            autofocus
            autocomplete="name"
          />
          <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
        </div>

        <div class="mt-4">
          <label for="email">Correo electrónico</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            class="input"
            placeholder="correo@dominio.com"
            required
            autocomplete="username"
          />
          <div v-if="form.errors.email" class="error">{{ form.errors.email }}</div>
        </div>

        <div class="mt-4">
          <label for="password">Contraseña</label>
          <input
            id="password"
            type="password"
            v-model="form.password"
            class="input"
            placeholder="••••••••"
            required
            autocomplete="new-password"
          />
          <div v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
        </div>

        <div class="mt-4">
          <label for="password_confirmation">Confirmar Contraseña</label>
          <input
            id="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            class="input"
            placeholder="••••••••"
            required
            autocomplete="new-password"
          />
          <div v-if="form.errors.password_confirmation" class="error">
            {{ form.errors.password_confirmation }}
          </div>
        </div>

        <div class="mt-4 flex items-center justify-end">
          <Link href="/login" class="underline text-gray-400 hover:text-white text-sm">
            ¿Ya tienes cuenta?
          </Link>

          <button
            type="submit"
            class="btn ms-4"
            :disabled="form.processing"
          >
            {{ form.processing ? 'Registrando...' : 'Registrar' }}
          </button>
        </div>
      </form>
    </section>
  </main>
</template>

<style>
/* Copiado y adaptado de Login.vue para mantener coherencia */
:root {
  --bg: #0a0a0f;
  --card: rgba(255, 255, 255, 0.07);
  --accent: #8b5cf6;
  --accent2: #0ea5e9;
  --muted: #a1a1aa;
  --white: #f8fafc;
  --radius: 14px;
  --shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
  font-family: 'Inter', system-ui, sans-serif;
}

html, body {
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 0;
}

body {
  background: linear-gradient(-45deg, #0f172a, #1e1b4b, #3b0764, #450a0a);
  background-size: 400% 400%;
  animation: gradientShift 12s ease infinite;
  color: var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.container {
  width: 100%;
  max-width: 980px;
  display: grid;
  grid-template-columns: 420px 1fr;
  gap: 32px;
  align-items: center;
  backdrop-filter: blur(18px);
  min-height: 100vh;
  margin: auto;
}

.brand-card {
  background: var(--card);
  border-radius: var(--radius);
  padding: 40px;
  box-shadow: var(--shadow);
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.logo {
  display: flex;
  align-items: center;
  gap: 14px;
}
.brand-title {
  font-size: 22px;
  font-weight: 700;
  color: var(--accent);
}
.brand-sub {
  color: var(--muted);
  font-size: 14px;
}
.hero { font-size: 15px; color: #d1d5db; }
.foot-note { font-size: 12px; color: #9ca3af; margin-top: auto; }

.form-card {
  background: var(--card);
  border-radius: var(--radius);
  padding: 36px;
  box-shadow: var(--shadow);
  min-width: 380px;
}
h1 { margin-bottom: 10px; font-size: 24px; font-weight: 700; color: #e0e7ff; }

label { display: block; font-size: 14px; color: var(--muted); margin-bottom: 6px; }
.input {
  width: 100%;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255,255,255,0.1);
  padding: 12px 14px;
  border-radius: 10px;
  color: var(--white);
  font-size: 15px;
  transition: all 0.25s ease;
}
.input:focus {
  border-color: var(--accent);
  box-shadow: 0 0 12px rgba(139, 92, 246, 0.4);
  outline: none;
}

.btn {
  width: 100%;
  background: linear-gradient(90deg, var(--accent), var(--accent2));
  color: #0f172a;
  font-weight: 700;
  padding: 12px 14px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  font-size: 16px;
  margin-top: 10px;
}
.btn:hover {
  transform: scale(1.03);
  box-shadow: 0 6px 18px rgba(139, 92, 246, 0.4);
}
.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.error {
  color: #fb7185;
  font-size: 13px;
  margin-top: 6px;
}

@media (max-width: 880px) {
  .container {
    grid-template-columns: 1fr;
    padding: 10px;
  }
  .brand-card { order: 2; text-align: center; }
  .form-card { order: 1; min-width: unset; }
}
</style>
