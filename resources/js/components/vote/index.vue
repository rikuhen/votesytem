<template>
  <div>
    <content-header-component
      title="Votaciones"
      subtitle="Seleccione un candidato para relizar su voto"
      icon="edit"
    ></content-header-component>
    <content-main-content-component>
      <b-col lg="4" sm="6" v-for="dignity in dignities" :key="dignity.id">
        <div class="card social-card">
          <div class="card-body text-center">
            <h3 class="text-facebook m-b-20">
              <feather type="edit"></feather>
            </h3>
            <h4 class="text-facebook f-w-700">{{dignity.name}}</h4>
          </div>
          <div class="card-footer">
            <b-row>
              <b-col md="6" sm="12">
                <b-button @click="showMessageForVote(dignity)" block variant="primary">
                  <feather type="thumbs-up" size="13px"></feather>Votar
                </b-button>
              </b-col>
              <b-col md="6" sm="12" v-if="dignity.type">
                <b-button
                  variant="info"
                  size="md"
                  class="waves-effect waves-light"
                  block
                  @click="showMembers(candidate.members)"
                >
                  <feather type="users" size="13px"></feather>Miembros
                </b-button>
              </b-col>
            </b-row>
          </div>
        </div>
      </b-col>

      <b-modal id="modal-members" title="Miembros" size="lg" ok-only scrollable>
        <b-row>
          <b-col md="6" sm="12" v-for="member in membersOnModal" :key="member.id">
            <div class="card comp-card">
              <div class="card-body">
                <div class="col">
                  <h6 class="m-b-25">{{member.position}}</h6>
                  <h5 class="f-w-700 text-c-blue">{{member.name}}</h5>
                </div>
              </div>
            </div>
          </b-col>
        </b-row>
      </b-modal>
    </content-main-content-component>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";
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
      dignities: [],
      membersOnModal: []
    };
  },
  methods: {
    async loadDignities() {
      const promise = await axios.get("/api/dignities", {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });
      return promise.data.data;
    },

    showMessageForVote(candidate) {
      let txtComplement = "";

      switch (candidate.type) {
        case "candidate":
          txtComplement = " por " + candidate.name + "?";
          break;
        case "nulled":
          txtComplement = " nulo?";
          break;
        default:
          txtComplement = " en blanco?";
          break;
      }

      swal({
        title: "Atención",
        text:
          "¿Está seguro de votar" +
          txtComplement +
          " Una vez realizado el voto no podrá cambiar de decisión",
        icon: "warning",
        dangerMode: false,
        buttons: {
          cancel: "Cancelar",
          defeat: {
            text: "Votar",
            closeModal: false
          }
        }
      })
        .then(action => {
          if (!action) throw null;
          return this.saveVote(candidate.id);
        })
        .then(text => {
          swal({
            title: "Voto realizado",
            icon: "success",
            text,
            button: "Aceptar"
          }).then(r => this.logout());
        })
        .catch(reason => {});
    },
    async saveVote(candidateId) {
      let data = {
        candidate_id: candidateId
      };
      const promise = await axios.post("/api/vote", data, {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token")
        }
      });
      return await promise.data.message;
    },

    showMembers(members) {
      this.membersOnModal = members;
      this.$bvModal.show("modal-members");
    },
    logout() {
      this.$store.dispatch("destroyToken").then(response => {
        this.$store.commit("SET_LAYOUT", "auth-layout");
        this.$router.push({ name: "login" });
      });
    }
  },
  mounted() {
    this.loadDignities().then(data => (this.dignities = data));
  }
};
</script>

<style>
</style>
