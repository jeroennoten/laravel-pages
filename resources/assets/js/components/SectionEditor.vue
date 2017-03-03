<template>
    <div class="form-group">
        <label v-if="section.name">{{ section.name }}</label>
        <content-editor v-for="content in contents"
                        :content="content"
                        :section="section"
                        @remove="remove(content)"
                        @update="update"
        ></content-editor>
        <div class="form-group" v-if="adding">
            <select v-model="newType">
                <option v-for="type in section.types" :value="type.id">
                    {{ type.config.name }}
                </option>
            </select>
            <button type="button" class="btn btn-success btn-xs" @click="addContent(newType)">
                OK
            </button>
        </div>
        <p v-if="canAdd && !adding">
            <button class="btn btn-success btn-xs" @click="newContent">
                <i class="fa fa-plus"></i> Toevoegen
            </button>
        </p>
    </div>
</template>

<script>
    import ContentEditor from './ContentEditor.vue';
    import types from '../types';

    export default {
        props: ['section', 'view'],
        data() {
            return {
                adding: false,
                newType: null,
            }
        },
        computed: {
            contents() {
                return this.view.contents.filter(content => content.section == this.section.id);
            },
            canAdd() {
                return this.section.max > this.contents.length || this.section.max == null;
            }
        },
        methods: {
            newContent() {
                let types = Object.keys(this.section.types);
                if (types.length == 1) {
                    this.addContent(types[0]);
                } else {
                    this.newType = types[0];
                    this.adding = true;
                }
            },
            addContent(type) {
                this.adding = false;
                this.view.contents.push({
                    section: this.section.id,
                    type,
                });
                this.update();
            },
            remove(content) {
                this.view.contents.splice(this.view.contents.indexOf(content), 1);
                this.update();
            },
            update() {
                this.$emit('update');
            }
        }
    }
</script>