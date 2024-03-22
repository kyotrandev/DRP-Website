$(document).ready(function () {
  $("#recipe-form").validate({
      rules: {
          name: {
              required: true
          },
          preparation_time_min: {
              required: true,
              digits: true
          },
          cooking_time_min: {
              required: true,
              digits: true
          },
          meal_recipe_1: {
              required: true
          },
          meal_type_2: {
              required: true
          },
          meal_type_3: {
              required: true
          },
          directions: {
              required: true
          },
          description: {
              required: true
          }
      },
      messages: {
          name: {
              required: "Please enter the recipe name."
          },
          preparation_time_min: {
              required: "Please enter the preparation time.",
              digits: "Please enter a valid number for preparation time."
          },
          cooking_time_min: {
              required: "Please enter the cooking time.",
              digits: "Please enter a valid number for cooking time."
          },
          meal_recipe_1: {
              required: "Please select a meal recipe."
          },
          meal_type_2: {
              required: "Please select a meal type."
          },
          meal_type_3: {
              required: "Please select a meal category."
          },
          directions: {
              required: "Please enter the directions."
          },
          description: {
              required: "Please enter the description."
          }
      },
      errorElement: 'div',
      errorPlacement: function(error, element) {
          error.addClass('error-message');
          error.insertAfter(element);
      }
  });
});