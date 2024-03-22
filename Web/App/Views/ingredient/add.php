<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php"); ?>
<style>
  .error-message {
    color: #ff4d4d;
    font-size: 14px;
  }

</style>
</style>

<h2 style="margin-left: 40%; margin-top: 30px">Ingredient Form</h2>

<form id="ingredient-form" action="/ingredient/add" method="post" style="width: 30%; margin-left: 40%; margin-bottom: 40px; align-items: center;">
  <label for="id">ID:</label><br>
  <input type="number" id="id" name="id"><br>
  <label for="category">Category:</label><br>
  <select id="category" name="category">
    <option value="EMMP">EMMP</option>
    <option value="FAO">FAO</option>
    <option value="FRU">FRU</option>
    <option value="GNBK">GNBK</option>
    <option value="HRBS">HRBS</option>
    <option value="MSF">MSF</option>
    <option value="OTHR">OTHR</option>
    <option value="PRP">PRP</option>
    <option value="VEGI">VEGI</option>
  </select><br>
  <label for="measurement_description">Measurement Description:</label><br>
  <select id="measurement_description" name="measurement_description">
    <option value="tsp">tsp</option>
    <option value="cup">cup</option>
    <option value="tbsp">tbsp</option>
    <option value="g">g</option>
    <option value="lb">lb</option>
    <option value="can">can</option>
    <option value="oz">oz</option>
  </select><br>
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="calcium">Calcium:</label><br>
  <input type="number" id="calcium" name="calcium" step="0.01"><br>
  <label for="calories">Calories:</label><br>
  <input type="number" id="calories" name="calories" step="0.01"><br>
  <label for="carbohydrate">Carbohydrate:</label><br>
  <input type="number" id="carbohydrate" name="carbohydrate" step="0.01"><br>
  <label for="cholesterol">Cholesterol:</label><br>
  <input type="number" id="cholesterol" name="cholesterol" step="0.01"><br>
  <label for="fiber">Fiber:</label><br>
  <input type="number" id="fiber" name="fiber" step="0.01"><br>
  <label for="iron">Iron:</label><br>
  <input type="number" id="iron" name="iron" step="0.01"><br>
  <label for="fat">Fat:</label><br>
  <input type="number" id="fat" name="fat" step="0.01"><br>
  <label for="monounsaturated_fat">Monounsaturated Fat:</label><br>
  <input type="number" id="monounsaturated_fat" name="monounsaturated_fat" step="0.01"><br>
  <label for="polyunsaturated_fat">Polyunsaturated Fat:</label><br>
  <input type="number" id="polyunsaturated_fat" name="polyunsaturated_fat" step="0.01"><br>
  <label for="saturated_fat">Saturated Fat:</label><br>
  <input type="number" id="saturated_fat" name="saturated_fat" step="0.01"><br>
  <label for="potassium">Potassium:</label><br>
  <input type="number" id="potassium" name="potassium" step="0.01"><br>
  <label for="protein">Protein:</label><br>
  <input type="number" id="protein" name="protein" step="0.01"><br>
  <label for="sodium">Sodium:</label><br>
  <input type="number" id="sodium" name="sodium" step="0.01"><br>
  <label for="sugar">Sugar:</label><br>
  <input type="number" id="sugar" name="sugar" step="0.01"><br>
  <label for="vitamin_a">Vitamin A:</label><br>
  <input type="number" id="vitamin_a" name="vitamin_a" step="0.01"><br>
  <label for="vitamin_c">Vitamin C:</label><br>
  <input type="number" id="vitamin_c" name="vitamin_c" step="0.01"><br>
  <button type="submit" name="login">Upload</button>
</form>
  <!-- Include jQuery library -->
  <script src="/Public/js/libs/jquery/jquery-3.5.1.min.js"></script>
  <!-- Include jQuery Validate plugin -->
  <script src="/Public/js/libs/jquery/jquery-1.19.2.min.js"></script>
<script src="/Public/js/validate-ingredients.js"></script>

<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>