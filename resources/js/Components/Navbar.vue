<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <nav class="navbar-dark">
    <Popover class="relative">
      <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center py-2 md:justify-start md:space-x-10">
          <div class="flex justify-start lg:w-0 lg:flex-1">
            <a href="#">
              <span class="sr-only">Workflow</span>
              <img
                alt
                class="h-8 w-auto sm:h-10"
                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
              />
              <span class="text-white">CINEMA</span>
            </a>
          </div>
          <div class="-mr-2 -my-2 md:hidden">
            <PopoverButton
              class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            >
              <span class="sr-only">Open menu</span>
            </PopoverButton>
          </div>
          <PopoverGroup
            as="nav"
            class="hidden md:flex space-x-10"
          >
            <Popover
              class="relative"
              v-slot="{ open }"
            >
              <PopoverButton
                :class="[open ? 'text-gray-300' : 'text-white', 'group rounded-md inline-flex items-center text-base font-medium hover:text-gray-300 focus:outline-none']"
              >
                <span>Menu popover</span>
              </PopoverButton>

              <transition
                enter-active-class="transition ease-out duration-200"
                enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-1"
              >
                <PopoverPanel
                  class="absolute z-10 -ml-4 mt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2"
                >
                  <div
                    class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden"
                  >
                    <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                      <a
                        :href="item.href"
                        :key="item.name"
                        class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"
                        v-for="item in solutions"
                      >
                        <div class="ml-4">
                          <p class="text-base font-medium text-gray-900">{{ item.name }}</p>
                          <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                        </div>
                      </a>
                    </div>
                    <div
                      class="px-5 py-5 bg-gray-50 space-y-6 sm:flex sm:space-y-0 sm:space-x-10 sm:px-8"
                    >
                      <div
                        :key="item.name"
                        class="flow-root"
                        v-for="item in callsToAction"
                      >
                        <a
                          :href="item.href"
                          class="-m-3 p-3 flex items-center rounded-md text-base font-medium text-gray-900 hover:bg-gray-100"
                        >
                          <span class="ml-3">{{ item.name }}</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </PopoverPanel>
              </transition>
            </Popover>
          </PopoverGroup>
          <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
            <a
              class="whitespace-nowrap text-base font-medium text-white hover:text-gray-300"
              href="#"
            >Iniciar Sesión</a>
            <a
              class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
              href="#"
            >Registrarse</a>
          </div>
        </div>
      </div>

      <transition
        enter-active-class="duration-200 ease-out"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="duration-100 ease-in"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
      >
        <PopoverPanel
          class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
          focus
        >
          <div
            class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50"
          >
            <div class="pt-5 pb-6 px-5">
              <div class="flex items-center justify-between">
                <div>
                  <img
                    alt="Workflow"
                    class="h-8 w-auto"
                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                  />
                </div>
                <div class="-mr-2">
                  <PopoverButton
                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                  >
                    <span class="sr-only">Close menu</span>
                  </PopoverButton>
                </div>
              </div>
              <div class="mt-6">
                <nav class="grid gap-y-8">
                  <a
                    :href="item.href"
                    :key="item.name"
                    class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                    v-for="item in solutions"
                  >
                    <span class="ml-3 text-base font-medium text-gray-900">{{ item.name }}</span>
                  </a>
                </nav>
              </div>
            </div>
            <div class="py-6 px-5 space-y-6">
              <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                <a
                  class="text-base font-medium text-gray-900 hover:text-gray-700"
                  href="#"
                >Pricing</a>

                <a
                  class="text-base font-medium text-gray-900 hover:text-gray-700"
                  href="#"
                >Docs</a>
                <a
                  :href="item.href"
                  :key="item.name"
                  class="text-base font-medium text-gray-900 hover:text-gray-700"
                  v-for="item in resources"
                >{{ item.name }}</a>
              </div>
              <div>
                <a
                  class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                  href="#"
                >Sign up</a>
                <p class="mt-6 text-center text-base font-medium text-gray-500">
                  Existing customer?
                  {{ ' ' }}
                  <a
                    class="text-indigo-600 hover:text-indigo-500"
                    href="#"
                  >Sign in</a>
                </p>
              </div>
            </div>
          </div>
        </PopoverPanel>
      </transition>
    </Popover>
  </nav>
</template>

<style scoped>
.navbar-dark {
  background-color: #001622;
}
</style>

<script>
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue'

const solutions = [
  {
    name: 'Analytics',
    description: 'Get a better understanding of where your traffic is coming from.',
    href: '#'
  },
  {
    name: 'Engagement',
    description: 'Speak directly to your customers in a more meaningful way.',
    href: '#'
  },
  { name: 'Security', description: "Your customers' data will be safe and secure.", href: '#', },
  {
    name: 'Integrations',
    description: "Connect with third-party tools that you're already using.",
    href: '#'
  },
  {
    name: 'Automations',
    description: 'Build strategic funnels that will drive your customers to convert',
    href: '#'
  },
]
const callsToAction = [
  { name: 'Watch Demo', href: '#', },
  { name: 'Contact Sales', href: '#', },
]
const resources = [
  {
    name: 'Help Center',
    description: 'Get all of your questions answered in our forums or contact support.',
    href: '#'
  },
  {
    name: 'Guides',
    description: 'Learn how to maximize our platform to get the most out of it.',
    href: '#'
  },
  {
    name: 'Events',
    description: 'See what meet-ups and other events we might be planning near you.',
    href: '#'
  },
  { name: 'Security', description: 'Understand how we take your privacy seriously.', href: '#', },
]
const recentPosts = [
  { id: 1, name: 'Boost your conversion rate', href: '#' },
  { id: 2, name: 'How to use search engine optimization to drive traffic to your site', href: '#' },
  { id: 3, name: 'Improve your customer experience', href: '#' },
]

export default {
  components: {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
  },
  setup () {
    return {
      solutions,
      callsToAction,
      resources,
      recentPosts,
    }
  },
}
</script>
