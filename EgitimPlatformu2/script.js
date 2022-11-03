/******************Video Olayları**********************/
$(document).ready(function () {
  $(".kapatmaisaret").click(function () {
    $("video").trigger('pause');
  });
});

$(document).ready(function () {
  $("video").click(function () {
    event.stopPropagation();
  });
});

$(document).ready(function () {
  $(".icerik-modal").click(function (event) {
    if (!$(event.target).is(".modal-content")) {
      $("video").trigger('pause');
    }
  });
});
/******************Video Olayları**********************/

/******************Section animasyon Olayları**********************/
$(document).ready(function () {
  $(".yukaricik").click(function () {
    var adres = $(this).attr("href");
    if (adres != "") {
      $("html,body").animate({
        scrollTop: $(adres).offset().top
      }, 800);
    }
  });
});
/******************Section animasyon Olayları**********************/