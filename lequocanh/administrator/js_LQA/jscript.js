$(document).ready(function () {
  // Menu interaction
  $(".itemOrder").hide();
  $(".cateOrder").click(function () {
    $(this).next().slideDown();
  });
  $(".itemOrder").mouseleave(function () {
    $(this).slideUp();
  });

  // Form validation and submission
  $("#formreg").submit(function (event) {
    event.preventDefault();
    $("#noteForm").html("");
    var isValid = true;

    // Form validation logic (Username, Password, Hoten, etc.)
    // ...

    if (isValid) {
      $.ajax({
        url: "./elements_LQA/mUser/userAct.php?reqact=addnew",
        type: "POST",
        data: $("#formreg").serialize(),
        success: function (response) {
          console.log("Form submitted successfully:", response);
        },
        error: function (error) {
          console.error("Error submitting form:", error);
        },
      });
    }
  });

  // Setup for loaihang update
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

  // Setup for hanghoa update
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

  // Setup for dongia update
  $("#w_update_dg").hide();
  $(".w_update_btn_open_dg").click(function (e) {
    e.preventDefault();

    $("#w_update_dg").css("top", e.pageY + 5);
    $("#w_update_dg").css("left", e.pageX + 5);
    var $idDonGia = $(this).data("id"); 
    $("#w_update_form_dg").load(
      "./elements_LQA/mdongia/dongiaUpdate.php",
      { idDonGia: $idDonGia },
      function (response, status, request) {
        this;
      }
    );

    $("#w_update_dg").show();
  });

  $("#w_close_btn_dg").click(function (e) {
    e.preventDefault();
    $("#w_update_dg").hide();
  });

  // Setup for thuonghieu update
  $("#w_update_th").hide();
  $(".w_update_btn_open_th").click(function (e) {
    e.preventDefault();
    $("#w_update_th").css("top", e.pageY + 5);
    $("#w_update_th").css("left", e.pageX + 5);

    var $idThuongHieu = $(this).attr("value");
    $("#w_update_form_th").load(
      "./elements_LQA/mthuonghieu/thuonghieuUpdate.php",
      { idThuongHieu: $idThuongHieu },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_th").show();
  });
  $("#w_close_btn_th").click(function (e) {
    e.preventDefault();
    $("#w_update_th").hide();
  });

  // Setup for nhanvien update
  $("#w_update_nv").hide();
  $(".w_update_btn_open_nv").click(function (e) {
    e.preventDefault();
    $("#w_update_nv").css("top", e.pageY + 5);
    $("#w_update_nv").css("left", e.pageX + 5);

    var $idNhanVien = $(this).attr("value");
    $("#w_update_form_nv").load(
      "./elements_LQA/mnhanvien/nhanvienUpdate.php",
      { idNhanVien: $idNhanVien },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_nv").show();
  });
  $("#w_close_btn_nv").click(function (e) {
    e.preventDefault();
    $("#w_update_nv").hide();
  });

  // Setup for donvitinh update
  $("#w_update_dvt").hide();
  $(".w_update_btn_open_dvt").click(function (e) {
    e.preventDefault();
    $("#w_update_dvt").css("top", e.pageY + 5);
    $("#w_update_dvt").css("left", e.pageX + 5);

    var $idDonViTinh = $(this).attr("value");
    $("#w_update_form_dvt").load(
      "./elements_LQA/mdonvitinh/donvitinhUpdate.php",
      { idDonViTinh: $idDonViTinh },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_dvt").show();
  });
  $("#w_close_btn_dvt").click(function (e) {
    e.preventDefault();
    $("#w_update_dvt").hide();
  });

  // Setup for thuoctinh update
  $("#w_update_tt").hide();
  $(".w_update_btn_open_tt").click(function (e) {
    e.preventDefault();
    $("#w_update_tt").css("top", e.pageY + 5);
    $("#w_update_tt").css("left", e.pageX + 5);

    var $idThuocTinh = $(this).attr("value");
    $("#w_update_form_tt").load(
      "./elements_LQA/mthuoctinh/thuoctinhUpdate.php",
      { idThuocTinh: $idThuocTinh },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_tt").show();
  });
  $("#w_close_btn_tt").click(function (e) {
    e.preventDefault();
    $("#w_update_tt").hide();
  });
  //thuoctinhhh
  $("#w_update_tthh").hide();
  $(".w_update_btn_open_tthh").click(function (e) {
    e.preventDefault();
    $("#w_update_tthh").css("top", e.pageY + 5);
    $("#w_update_tthh").css("left", e.pageX + 5);

    var $idThuocTinhHH = $(this).attr("value");
    $("#w_update_form_tthh").load(
      "./elements_LQA/mthuoctinhhh/thuoctinhhhUpdate.php",
      { idThuocTinhHH: $idThuocTinhHH },
      function (response, status, request) {
        this;
      }
    );
    $("#w_update_tthh").show();
  });
  $("#w_close_btn_tthh").click(function (e) {
    e.preventDefault();
    $("#w_update_tthh").hide();
  });
});
