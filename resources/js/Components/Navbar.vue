<script setup>
import { reactive } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'

const userInfo = reactive(usePage().props.value.auth.user);

const navigation = [
  { name: 'Inicio', to: 'home', current: false },
  { name: 'Google', to: 'https://google.com', current: false },
]

</script>

<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Disclosure
    as="nav"
    class="bg-gray-800"
    v-slot="{ open }"
  >
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <DisclosureButton
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          >
            <span class="sr-only">Abrir menú</span>
            <MenuIcon
              aria-hidden="true"
              class="block h-6 w-6"
              v-if="!open"
            />
            <XIcon
              aria-hidden="true"
              class="block h-6 w-6"
              v-else
            />
          </DisclosureButton>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex-shrink-0 flex items-center">
            <h3 class="text-white">CINEMA</h3>
          </div>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <div v-for="item in navigation">
                <Link
                  :aria-current="item.current ? 'page' : undefined"
                  :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']"
                  :href="route(item.to)"
                  :key="item.name"
                  v-if="item.to.indexOf('http') == -1"
                >{{ item.name }}</Link>
                <a
                  :aria-current="item.current ? 'page' : undefined"
                  :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']"
                  :href="item.to"
                  :key="item.name"
                  target="_blank"
                  v-else
                >{{ item.name }}</a>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div
            class="hidden sm:block inset-y-0"
            v-if="!userInfo"
          >
            <Link
              :href="route('login')"
              class="whitespace-nowrap text-base font-medium text-white hover:text-gray-300"
            >Iniciar Sesión</Link>
            <Link
              :href="route('register')"
              class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
            >Registrarse</Link>
          </div>
          <div
            class="flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 inset-y-0"
            v-else
          >
            <button
              class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
              type="button"
            >
              <span class="sr-only">View notifications</span>
              <BellIcon
                aria-hidden="true"
                class="h-6 w-6"
              />
            </button>

            <!-- Profile dropdown -->
            <Menu
              as="div"
              class="ml-3 relative"
            >
              <div>
                <MenuButton
                  class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                >
                  <span class="sr-only">Open user menu</span>
                  <img
                    alt
                    class="h-8 w-8 rounded-full"
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  />
                </MenuButton>
              </div>
              <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
              >
                <MenuItems
                  class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <MenuItem v-slot="{ active }">
                    <a
                      :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']"
                      href="#"
                    >Your Profile</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a
                      :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']"
                      href="#"
                    >Settings</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a
                      :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']"
                      href="#"
                    >Sign out</a>
                  </MenuItem>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <DisclosureButton
          :aria-current="item.current ? 'page' : undefined"
          :class="[item.current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium']"
          :href="item.href"
          :key="item.name"
          as="a"
          v-for="item in navigation"
        >{{ item.name }}</DisclosureButton>
      </div>
      <hr class="border-slate-600" />
      <div
        class="flex justify-center items-center py-2"
        v-if="!userInfo"
      >
        <Link
          :href="route('login')"
          class="whitespace-nowrap text-base font-medium text-white hover:text-gray-300"
        >Iniciar Sesión</Link>
        <Link
          :href="route('register')"
          class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
        >Registrarse</Link>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>
