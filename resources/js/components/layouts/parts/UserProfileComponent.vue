<template>
  <div class="dropdown-primary dropdown" :class="{'show':showNotificationUser}" @click="showNotificationUser = !showNotificationUser">
    <div class="dropdown-toggle" data-toggle="dropdown" :aria-expanded="false">
      <b-icon-person-fill></b-icon-person-fill>
      <span>{{username}}</span>
      <b-icon-caret-down-fill scale="0.5"></b-icon-caret-down-fill>
    </div>
    <ul
      class="show-notification profile-notification dropdown-menu"
      :class="{'show':showNotificationUser}"
      data-dropdown-in="fadeIn"
      data-dropdown-out="fadeOut"
    >
      <li>
        <a @click="logout()">
          <feather type="log-out"></feather>Salir
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showNotificationUser: false
    };
  },
  props: {
    username: {
      type: String,
      default: ""
    }
  },
  components: {
    // LogOutIcon
  },
  methods: {
    logout() {
      this.$store.dispatch("destroyToken").then(response => {
        this.$store.commit("SET_LAYOUT", "auth-layout");
        this.$router.push({ name: "login" });
      });
    }
  }
};
</script>

<style scoped>
ul.show-notification li:hover {
  background-color: #f1f1f1 !important;
}
</style>
