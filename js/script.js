function getItem(brand) {
  console.log(brand);

  if (brand != "") {
    var str = "brand=" + brand;
    $.ajax({
      type: "POST",
      url: "util/get_item.php",
      data: str,
      success: function (response) {
        $("#model-drop").html(response);
      },
    });
  } else {
    $("#model-drop").html("");
  }
}
