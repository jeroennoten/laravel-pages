import StringEditor from './components/StringEditor.vue';
import HtmlEditor from './components/HtmlEditor.vue';
import ViewEditor from './components/ViewEditor.vue';

export default {
    stringEditor(resolve) {
        resolve(StringEditor)
    },
    htmlEditor(resolve){
        resolve(HtmlEditor)
    },
    viewEditor(resolve) {
        resolve(ViewEditor)
    }
}