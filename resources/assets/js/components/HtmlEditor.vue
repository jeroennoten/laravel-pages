<template>
    <div>
        <textarea name="test" class="form-control" v-el:ckeditor :value="content"></textarea>
    </div>
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
            }
        }
    }
</script>