<template>
    <header class="container mx-auto py-4">
        <nav class="flex flex-wrap items-center
          justify-between w-full
          lg:py-0 px-4 lg:px-0 text-lg"
        >
            <div class="logo">
                <a href="#" class="text-3xl font-bold text">Booking.com.ua</a>
            </div>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                id="menu-button"
                class="h-6 w-6 cursor-pointer lg:hidden block"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>

            <div class="hidden w-full lg:flex lg:items-center lg:w-auto" id="menu">
                <ul class="pt-4 text-base text-gray-700
                    lg:flex lg:justify-between lg:pt-0"
                >
                    <li>
                        <a class="mr-0 lg:mr-2 block
                    hover:text-blue-700 text-base lg:text-xl
                    border-b-2 lg:border-b-0 py-2 lg:py-0"
                           href="#"
                        >
                            Головна
                        </a>
                    </li>
                    <li>
                        <a class="mr-0 lg:mr-2 block
                    hover:text-blue-700 text-base lg:text-xl
                    border-b-2 lg:border-b-0 py-2 lg:py-0"
                           href="#"
                        >
                            Обрати помешкання</a>
                    </li>
                    <li>
                        <a class="mr-0 lg:mr-2 block
                    hover:text-blue-700 text-base lg:text-xl
                    border-b-2 lg:border-b-0 py-2 lg:py-0"
                           href="#"
                        >
                            Зареєструватися
                        </a>
                    </li>
                    <li>
                        <a class="block
                    hover:text-blue-700 text-base lg:text-xl py-2 lg:py-0"
                           href="#"
                        >
                            Увійти
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "HeaderBar"
}
</script>

<style scoped>

</style>
