<template>
  <v-tabs
    color="primary"
    v-model="currentTab"
    @update:model-value="changeTab()"
  >
    <v-tab v-for="tab in tabs" :key="tab.value" :value="tab.value">
      {{ tab.title }}
    </v-tab>
  </v-tabs>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  data() {
    return {
      currentTab: {},
      tabs: [
        { title: "Trucks", value: "truck" },
        { title: "Trailers", value: "trailer" },
      ],
    };
  },
  methods: {
    changeTab() {
      this.$emit("new-tab", this.currentTab);
    },
  },
  mounted() {
    this.currentTab = this.tabs[0].value;
  },
});
</script>
