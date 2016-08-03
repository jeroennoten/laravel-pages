<template>
    <span>
        <button type="button" class="btn btn-success" @click="save" :disabled="saving">
            <i class="fa fa-fw fa-spinner fa-pulse" v-if="saving"></i>
            <i class="fa fa-fw fa-save" v-else></i>
            Pagina opslaan
        </button>
    </span>
</template>

<script>
    export default {
        props: ['saving'],
        methods: {
            save() {
                if (!this.saving) {
                    this.$emit('save');
                }
            }
        }
    }
</script>