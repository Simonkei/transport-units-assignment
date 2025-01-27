<template>
  <v-text-field
    class="mb-2"
    density="compact"
    flat
    variant="solo-filled"
    placeholder="Search for transport units"
    :model-value="search"
    @update:model-value="updateSearch"
    clearable
    hide-details
  />
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    modelValue: {
      type: [String, null],
      required: true,
    },
  },
  computed: {
    search: {
      get() {
        return this.modelValue;
      },
      set(value: string) {
        this.$emit("update:modelValue", value);
      },
    },
  },
  methods: {
    updateSearch(value: string) {
      this.search = value;
    },
  },
});
</script>
