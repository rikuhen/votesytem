<template>
  <div>
    <content-header-component
      title="Escritorio"
      subtitle="Aqui puede encontrar un resumen de las votaciones"
      icon="activity"
    ></content-header-component>
    <content-main-content-component>
      <!-- Barra de resultados -->
      <b-col xl="9" md="12"></b-col>

      <b-col xl="3" md="12">
        <card-result
          v-for="(result, key) in results"
          :key="key"
          :name="result.name"
          :count="result.point ? result.point + ' Votos' : 0  + ' Votos'"
          :place="(key + 1)"
        ></card-result>
      </b-col>
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../layouts/parts/ContentMainContentComponent";
import CardResult from "./CardResult";

import axios from "axios";

export default {
  name: "UserDashboard",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent,
    CardResult
  },
  data() {
    return {
      results: []
    };
  },
  methods: {
    async loadNumVotesCandidates() {
      const response = await axios.get("/api/get-total-votes", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });
      //   debugger
      return await response.data.data;
    }
  },
  mounted() {
    this.loadNumVotesCandidates().then(data => (this.results = data));
  }
};
</script>

<style>
</style>
