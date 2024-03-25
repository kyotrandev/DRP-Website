<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>
<title>Manager Recipe</title>
    <div class="container-fluid py-5" style="width: 100%;">
        <div class="text-center">
            <h1>Manager recipe</h1>
        </div>
    </div>
    <div class="row g-0 justify-content-center">    
        
        <!-- SEARCH AND TABLE -->
        <div class="col-11 sign-up" style="padding: 20px;
                                border: 1px solid #e1ebfa; border-radius: 10px; 
                                box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 0px; margin-bottom: 50px;">
            <h4 class="mb-3" style="width: auto;">
                <span>List user</span>
            </h4>   

            <!-- Search -->
            <div class="row g-2">
                <div class="col">
                    <form action="/manager/recipe" method="GET" class="row g-1 d-flex justify-content-between flex-fill">
                        <div class="col-2">
                            <input type="text" class="form-control" id="id" name="recipe_id" placeholder="ID...">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name...">
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="course" name="course">
                                <option value="" selected disabled hidden>Select meal recipe for</option>
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                            </select>                        
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="meal" name="meal" aria-label="Select meal type">
                                <option value="" selected disabled hidden>Select meal type</option>
                                <option value="Appetizer">Appetizer</option>
                                <option value="Main Dish">Main Dish</option>
                                <option value="Side Dish">Side Dish</option>
                                <option value="Dessert">Dessert</option>
                            </select>                        
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="method" name="method" aria-label="Select meal type">
                                <option value="" selected disabled hidden>Select meal category</option>
                                <option value="Baked">Baked</option>
                                <option value="Beverage">Beverage</option>
                                <option value="Salad and Salad Dressing">Salad and Salad Dressing</option>
                                <option value="Soup">Soup</option>
                                <option value="Sauce and Condiment">Sauce and Condiment</option>
                                <option value="Snack">Snack</option>
                                <option value="Other">Other</option>
                            </select>                       
                        </div>
                        <div class="col-auto"> 
                            <button class="btn btn-success" name="search" type="submit">Search</button>                     
                        </div>
                        <div class="col-auto"> 
                            <a href="/recipe/add" class="btn btn-success" tabindex="-1" role="button">Add new recipe</a>                        
                        </div>
                    </form>
                </div>
            </div>    
            
            <div class="row g-0 py-1">
                <div class="table-responsive">
                    <table class="table table-bordered nav">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Preparation Time Min</th>
                            <th scope="col">Cooking Time Min</th>
                            <th scope="col">Directions</th>            
                            <th scope="col">Meal Type 1</th>
                            <th scope="col">Meal Type 2</th>
                            <th scope="col">Meal Type 3</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php $count = 0; 
                        if(!is_array($recipes)){
                            $recipes = [$recipes];
                        }
                        foreach ($recipes as $recipe): 
                            $count++;
                            if ($count > 10):
                                break;
                            endif;?>
                            <tr>
                                <td><?= $recipe->getId()?></td>
                                <td><?= $recipe->getName()?></td>
                                <td><?= $recipe->getDescription()?></td>
                                <td>
                                    <img src="<?=$recipe->getImgUrl() ? "/Public/uploads/recipes/" . $recipe->getImgUrl() : "/Public/images/image_not_found.png"; ?>" 
                                         alt="<?php echo $recipe->getName(); ?>" 
                                         style="width: 200px; height: 200px; ">
                                </td>
                                <td><?= $recipe->getPreparationTime()?></td>
                                <td><?= $recipe->getCookingTime()?></td>
                                <td><?= $recipe->getDirection()?></td>
                                <td><?= $recipe->getCourse()?></td>
                                <td><?= $recipe->getMeal()?></td>
                                <td><?= $recipe->getMethod()?></td>
                                <td>
                                    <div class="row g-1">
                                        <?if($recipe->getActive()):?>
                                            <form class="col-auto" action="/manager/recipe" method="POST">
                                                <input type="hidden" name="id" value="<?= $recipe->getId() ?>">
                                                <input type="hidden" name="isActive" value="0">
                                                <button class="btn btn-danger" type="submit">Not Active</button>
                                            </form>
                                        <?else:?>
                                            <form class="col-auto" action="/manager/recipe" method="POST">
                                                <input type="hidden" name="id" value="<?= $recipe->getId() ?>">
                                                <input type="hidden" name="isActive" value="1">
                                                <button class="btn btn-success" type="submit">Active</button>
                                            </form>
                                        <?endif;?>
                                        <a href="/manager/recipe/update?id=<?= $recipe->getId() ?>" class="btn btn-secondary col-auto" role="button" style="200px">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-md-flex justify-content-center py-3 mb-5" >
            <a href="/manager" class="btn btn-secondary me-md-2" tabindex="-1" role="button" style="width: 10%;">Back</a>
        </div>
    </div>
</div>
<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php")?>    
<script src="/Public/js/validate-signup.js"></script>
