function viewIngredient(ingredients) {
  // Parse JSON data into JavaScript object
  var ingredients = JSON.parse(ingredients);

  // Xóa dữ liệu cũ trong bảng
  $(".ingredientTableBody").empty();

  // Duyệt qua mảng ingredients để thêm dữ liệu mới vào bảng
  $.each(ingredients, function (index, ingredient) {
    // Xây dựng hàng của bảng
    var row =
      "<tr>" +
      "<td>" +
      ingredient.id +
      "</td>" +
      "<td>" +
      ingredient.name +
      "</td>" +
      "<td>" +
      ingredient.category +
      "</td>" +
      "<td>";

    // Chuyển đổi đơn vị đo lường
    switch (ingredient.measurement_unit) {
      case "g":
        row += "Gram";
        break;
      case "kg":
        row += "Kilogram";
        break;
      case "ml":
        row += "Milliliter";
        break;
      case "l":
        row += "Liter";
        break;
      case "tsp":
        row += "Teaspoon";
        break;
      case "tbsp":
        row += "Tablespoon";
        break;
      case "cup":
        row += "Cup";
        break;
      case "pint":
        row += "Pint";
        break;
      case "quart":
        row += "Quart";
        break;
      case "gallon":
        row += "Gallon";
        break;
      case "oz":
        row += "Ounce";
        break;
      case "lb":
        row += "Pound";
        break;
      case "mg":
        row += "Milligram";
        break;
      case "mcg":
        row += "Microgram";
        break;
      case "IU":
        row += "International Unit";
        break;
      case "can":
        row += "Can";
        break;
      case "unit":
        row += "Unit";
        break;
      default:
        row += "Unknown";
    }

    row += "</td></tr>";

    // Thêm hàng vào tbody của bảng
    $(".ingredientTableBody").append(row);
  });
}

var page = 1;
var totalPages = 1; 

$(function () {
  getIngredient();
});

function getIngredient(page = 1) {
  $.ajax({
    type: "GET",
    url: "/ingredients/?page=" + page,
    dataType: "json",
    success: function (ingredients) {
      let limitPage = 20;
      totalPages = Math.ceil(ingredients.length / limitPage); // Cập nhật giá trị totalPages

      viewIngredient(ingredients);

      // Hiển thị các nút trang
      showPagination(totalPages, page);
    },
  });
}

function showPagination(totalPages, currentPage) {
  var paginationHtml =
    "<nav aria-label='Page navigation'><ul class='pagination'>";

  // Nút Start Page
  paginationHtml +=
    "<li class='page-item'><a class='page-link' href='#' onclick='changePage(" +
    1 +
    ")'>Start Page</a></li>";

  // Tính số trang bắt đầu và kết thúc
  var startPage = Math.max(1, currentPage - 2);
  var endPage = Math.min(totalPages, startPage + 4);
  var startPageAdjustment = Math.max(1, endPage - 4);

  // Nút Previous
  paginationHtml +=
    "<li class='page-item'><a class='page-link' href='#' onclick='changePage(" +
    (currentPage - 1) +
    ")'>Previous</a></li>";

  // Các nút trang
  for (var i = startPageAdjustment; i <= endPage; i++) {
    paginationHtml +=
      "<li class='page-item " +
      (i === currentPage ? "active" : "") +
      "'><a class='page-link' href='#' onclick='changePage(" +
      i +
      ")'>" +
      i +
      "</a></li>";
  }

  // Nút Next`
  paginationHtml +=
    "<li class='page-item'><a class='page-link' href='#' onclick='changePage(" +
    (currentPage + 1) +
    ")'>Next</a></li>";

  // Nút End Page
  paginationHtml +=
    "<li class='page-item'><a class='page-link' href='#' onclick='changePage(" +
    15 + 
    ")'>End Page</a></li>";

  paginationHtml += "</ul></nav>";

  
  $("#pagination").html(paginationHtml);
}

// Đổi trang khi người dùng chọn trang khác
function changePage(page) {
  getIngredient(page);
}
