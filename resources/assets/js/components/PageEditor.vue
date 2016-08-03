<template>
    <div>
        <p><save-button @save="save" :saving="saving"></save-button></p>
        <view-editor :content="page.view" :removeable="false"></view-editor>
        <p><save-button @save="save" :saving="saving"></save-button></p>
    </div>
</template>

<script>
    import {Page} from '../resources'

    export default {
        props: ['page'],
        data() {
            return {
                saving: false
            }
        },
        methods: {
            save() {
                this.saving = true;
                Page.update({id: this.page.id}, {page: this.page}).then(() => {
                    this.saving = false;
                });
            }
        }
    }
</script>