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
        <chart-results
          v-if="loadResultsVotes"
          labelDataSet="Conteo de Votos"
          :labels="this.dataForChart.labels"
          :data="this.dataForChart.data"
        ></chart-results>
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

      <b-col xl="4" sm="12">
        <card-result name="Padron Electoral" :count="totalVoters + ' Votantes'" icon="users"></card-result>
      </b-col>

      <b-col xl="4" sm="12">
        <card-result name="Han votado" :count="totalHaveVoted + ' Personas'" icon="check-circle"></card-result>
      </b-col>

      <b-col xl="4" sm="12">
        <card-result
          name="No Han votado"
          :count="totalHaveNotVoted + ' Personas'"
          icon="alert-octagon"
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
      totalVoters: 0,
      totalHaveVoted: 0,
      totalHaveNotVoted: 0,
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
    },
    async loadTotalVoters() {
      const response = await axios.get("/api/get-total-voters", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });

      return await response.data.data;
    },
    async loadTotalHaveVoted() {
      const response = await axios.get("/api/get-total-has-voted", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });

      return await response.data.data;
    },
    async loadTotalHaveNotVoted() {
      const response = await axios.get("/api/get-total-has-not-voted", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });

      return await response.data.data;
    }
  },
  mounted() {
    this.loadNumVotesCandidates().then(data => {
      this.results = data;
      this.formatDataForChart(data);
    });

    this.loadTotalVoters().then(
      result => (this.totalVoters = result.toString())
    );

    this.loadTotalHaveVoted().then(result => (this.totalHaveVoted = result));

    this.loadTotalHaveNotVoted().then(
      result => (this.totalHaveNotVoted = result)
    );
  }
};
</script>

<style>
</style>
