$(document).ready(() => {
    $(".btn-detail").on("click", function (event) {
      const customerId = this.getAttribute("data-id");
      window.location.href = "/admin/customer/show/" + customerId;
    }); 
  
    $(".btn-back").on("click", function (event) {
      window.history.go(-1);
    });
  
    $(".btn-update").on("click", function (event) {
      const customerId = this.getAttribute("data-id");

      $("#nameUpdate").val(this.getAttribute("data-name"));
      $("#phoneUpdate").val(this.getAttribute("data-phone"));
      $("#addressUpdate").val(this.getAttribute("data-address"));
      $("#emailUpdate").val(this.getAttribute("data-email"));

      $('#formUpdate').attr('action', '/admin/customer/update/' + customerId);
    });
  
    $(".btn-add").on("click", function (event) {
      $("#name").val("");
      $("#phone").val("");
      $("#address").val("");
      $("#email").val("");
    });
  
    $(".btn-delete").on("click", function (event) {
      const customerId = this.getAttribute("data-id");

      $("#idDelete").val(customerId);
      $("#nameDelete").val(this.getAttribute("data-name"));

      $('#formDelete').attr('action', '/admin/customer/delete/' + customerId);
    });
  });