$(function () {
  "use strict";

  var init = "No items yet!";
  var counter = 0;

  // Initial Cart
  $(".counter").html(init);

  // Add Items To Basket
  function addToBasket() {
    counter++;
    $(".counter")
      .html(counter)
      .animate(
        {
          opacity: "0",
        },
        300,
        function () {
          $(".counter").delay(300).animate({
            opacity: "1",
          });
        }
      );
  }

  // Add To Basket Animation
  $("button").on("click", function () {
    // pengecekan url saat ini
  });

  if (window.location.href == "http://localhost/sarikusuma/dashboard/") {
    $("#pilihjadwal").click(function () {
      $.ajax({
        url: "http://localhost/sarikusuma/dashboard/proses.php",
        method: "POST",
        success: function (data) {
          if (data == 1) {
            alert("Admin kami akan segera menghubungi anda, pastikan nomor whatsApp anda aktif");
          } else {
            alert("Anda sudah terdaftar");
          }
        },
      });
    });
    addToBasket();
    $(this)
      .parent()
      .parent()
      .find(".product_overlay")
      .css({
        transform: " translateY(0px)",
        opacity: "1",
        transition: "all ease-in-out .45s",
      })
      .delay(1500)
      .queue(function () {
        $(this)
          .css({
            transform: "translateY(-500px)",
            opacity: "0",
            transition: "all ease-in-out .45s",
          })
          .dequeue();
      });
  } else {
    // window.location.href = "http://localhost/sarikusuma/login/";
  }
});
