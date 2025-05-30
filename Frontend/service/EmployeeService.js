import RestClient from '../utils/rest-client.js';

var EmployeeService = {
  loadEmployees: function () {
    RestClient.get("employees", function (employees) {
      console.log("Employees loaded:", employees);
      // Dynamically update the UI (e.g., populate a table)
    }, function (error) {
      console.error("Failed to load employees:", error);
    });
  },

  addEmployee: function (employee) {
    RestClient.post("employees", employee, function (response) {
      console.log("Employee added:", response);
      // Refresh the employee list or update the UI
    }, function (error) {
      console.error("Failed to add employee:", error);
    });
  },

  editEmployee: function (employee) {
    RestClient.put(`employees/${employee.id}`, employee, function (response) {
      console.log("Employee updated:", response);
      // Refresh the employee list or update the UI
    }, function (error) {
      console.error("Failed to update employee:", error);
    });
  },

  deleteEmployee: function (id) {
    RestClient.delete(`employees/${id}`, null, function (response) {
      console.log("Employee deleted:", response);
      // Refresh the employee list or update the UI
    }, function (error) {
      console.error("Failed to delete employee:", error);
    });
  },
};

export default EmployeeService;
