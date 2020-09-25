import axios from "axios";

import BaseService from "./BaseService";

export default class AuthService extends BaseService {
  async doLogin(credentials) {
    return await axios
      .post(this.getUrlApi() + "/login", credentials)
      .then((result) => result)
      .catch((error) => error.response);
  }

  async getUser() {
    if (this.hasToken()) {
      return await axios
        .post(this.getUrlApi() + "/user-info", {}, this.getAuthHeaders())
        .then((result) => result.data.data);
    }
  }

  async doLogout() {
    return await axios.post(
      this.getUrlApi() + "/logout",
      {},
      this.getAuthHeaders()
    );
  }
}
