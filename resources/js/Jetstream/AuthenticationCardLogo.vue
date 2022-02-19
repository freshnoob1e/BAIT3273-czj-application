<template>
    <Link :href="'/'">
        <img src="/images/logo/OK-logos.jpeg" class="w-24 h-24">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
