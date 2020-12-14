<template>
  <div>
    <CRow style="margin-bottom: 1rem">
      <CCol>
        <h5>{{ data.Question }}</h5>
      </CCol>
    </CRow>
    <CRow v-if="data.img_src" style="margin-bottom: 1rem">
      <CCol>
        <CImg
          :src="image_src"
          style="
            margin-left: auto;
            margin-right: auto;
            width: 70%;
            max-height: 480px;
          "
          block
        >
        </CImg>
      </CCol>
    </CRow>
    <CRow style="margin-bottom: 1rem">
      <CCol>
        <quill-editor
          ref="myQuillEditor"
          v-model="content"
          :options="editorOption"
          @blur="onEditorBlur($event)"
          @focus="onEditorFocus($event)"
          @ready="onEditorReady($event)"
        />
      </CCol>
    </CRow>
  </div>
</template>

<script>
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import katex from "katex";
import "katex/dist/katex.min.css";

import { quillEditor } from "vue-quill-editor";
export default {
  name: "EnqQuestion",

  components: {
    quillEditor,
  },
  props: {
    data: Object,
  },
  computed: {
    image_src() {
      return this.$apiAdress + "/storage/image/" + this.data.img_src;
    },
    editor() {
      return this.$refs.myQuillEditor.quill;
    },
  },
  mounted() {
    console.log("this is current quill instance object", this.editor);
    window.katex = katex;
  },
  data() {
    return {
      content: "<h2>I am Example</h2>",
      editorOption: {
        // Some Quill options...
        modules: {
          toolbar: [
            ["bold", "italic", "underline", "strike"],
            [{ list: "ordered" }, { list: "bullet" }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
            ["image"],
            ["formula"],
          ],
        },
      },
    };
  },
  methods: {
    onEditorBlur(quill) {
      console.log("editor blur!", quill);
    },
    onEditorFocus(quill) {
      console.log("editor focus!", quill);
    },
    onEditorReady(quill) {
      console.log("editor ready!", quill);
    },
    onEditorChange({ quill, html, text }) {
      console.log("editor change!", quill, html, text);
      this.content = html;
    },
  },
};
</script>

<style>
</style>