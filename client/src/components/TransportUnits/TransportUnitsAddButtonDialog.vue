<template>
  <v-card>
    <v-form @submit.prevent="createUnit()" ref="form">
      <v-card-title class="bg-primary d-flex justify-between align-center">
        <div>Create new unit</div>

        <v-btn @click="closeDialog()" class="bg-transparent" flat icon>
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text class="my-4">
        <div>
          <label class="font-bold">Name</label>
          <v-text-field
            v-model="nameInput"
            class="mt-2"
            hint="Enter a descriptive name"
            flat
            density="compact"
            variant="solo-filled"
            :rules="[rules.required]"
          />
        </div>

        <div class="mt-4">
          <label class="font-bold">Type</label>
          <v-select
            v-model="typeInput"
            class="mt-2"
            flat
            density="compact"
            variant="solo-filled"
            :items="types"
            :rules="[rules.required]"
          />
        </div>
      </v-card-text>

      <v-divider></v-divider>
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn color="primary" @click="closeDialog()">Cancel</v-btn>
        <v-btn :loading="loading" class="bg-primary" type="submit"
          >Create Unit</v-btn
        >
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  data() {
    return {
      nameInput: "",
      typeInput: "",
      types: ["Truck", "Trailer"],
      loading: false,
      rules: {
        required: (value: string) => !!value || "This field is required",
      },
    };
  },
  methods: {
    async createUnit() {
      this.loading = true;

      const form = this.$refs.form as any;
      const { valid } = await form.validate();

      if (!valid) {
        this.loading = false;
        return;
      }

      const body = {
        name: this.nameInput,
        type: this.typeInput.toLocaleLowerCase(),
      };

      try {
        await fetch("http://127.0.0.1:8000/api/transportUnits", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(body),
        });
      } catch (error) {
        this.loading = false;
        console.log(error);
      } finally {
        this.loading = false;
        this.closeDialog();
        this.$emit("new-unit");
      }
    },

    closeDialog() {
      this.$emit("close-dialog");
    },
  },
});
</script>
