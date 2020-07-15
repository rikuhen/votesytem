<template>
  <div>
    <content-header-component
      title="Escritorio"
      subtitle="Aqui puede encontrar un resumen de las votaciones"
      icon="activity"
    ></content-header-component>
    <content-main-content-component>
      <!-- Barra de resultados -->
      <b-col xl="9" md="12">
        <chart-results v-if="loadResultsVotes" labelDataSet="Conteo de Votos" :labels="this.dataForChart.labels" :data="this.dataForChart.data"></chart-results>
      </b-col>

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
import ChartResults from "./ChartResults";

import axios from "axios";

export default {
  name: "UserDashboard",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent,
    CardResult,
    ChartResults
  },
  data() {
    return {
      results: [],
      loadResultsVotes: false,
      dataForChart: {
        labels: [],
        data: []
      }
    };
  },
  methods: {
    async loadNumVotesCandidates() {
      const response = await axios.get("/api/get-total-votes", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });

      return await response.data.data;
    },
    formatDataForChart(data) {
      for (let index = 0; index < data.length; index++) {
        this.dataForChart.labels.push(data[index]["name"]);
        this.dataForChart.data.push(data[index]["point"] || 0);
      }
      this.loadResultsVotes = true;
    }
  },
  mounted() {
    this.loadNumVotesCandidates().then(data => {
      this.results = data;
      this.formatDataForChart(data);
    });
  }
};
</script>

<style>
</style>
