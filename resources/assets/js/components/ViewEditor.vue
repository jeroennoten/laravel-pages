<template>
    <div>
        <div class="box box-primary box-solid" v-if="content">
            <div class="box-header with-border">
                <h3 class="box-title">{{ content.layout.name }}</h3>
                <div class="box-tools pull-right">
                    <button type="button"
                            class="btn btn-box-tool"
                            @click="remove"
                            v-if="removeable"
                    >
                        <i class="fa fa-trash"></i> Verwijderen
                    </button>
                </div>
            </div>
            <div class="box-body">
                <section-editor v-for="section in content.layout.sections"
                                :section="section"
                                :view="content"
                                @update="update"
                ></section-editor>
            </div>
        </div>
        <p class="text-center" v-else>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        </p>
    </div>
</template>

<script>
    import {Layout} from '../resources';

    export default {
        props: {
            'content': {},
            'config': {},
            'removeable': {
                default: true
            }
        },
        ready() {
            if (!this.content) {
                Layout.get({id: this.config.layouts[0]}).then(response => {
                    this.content = {
                        layout: response.json(),
                        contents: [],
                    };
                    this.update();
                })
            }
        },
        methods: {
            remove() {
                this.$emit('remove');
            },
            update() {
                this.$emit('update', this.content);
            }
        }
    }
</script>