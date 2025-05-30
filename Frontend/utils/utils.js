import RestClient from './rest-client.js';
import Constants from './constants.js';

let Utils = {
  // Function to render a DataTable
  datatable: function (table_id, columns, data, pageLength = 15) {
    if ($.fn.dataTable.isDataTable("#" + table_id)) {
      $("#" + table_id)
        .DataTable()
        .destroy();
    }
    $("#" + table_id).DataTable({
      data: data,
      columns: columns,
      pageLength: pageLength,
      lengthMenu: [2, 5, 10, 15, 25, 50, 100, "All"],
    });
  },

  // Function to parse a JWT token and extract user data
  parseJwt: function (token) {
    if (!token) return null;
    try {
      const payload = token.split('.')[1];
      const decoded = atob(payload);
      return JSON.parse(decoded);
    } catch (e) {
      console.error("Invalid JWT token", e);
      return null;
    }
  },

  // Function to render employees in a DataTable
  renderEmployeesTable: function (table_id, role = null) {
    RestClient.get("employees", function (employees) {
      if (role) {
        employees = employees.filter(employee => employee.role === role);
      }
      const columns = [
        { title: "ID", data: "id" },
        { title: "Name", data: "name" },
        { title: "Email", data: "email" },
        { title: "Role", data: "role" },
      ];
      Utils.datatable(table_id, columns, employees);
    }, function (error) {
      console.error("Failed to fetch employees:", error);
    });
  },

  // Function to render services in a DataTable
  renderServicesTable: function (table_id) {
    RestClient.get("services", function (services) {
      const columns = [
        { title: "ID", data: "id" },
        { title: "Service Name", data: "service_name" },
        { title: "Description", data: "description" },
        { title: "Price", data: "price" },
      ];
      Utils.datatable(table_id, columns, services);
    }, function (error) {
      console.error("Failed to fetch services:", error);
    });
  },

  // Function to render orders in a DataTable
  renderOrdersTable: function (table_id, status = null) {
    RestClient.get("orders", function (orders) {
      if (status) {
        orders = orders.filter(order => order.status === status);
      }
      const columns = [
        { title: "Order ID", data: "id" },
        { title: "Customer Name", data: "customer_name" },
        { title: "Service", data: "service_name" },
        { title: "Price", data: "price" },
        { title: "Status", data: "status" },
      ];
      Utils.datatable(table_id, columns, orders);
    }, function (error) {
      console.error("Failed to fetch orders:", error);
    });
  },

  // Function to render customers in a DataTable
  renderCustomersTable: function (table_id) {
    RestClient.get("users", function (users) {
      const columns = [
        { title: "ID", data: "id" },
        { title: "Name", data: "name" },
        { title: "Email", data: "email" },
        { title: "Phone", data: "phone" },
        { title: "Address", data: "address" },
      ];
      Utils.datatable(table_id, columns, users);
    }, function (error) {
      console.error("Failed to fetch customers:", error);
    });
  },

  // Function to generate menu items based on user roles
  generateMenuItems: function () {
    const token = localStorage.getItem("user_token");
    const user = Utils.parseJwt(token);

    if (!user) {
      console.error("No user data found in token");
      return [];
    }

    if (user.role === Constants.ADMIN_ROLE) {
      return ["Dashboard", "Manage Employees", "Manage Services", "View Orders"];
    } else if (user.role === Constants.USER_ROLE) {
      return ["Dashboard", "My Orders", "Available Services"];
    }
    return [];
  },
};

export default Utils;