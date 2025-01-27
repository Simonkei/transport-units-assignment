/**
 * plugins/vuetify.ts
 *
 * Framework documentation: https://vuetifyjs.com`
 */

// Styles
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";

// Composables
import { createVuetify } from "vuetify";

export default createVuetify({
  defaults: {
    VBtn: {
      style: "text-transform: none; font-weight: bold;",
      flat: true,
    },
    VCard: {
      rounded: "lg",
      flat: true,
    },
  },
  theme: {
    themes: {
      light: {
        dark: false,
        colors: {
          primary: "#2a534a",
          secondary: "#069468",
          background: "#F7F7F7",
        },
      },
    },
  },
});
