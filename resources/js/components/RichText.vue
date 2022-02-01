<template>
  <div class="editor" v-if="editor">
    <rich-text-header class="editor__header" :editor="editor" />
    <editor-content class="editor__content" :editor="editor" />
  </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-2';
import StarterKit from '@tiptap/starter-kit';
import RichTextHeader from '@/components/RichTextHeader';

export default {
  components: {
    EditorContent,
    RichTextHeader,
  },
  props: {
    value: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      editor: null,
    };
  },

  mounted() {
    this.editor = new Editor({
      extensions: [
        StarterKit.configure({
          history: false,
        }),
      ],
      onUpdate: () => {
        this.$emit('input', this.editor.getHTML());
      },
    });
  },

  beforeDestroy() {
    this.editor.destroy();
  },

  watch: {
    value(value) {
      // HTML
      const isSame = this.editor.getHTML() === value;

      if (isSame) {
        return;
      }

      this.editor.commands.setContent(value, false);
    },
  },
};
</script>

<style lang="scss">
.editor {
  @apply flex flex-col bg-secondary text-yellow-600 border border-gray-400 rounded-md p-0 text-white;
  max-height: 26rem;

  &__header {
    @apply bg-primary flex items-center justify-between flex-wrap w-full p-3;
  }

  &__content {
    @apply p-6;
    flex: 1 1 auto;
    overflow-x: hidden;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
  }
}
</style>

<style lang="scss">
.ProseMirror {
  min-height: 15rem;

  &:focus,
  &:focus-visible {
    @apply outline-none;
  }

  * {
    @apply text-white;
  }
  > * + * {
    margin-top: 0.75em;
  }

  ul,
  ol {
    @apply pl-8 list-none;
  }

  ol {
    counter-reset: li;

    li p::before {
      @apply text-white inline-block -ml-4 w-6;
      content: counter(li);
    }
    li {
      counter-increment: li;
    }
  }

  ul {
    p::before {
      @apply -ml-4 font-bold text-white inline-block w-6;
      content: '\2022'; /* Add content: \2022 is the CSS Code/unicode for a bullet */
    }
  }
  img {
    max-width: 100%;
    height: auto;
  }
}
</style>
