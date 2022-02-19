<template>
    <div>
        <form @submit.prevent="submit">
            <input type="text" v-model="this.form.test">
            <button type="submite"></button>
        </form>
        <!-- <img :src="this.image" alt=""> -->
    </div>
</template>

<script>
import {useForm} from '@inertiajs/inertia-vue3';

export default {
    props: {
        // image: String,
    },

    data() {
        return{
            form: {},
            submitting: false,
        }
    },

    mounted() {
      this.form = useForm({
          test: '',
      });
    },

    methods: {
        submit() {
            if(this.submitting)
                return;

            this.submitting = true;

            this.form.post('/test/post', {
                onFinish: () => {
                    this.submitting = false;
                    console.log(this.form);
                }
            });
        }
    }
}
</script>
