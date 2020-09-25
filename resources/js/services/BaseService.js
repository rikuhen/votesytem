import { Config } from "./../config";

const API = Config.apiUrl;

export default class BaseService {
  saveToken(token) {
    localStorage.setItem("token", token);
  }

  hasToken() {
    return localStorage.getItem("token") ? true : false;
  }

  getToken() {
    return localStorage.getItem("token") || null;
  }

  removeToken() {
    localStorage.removeItem("token");
  }

  getUrlApi() {
    return API;
  }

  getDefaultHeaders() {
    return {
      headers: {
        Accept: "Application/json",
      },
    };
  }

  getAuthHeaders() {
    let defaults = this.getDefaultHeaders();
    defaults.headers.Authorization = "Bearer " + this.getToken();
    return defaults;
  }
}
