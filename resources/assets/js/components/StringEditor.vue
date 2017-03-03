<template>
    <div style="display: flex">
        <input class="form-control" :style="config.css" v-model="content">
        <button class="btn btn-danger btn-xs btn-flat"
                type="button"
                @click="remove"
                data-toggle="tooltip"
                title="Verwijderen"
        >
            <i class="fa fa-fw fa-trash"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: ['content', 'config'],
        methods: {
            remove() {
                this.$emit('remove');
            }
        },
        ready () {
            this.$emit('update', this.content || '');
        },
        watch: {
            content(value) {
                this.$emit('update', value);
            }
        }
    }
</script>