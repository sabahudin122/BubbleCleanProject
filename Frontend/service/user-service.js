import Constants from "../utils/constants.js";
import Utils from "../utils/utils.js";

var UserService = {
  init: function () {
    const token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.replace("index.html");
    }

    $("#login-form").validate({
      submitHandler: function (form) {
        const entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });
  },

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        localStorage.setItem("user_token", result.data.token);
        window.location.replace("index.html");
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(
          XMLHttpRequest?.responseText
            ? XMLHttpRequest.responseText
            : "Error during login"
        );
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("login.html");
  },

  generateMenuItems: function () {
    const token = localStorage.getItem("user_token");
    const user = Utils.parseJwt(token)?.user;

    if (user && user.role) {
      let nav = "";
      let main = "";

      switch (user.role) {
        case Constants.USER_ROLE:
          nav = `
            <li><a href="#services">Services</a></li>
            <li><a href="#orders">My Orders</a></li>
            <li><button onclick="UserService.logout()">Logout</button></li>`;
          main = `
            <section id="services"></section>
            <section id="orders"></section>`;
          break;

        case Constants.ADMIN_ROLE:
          nav = `
            <li><a href="#employees">Employees</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#orders">Orders</a></li>
            <li><button onclick="UserService.logout()">Logout</button></li>`;
          main = `
            <section id="employees"></section>
            <section id="services"></section>
            <section id="orders"></section>`;
          break;

        default:
          break;
      }

      $("#tabs").html(nav);
      $("#spapp").html(main);
    } else {
      window.location.replace("login.html");
    }
  },
};

export default UserService;