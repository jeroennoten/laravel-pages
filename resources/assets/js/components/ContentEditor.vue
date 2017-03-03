<template>
    <div>
        <p class="text-center" v-if="loading">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        </p>
        <div v-else>
            <component :is="componentName"
                       :content="data"
                       :config="config"
                       @remove="remove"
                       @update="update"
            ></component>
        </div>
    </div>
</template>

<script>
    import {Content} from '../resources';

    export default {
        props: ['content', 'section'],
        data() {
            return {
                loading: true,
                data: null,
            }
        },
        ready() {
            if (this.content.id) {
                Content.get({id: this.content.id}).then(response => {
                    this.data = response.json().content;
                    this.loading = false;
                });
            } else {
                this.loading = false;
            }
        },
        computed: {
            type() {
                return this.config.type || this.content.type;
            },
            componentName() {
                return `${this.type}Editor`;
            },
            config() {
                return this.section.types[this.content.type].config
            }
        },
        methods: {
            remove() {
                this.$emit('remove');
            },
            update(content) {
                this.content.content = content;
                this.$emit('update', content);
            }
        }
    }
</script>