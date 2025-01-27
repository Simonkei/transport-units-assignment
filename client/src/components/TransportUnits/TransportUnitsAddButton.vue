<template>
  <v-btn color="primary" prepend-icon="mdi-plus" @click="dialog = true">
    Add Transport Unit
  </v-btn>
  <v-dialog v-model="dialog" max-width="500">
    <TransportUnitsAddButtonDialog
      @new-unit="$emit('new-unit')"
      @close-dialog="dialog = false"
    />
  </v-dialog>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  emits: ["new-unit"],
  data() {
    return {
      dialog: false,
    };
  },
});
</script>
