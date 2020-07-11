<template>
  <div>
    <content-header-component
      title="Votaciones"
      subtitle="Seleccione una candidato para relizar su voto"
      icon="edit"
    ></content-header-component>
    <content-main-content-component>
      <b-col lg="4" sm="6" v-for="candidate in candidates" :key="candidate.id">
        <div class="card">
          <div class="card-header">
            <h5 class="text-md-left text-sm-center text-center d-block d-block">{{candidate.name}}</h5>
          </div>
        </div>
      </b-col>
    </content-main-content-component>
  </div>
</template>

<script>
import axios from "axios";
import ContentHeaderComponent from "./../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../layouts/parts/ContentMainContentComponent";
export default {
  name: "VoteViewComponent",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent
  },
  data() {
    return {
      candidates: []
    };
  },
  methods: {
    async loadCandidates() {
      const menus = await axios.get("/api/candidates", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });
      return menus.data.data;
    }
  },
  mounted() {
    this.loadCandidates().then(data => (this.candidates = data));
  }
};
</script>

<style>
</style>
