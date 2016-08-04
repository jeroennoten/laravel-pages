<template>
    <p style="position: relative;">
        <textarea name="test" class="form-control" v-el:ckeditor :value="content"></textarea>
        <button class="btn btn-danger btn-xs btn-flat"
                style="position: absolute; top: 0; right: 0;"
                type="button"
                @click="remove"
                data-toggle="tooltip"
                title="Verwijderen"
        >
            <i class="fa fa-fw fa-trash"></i>
        </button>
    </p>
</template>

<script>
    export default {
        props: ['content', 'config'],
        ready() {
            CKEDITOR.replace(this.$els.ckeditor).on('change', ({editor}) => {
                editor.updateElement();
                this.update(this.$els.ckeditor.value);
            });
        },
        methods: {
            update(value) {
                this.$emit('update', value);
            },
            remove() {
                this.$emit('remove');
            }
        }
    }
</script>