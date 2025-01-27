<template>
  <v-pagination
    color="primary"
    :model-value="page"
    @update:model-value="updatePage"
    :length="currentLastPage"
    :total-visible="6"
    class="my-4"
    rounded="lg"
    density="comfortable"
  />
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    currentLastPage: {
      type: Number,
      required: true,
    },
    modelValue: {
      type: Number,
      required: true,
    },
  },
  computed: {
    page: {
      get() {
        return this.modelValue;
      },
      set(value: number) {
        this.$emit("update:modelValue", value);
      },
    },
  },
  methods: {
    updatePage(newPage: number) {
      this.page = newPage;
    },
  },
});
</script>
