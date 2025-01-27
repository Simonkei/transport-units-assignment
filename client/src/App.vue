<template>
  <v-app>
    <v-main>
      <v-container>
        <v-card class="pa-4">
          <v-card-title>Basic transport unit overview</v-card-title>
          <v-card-subtitle>Basic transport unit overview</v-card-subtitle>

          <v-card-text class="mt-8">
            <v-row>
              <v-col cols="12" xl="3" lg="4" md="6" sm="6">
                <TransportUnitsSearchInput v-model="searchInput" />
              </v-col>
            </v-row>

            <div class="flex items-center justify-between">
              <TransportUnitsTabs
                @new-tab="(tabValue: string) => (currentTab = tabValue)"
              />
              <TransportUnitsAddButton
                @new-unit="fetchTransportUnitsFromChild"
              />
            </div>
            <v-divider></v-divider>

            <div class="mt-6">
              <TransportUnitsTable
                ref="transportTable"
                @new-page="((newPageNumber: number) => currentPage = newPageNumber)"
                @new-last-page="((lastPageNumber:number) => lastPage = lastPageNumber)"
                :currentTabType="currentTab"
                :currentPageNumber="currentPage"
                :currentSearchInput="searchInput"
              />
            </div>

            <TransportUnitsPagination
              v-if="lastPage > 1"
              v-model="currentPage"
              :currentLastPage="lastPage"
            />
          </v-card-text>
        </v-card>
      </v-container>
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  data() {
    return {
      currentTab: "",
      currentPage: 1,
      lastPage: 0,
      searchInput: "",
    };
  },
  methods: {
    fetchTransportUnitsFromChild() {
      const transportTable = this.$refs.transportTable as any;
      if (transportTable) {
        transportTable.fetchTransportUnits();
      }
    },
  },
});
</script>
