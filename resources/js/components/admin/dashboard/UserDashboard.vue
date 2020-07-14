<template>
  <div>
    <content-header-component
      title="Escritorio"
      subtitle="Aqui puede encontrar un resumen de las votaciones"
      icon="activity"
    ></content-header-component>
    <content-main-content-component>

    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../layouts/parts/ContentMainContentComponent";

export default {
  name: "UserDashboard",
  components: { ContentHeaderComponent, ContentMainContentComponent }
};
</script>

<style>
</style>
