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
            let token = $('meta[name="csrf-token"]').attr('content');

            CKEDITOR.replace(this.$els.ckeditor, {
                "toolbarGroups": [{
                    "name": "document",
                    "groups": ["mode", "document", "doctools"]
                }, {"name": "document", "groups": ["mode", "document", "doctools"]}, {
                    "name": "clipboard",
                    "groups": ["clipboard", "undo"]
                }, {"name": "editing", "groups": ["find", "selection", "spellchecker", "editing"]}, {
                    "name": "forms",
                    "groups": ["forms"]
                }, "\/", {"name": "basicstyles", "groups": ["basicstyles", "cleanup"]}, {
                    "name": "paragraph",
                    "groups": ["list", "indent", "blocks", "align", "bidi", "paragraph"]
                }, {"name": "links", "groups": ["links"]}, {
                    "name": "insert",
                    "groups": ["insert"]
                }, "\/", {"name": "styles", "groups": ["styles"]}, {
                    "name": "colors",
                    "groups": ["colors"]
                }, {"name": "tools", "groups": ["tools"]}, {"name": "others", "groups": ["others"]}, {
                    "name": "about",
                    "groups": ["about"]
                }],
                "removeButtons": "Save,NewPage,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Flash,Smiley,PageBreak,Iframe",
                "filebrowserImageUploadUrl": "\/ckeditor\/images?_token=" + token,
                "uploadUrl": "\/ckeditor\/images?_token=" + token + "&json",
                "extraPlugins": "uploadimage"
            }).on('change', ({editor}) => {
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