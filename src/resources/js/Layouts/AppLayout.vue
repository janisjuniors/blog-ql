<template>
    <div class="container flex flex-col mx-auto w-full md:w-4/5 lg:w-1/2 px-5 pb-10">
        <Header/>
        <slot/>
    </div>
</template>

<script>
import Header from '../Components/Header.vue'

export default {
    components: {
        Header
    }
}
</script>
