<template>
    <div>
        <transition appear appear-active-class="welcome-enter-active">
            <div class="text-center font-semibold">
                <div class="text-gray-800 text-5xl">Welcome back, </div>
                <div class="text-gray-700 text-4xl">{{ this.username }}</div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.welcome-enter-active{
    animation: go 0.75s;
}

@keyframes go {
    from {
        opacity: 0;
        transform: translateY(24rem) scale(0.5);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'

    export default defineComponent({
        components: {
            JetApplicationLogo,
        },

        props: {
            username: String
        },
    })
</script>
