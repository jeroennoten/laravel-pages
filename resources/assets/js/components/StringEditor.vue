<template>
    <input class="form-control" :style="config.css" v-model="content">
</template>

<script>
    export default {
        props: ['content', 'config'],
        watch: {
            content(value) {
                this.$emit('update', value);
            }
        }
    }
</script>