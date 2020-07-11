<template>
  <component v-bind:is="layout"></component>
</template>

<script>
import AppLayout from "./layouts/app";
import AuthLayout from "./layouts/auth";

export default {
  computed: {
    layout() {
      return this.$store.getters.layout;
    }
  },
  methods: {
    setLayout() {
      if (this.$store.getters.loggedIn) {
        this.$store.commit("SET_LAYOUT", "app-layout");
      } else {
        this.$store.commit("SET_LAYOUT", "auth-layout");
      }
    }
  },
  components: {
    "auth-layout": AuthLayout,
    "app-layout": AppLayout
  },
  created() {
    this.setLayout();
  },
};
</script>
