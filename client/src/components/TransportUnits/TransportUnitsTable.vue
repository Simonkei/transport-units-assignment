<template>
  <div v-if="!loading" class="rounded-lg overflow-hidden shadow-inner">
    <table class="w-full border-collapse">
      <thead class="bg-primary">
        <tr>
          <th class="px-4 py-2 text-left">ID</th>
          <th class="px-4 py-2 text-left">Name</th>
          <th class="px-4 py-2 text-left">Type</th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="border-b border-green-900"
          v-for="unit in transportUnits"
          :key="unit.id"
        >
          <td class="px-4 py-2 text-left">{{ unit.id }}</td>
          <td class="px-4 py-2 text-left">{{ unit.name }}</td>
          <td class="px-4 py-2 text-left">{{ unit.type }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-if="loading" class="flex flex-col justify-center align-center gap-4">
    <v-progress-circular color="primary" indeterminate size="75" width="6" />
    <p>Loading...</p>
  </div>
  <div
    v-if="!transportUnits.length && !loading"
    class="flex flex-col justify-center align-center mt-4"
  >
    No results..
  </div>
</template>

<script lang="ts">
import { ITransportUnit } from "@/models/TransportUnit";
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    currentTabType: {
      type: String,
      required: true,
    },
    currentPageNumber: {
      type: Number,
      required: true,
    },
    currentSearchInput: {
      type: String,
      required: false,
    },
  },
  emits: ["new-page", "new-last-page"],
  data() {
    return {
      transportUnits: [] as ITransportUnit[],
      loading: false,
    };
  },
  watch: {
    currentPageNumber() {
      this.fetchTransportUnits();
    },
    currentTabType() {
      this.changePageNumber(1);
      this.fetchTransportUnits();
    },
    currentSearchInput() {
      this.changePageNumber(1);
      this.fetchTransportUnits();
    },
  },
  methods: {
    async fetchTransportUnits() {
      this.loading = true;
      const searchInput = this.currentSearchInput ?? "";

      const res = await fetch(
        `http://127.0.0.1:8000/api/transportUnits?type=${this.currentTabType}&page=${this.currentPageNumber}&search=${searchInput}`
      );

      const data = await res.json();

      this.transportUnits = data.data;
      this.$emit("new-last-page", data.last_page);
      this.loading = false;
    },
    changePageNumber(newPageNumber: number) {
      this.$emit("new-page", newPageNumber);
    },
  },
});
</script>
