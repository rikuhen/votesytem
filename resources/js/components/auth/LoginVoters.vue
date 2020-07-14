<template>
  <div>
    <b-form class="md-float-material form-material" v-on="{submit: hasUser ? doLogin : getUser  }">
      <div class="text-center">
        <img src="./../../../images/logo.png" class="img-fluid login-logo-img" />
      </div>
      <div class="card auth-box">
        <div class="card-block">
          <b-row class="m-b-2">
            <b-col md="12">
              <h3 class="text-center txt-primary">Ingreso</h3>
            </b-col>
            <b-col md="12">
              <p class="text-muted text-center p-b-5" v-if="!hasUser">Ingrese su cédula</p>
              <p class="text-muted text-center p-b-5" v-if="hasUser">Ingrese su clave</p>
            </b-col>
          </b-row>
          <b-alert
            :show="hasError"
            fade
            dismissible
            variant="danger"
            class="background-danger"
          >{{error}}</b-alert>

          <b-form-group class="form-primary" label-for="identification" v-if="!hasUser">
            <b-form-input
              id="identification"
              ref="identification"
              v-model="form.identification"
              trim
              required
              :class="{'fill': fStates.identification || form.identification}"
              @focus="fStates.identification = true"
              @blur="fStates.identification = false"
              :disabled="fStates.isSubmiting"
              autofocus
              maxlength="10"
            ></b-form-input>
            <span class="form-bar"></span>
            <label class="float-label">Cédula</label>
          </b-form-group>

          <b-form-group class="form-primary" label-for="identification" v-if="hasUser">
            <p class="text-center text-primary font-weight-bolder">HOLA, {{nameOfUser}}</p>
          </b-form-group>


          <b-form-group class="form-primary" label-for="password" v-if="hasUser">
            <b-form-input
              type="password"
              id="password"
              ref="password"
              v-model="form.password"
              trim
              required
              :class="{'fill': fStates.password || form.password}"
              @focus="fStates.password = true"
              @blur="fStates.password = false"
              :disabled="fStates.isSubmiting"
            ></b-form-input>
            <span class="form-bar"></span>
            <label class="float-label">Contraseña</label>
          </b-form-group>

          <b-row class="m-t-30">
            <b-col md="12">
              <b-button :disabled="fStates.isSubmiting" type="submit" variant="primary" block>
                <span v-if="!fStates.isSubmitDing && !hasUser">SIGUIENTE</span>
                <span v-if="!fStates.isSubmitDing && hasUser">INGRESAR</span>
                <feather
                  v-if="fStates.isSubmiting"
                  type="loader"
                  animation="spin"
                  animation-speed="fast"
                ></feather>
              </b-button>
            </b-col>
          </b-row>
        </div>
      </div>
    </b-form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginVoters",
  data() {
    return {
      hasUser: false,
      nameOfUser: "",
      form: {
        identification: "",
        password: "",
        is_voter: true
      },
      error: "",
      hasError: false,
      fStates: {
        identification: false,
        password: false,
        isSubmiting: false
      }
    };
  },

  methods: {
    setFocusPassword() {
      this.$refs.password.$el.focus();
    },
    getUser(e) {
      if (!this.form.identification) {
        this.hasError = true;
        this.error = "Cédula Requerida";
        e.preventDefault();
        e.stopPropagation();
        return false;
      }

      e.preventDefault();
      e.stopPropagation();
      this.hasError = false;
      this.fStates.isSubmiting = true;
      axios
        .post("/api/getName", { identification: this.form.identification })
        .then(result => {
          this.hasUser = true;
          this.nameOfUser = result.data.data.name;
        })
        .catch(reason => {
          let response = reason.response;
          this.error = response.data.message;
          this.hasError = true;
        })
        .then(() => (this.fStates.isSubmiting = false));
    },
    doLogin(e) {
      if (!this.form.identification && !this.form.password) {
        this.hasError = true;
        this.error = "Favor ingresar cédula y clave";
        e.preventDefault();
        e.stopPropagation();
        return false;
      }
      if (!this.form.identification) {
        this.hasError = true;
        this.error = "Cédula Requerida";
        e.preventDefault();
        e.stopPropagation();
        return false;
      }

      if (!this.form.password) {
        this.hasError = true;
        this.error = "Clave Requerida";
        e.preventDefault();
        e.stopPropagation();
        return false;
      }

      e.preventDefault();
      e.stopPropagation();
      this.fStates.isSubmiting = true;
      this.hasError = false;
      let promise = this.$store.dispatch("retrieveToken", {
        identification: this.form.identification,
        password: this.form.password,
        is_voter: 1
      });
      promise
        .then(response => {
          this.$store.dispatch("getUser").then(result => {
            this.$store.commit("SET_LAYOUT", "app-layout");
            this.$router.push({ name: "vote" });
          });
        })
        .catch(exception => {
          let response = exception.response;
          let status = response.status;
          if (status == 422) {
            this.error = "Cédula o Clave erronea";
          } else {
            this.error = response.data.message;
          }
          this.hasError = true;
          this.form.password = "";
          this.setFocusPassword();
        })
        .then(() => (this.fStates.isSubmiting = false));
    }
  }
};
</script>

<style  scoped>
.login-logo-img {
  width: 8%;
}
</style>
