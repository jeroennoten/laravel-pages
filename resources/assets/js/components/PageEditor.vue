<template>
    <div>
        <p>
            <save-button @save="save" :saving="saving"></save-button>
        </p>
        <div class="box">
            <div class="box-body">
                <div class="checkbox no-margin">
                    <label>
                        <input type="checkbox" v-model="page.active"> Actief
                    </label>
                    <p class="help-block" style="margin-bottom: 0;" v-if="page.active">Schakel 'actief' uit om de pagina verborgen
                        te maken voor publiek.</p>
                    <p class="help-block" style="margin-bottom: 0;" v-else>Schakel 'actief' in om de pagina
                        zichtbaar te maken voor publiek.</p>
                </div>
            </div>
        </div>
        <view-editor :content="page.view" :removeable="false"></view-editor>
        <p>
            <save-button @save="save" :saving="saving"></save-button>
        </p>
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