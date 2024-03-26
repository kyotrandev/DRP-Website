<?php require ($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php") ?>


<div class="container-fluid py-5" style="width: 100%;">
    <div class="text-center">
        <h1>Manager Ingredient</h1>
    </div>

    <div class="row g-0 justify-content-center">

        <!-- SEARCH AND TABLE-->
        <div class="col-auto" style="padding: 20px;
                                border: 1px solid #e1ebfa; border-radius: 10px; 
                                box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 40px; margin-bottom: 50px;">
            <h4 class="mb-3" style="width: auto;">
                <span>List ingredient</span>
            </h4>

            <div class="row g-2">
                <div class="col">
                    <form method="GET" class="row g-1 d-flex justify-content-between flex-fill">
                        <div class="col-1">
                            <input type="text" class="form-control" id="id" name="id" placeholder="ID...">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name...">
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="category" name="category" aria-label="Select meal type">
                                <option value="" selected disabled hidden>Select category</option>
                                <? foreach($data['categories'] as $category):  ?>
                                <option value="<?=$category['id']?>"><?=$category['detail']?></option>
                                <? endforeach;?>
                            </select>                       
                        </div>
                        <div class="col-2">
                            <select class="form-select" id="measurement_unit" name="measurement_unit" aria-label="Select meal type">
                                <option value="" selected disabled hidden>Select unit</option>
                                <? foreach($data['measurement_unit'] as $measurement_unit):  ?>
                                <option value="<?=$measurement_unit['id']?>"><?=$measurement_unit['detail']?></option>
                                <? endforeach;?>
                            </select>                       
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-success" name="search" type="submit">Search</button>
                        </div>
                        <div class="col-auto">
                            <a href="/ingredient/add" class="btn btn-success" tabindex="-1" role="button">Add new ingredient</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row g-0 py-1">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col" class="col-1">ID</th>
                            <th scope="col" class="col-3">Name</th>
                            <th scope="col" class="col-3">Category</th>
                            <th scope="col" class="col-2">Measurement unit</th>
                            <th scope="col" class="col-3">Actions</th>
                        </tr>
                        <tbody class="ingredientTableBody">
                            <!-- Dữ liệu được load trong file ajax-ingredients -->
                        </tbody>
                    </table>
                    <div class="row">
                        <div id="pagination" class="row justify-content-center mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/Public/js/libs/jquery/jquery-3.6.0.min.js"></script>
<script src="/Public/js/ajax-ingredients-manager.js"></script>
<script src="/Public/js/show-pagination.js"></script>


<? require ($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php") ?>