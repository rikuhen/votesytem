<template>
  <div>
    <content-header-component
      title="Votantes"
      subtitle="Listado del padron, quienes votaron y quienes"
      icon="users"
      :listBreadcrumbs="listBreadcrumbs"
    ></content-header-component>
    <content-main-content-component>
      <b-col cols="12">
        <div class="card sale-card">
          <div class="card-header">
            <h3>Votantes</h3>
          </div>
          <div class="card-block">
            <b-table
              :items="loadVoters"
              :fields="fieldsTable"
              responsive
              striped
              hover
              table-class="table-xs"
              id="voters"
              :busy.sync="isBusy"
              :per-page="paginationOptions.perPage"
              :current-page="paginationOptions.currentPage"
            >
              <template v-slot:cell(enabled)="data">
                <b v-if="data.value == '0'" class="text-info">Si</b>
                <b v-if="data.value == '1'" class="text-danger">No</b>
              </template>

              <template v-slot:cell(observation)="data">
                <b v-if="data.value == 'notificated'" class="text-success">Notificado por correo</b>
                <b v-if="data.value == 'no-notificated'" class="text-info">No ha sido notificado</b>
              </template>
            </b-table>

            <b-pagination
              :total-rows="paginationOptions.totalItems"
              :per-page=" paginationOptions.perPage"
              v-model="paginationOptions.currentPage"
              aria-controls="voters"
            ></b-pagination>
          </div>
        </div>
      </b-col>
    </content-main-content-component>
  </div>
</template>

<script>
import ContentHeaderComponent from "./../../layouts/parts/ContentHeaderComponent";
import ContentMainContentComponent from "./../../layouts/parts/ContentMainContentComponent";

import axios from "axios";

export default {
  name: "ListVoters",
  components: {
    ContentHeaderComponent,
    ContentMainContentComponent
  },
  data() {
    return {
      listBreadcrumbs: [
        {
          text: "Votantes",
          active: true
        }
      ],
      fieldsTable: [
        {
          key: "identification",
          label: "Cédula",
          sortable: false
        },
        {
          key: "name",
          label: "Nombres",
          sortable: true
        },
        {
          key: "email",
          label: "Correo El.",
          sortable: false
        },
        {
          key: "enabled",
          label: "Ha Votado?",
          sortable: true
        },
        {
          key: "observation",
          label: "Observación",
          sortable: true
        }
      ],
      paginationOptions: {
        totalItems: null,
        perPage: 0,
        currentPage: 1
      },
      isBusy: true,
      voters: []
    };
  },
  methods: {
    loadVoters(ctx, callback) {
      let params = "";
      if (ctx) {
        params = "?page=" + this.paginationOptions.currentPage;
        if (ctx.sortBy) params = params + "&sortBy=" + ctx.sortBy;
        if (ctx.sortDesc) params = params + "&sortDesc=" + ctx.sortDesc;
        // currentPage = "?page=" + ctx.currentPage;
      }
      this.isBusy = true;
      const response = axios.get("/api/voters" + params, {
        headers: { Authorization: "Bearer " + localStorage.getItem("token") }
      });

      return response.then(result => {
        // debugger;
        this.paginationOptions.totalItems = result.data.meta.total;
        this.paginationOptions.perPage = result.data.meta.per_page;
        this.paginationOptions.currentPage = result.data.meta.current_page;
        this.isBusy = false;
        return result.data.data;
      });
    }
  },
  mounted() {
    this.loadVoters();
  }
};
</script>
