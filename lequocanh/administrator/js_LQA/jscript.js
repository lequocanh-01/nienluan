$(document).ready(function () {
  //menu
  $(".itemOrder").hide();
  $(".cateOrder").click(function () {
    $(this).next().slideDown();
  });

  $(".itemOrder").mouseleave(function () {
    $(this).slideUp();
  });

  $("#formreg").submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    // Clear previous error messages
    $("#noteForm").html("");

    var isValid = true; // Flag to track form validity

    var username = $("input[name*='username']").val();
    if (username.length === 0 || username.length < 6) {
      $("input[name*='username']").focus();
      $("#noteForm").append("<br>Username quá ngắn(6 kí tự trở lên)!");
      isValid = false; // Set flag to false
    }

    var password = $("input[name*='password']").val();
    if (password.length === 0 || password.length < 6) {
      $("input[name*='password']").focus();
      $("#noteForm").append("<br>Password từ 6 kí tự trở lên!");
      isValid = false; // Set flag to false
    }

    var hoten = $("input[name*='hoten']").val();
    if (hoten.length === 0 || hoten.length < 6) {
      $("input[name*='hoten']").focus();
      $("#noteForm").append("<br>Họ tên quá ngắn!");
      isValid = false; // Set flag to false
    }

    var ngaysinh = $("input[name*='ngaysinh']").val();
    if (ngaysinh.length === 0) {
      $("input[name*='ngaysinh']").focus();
      $("#noteForm").append("<br>Ngày sinh chưa hợp lệ!");
      isValid = false; // Set flag to false
    }

    var diachi = $("input[name*='diachi']").val();
    if (diachi.length === 0 || diachi.length < 10) {
      $("input[name*='diachi']").focus();
      $("#noteForm").append("<br>Địa chỉ phải ít nhất 10 kí tự!");
      isValid = false; // Set flag to false
    }

    var dienthoai = $("input[name*='dienthoai']").val();
    if (dienthoai.length === 0) {
      $("input[name*='dienthoai']").focus();
      $("#noteForm").append("<br>Số điện thoại không được để trống!");
      isValid = false; // Set flag to false
    } else if (dienthoai.length < 10) {
      $("input[name*='dienthoai']").focus();
      $("#noteForm").append("<br>Số điện thoại phải ít nhất 10 số!");
      isValid = false; // Set flag to false
    } else if (!/^(0)\d{9,}$/.test(dienthoai)) {
      $("input[name*='dienthoai']").focus();
      $("#noteForm").append(
        "<br>Số điện thoại phải bắt đầu bằng số 0 và không chứa ký tự khác!"
      );
      isValid = false; // Set flag to false
    }

    if (isValid) {
      // Form is valid, submit using AJAX
      $.ajax({
        url: "./elements_LQA/mUser/userAct.php?reqact=addnew", // URL to process the form
        type: "POST",
        data: $("#formreg").serialize(), // Send form data
        success: function (response) {
          // Handle successful submission
          console.log("Form submitted successfully:", response); // Example
        },
        error: function (error) {
          // Handle errors
          console.error("Error submitting form:", error); // Example
        },
      });
    }
  });

  $("#w_update").hide();
  $(".w_update_btn_open").click(function (e) {
    e.preventDefault();
    $("#w_update").css("left", e.pageX + 5);
    $("#w_update").css("top", e.pageY + 5);

    var $idloaihang = $(this).attr("value");

    $("#w_update_form").load(
      "./elements_LQA/mloaihang/loaihangUpdate.php",
      { idloaihang: $idloaihang },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update").show();
  });
  $("#w_close_btn").click(function (e) {
    e.preventDefault();
    $("#w_update").hide();
  });
  //hanghoa
  $("#w_update_hh").hide();
  $(".w_update_btn_open_hh").click(function (e) {
    e.preventDefault();
    $("#w_update_hh").css("top", e.pageY + 5);
    $("#w_update_hh").css("left", e.pageX + 5);

    var $idhanghoa = $(this).attr("value");
    $("#w_update_form_hh").load(
      "./elements_LQA/mhanghoa/hanghoaUpdate.php",
      { idhanghoa: $idhanghoa },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_hh").show();
  });
  $("#w_close_btn_hh").click(function (e) {
    e.preventDefault();
    $("#w_update_hh").hide();
  });
});
