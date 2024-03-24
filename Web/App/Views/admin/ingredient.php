<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>

<div class="container-fluid py-5" style="width: 100%;">
    <div class="text-center">
        <h1>Manager Ingredient</h1>
    </div>

    <div  class="row g-0 justify-content-center">

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
                            <input type="text" class="form-control" id="category" name="category" placeholder="Category...">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" id="measurement_desciption" name="measurement_desciption" placeholder="Measurement unit...">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name...">
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Measurement unit</th>
                            <th>Actions</th>
                        </tr>
                        <?php $count = 0; 
                        if(!is_array($ingredients)){
                            $ingredients = [$ingredients];
                        }
                        foreach ($ingredients as $ingredient): 
                            $count++;
                            if ($count > 10):
                                break;
                            endif;?>
                            <tr>
                                <td><?= $ingredient->getId()?></td>
                                <td><?= $ingredient->getName()?></td>
                                <td><?= $ingredient->getCategory()?></td>
                                <td><?= $ingredient->getMeasurementUnit()?></td>
                                <td style="display: flex; justify-content: space-between;">
                                    <div>
                                        <form  class="set-active-form d-inline-block">
                                            <input type="hidden" name="id" value="<?= $ingredient->getId() ?>">
                                            <input type="hidden" name="isActive" value="<?= $ingredient->getActive() ^ 1?>">
                                            <button class="btn <?=$ingredient->getActive() ? 'btn-danger' : 'btn-success' ?>" style="width: 150px" type="submit">
                                                <?= $ingredient->getActive() ? 'Deactivate' : 'Activate' ?>
                                            </button>
                                        </form>
                                    </div>
                                    <div>
                                        <a href="/manager/ingredient/update?id=<?= $ingredient->getId() ?>" class="btn btn-secondary d-inline-block" role="button">Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

            </div>

 
        </div>
    </div>
    <div class="d-md-flex justify-content-center py-3" >
        <a href="/manager" class="btn btn-secondary me-md-2" tabindex="-1" role="button" style="width: 10%;">Back</a>
    </div>
</div>

<script src="/Public/js/validate-signup.js"></script>
<script src="/Public/js/libs/jquery/jquery-3.6.0.min.js"></script>    
<script>
$(document).ready(function() {
$('.set-active-form').submit(function(event) {
    event.preventDefault();

    var formData = $(this).serialize();

    var button = $(this).find('button[type="submit"]'); // Get the button element

    $.ajax({
    type: 'POST',
    url: '/manager/ingredient',
    data: formData,
    dataType: 'json',
    success: function(response) {
        if (response.success) {
        alert(response.message);
        button.toggleClass('btn-danger btn-success');
        
        var buttonText = button.hasClass('btn-danger') ? 'Deactivate' : 'Activate';
        button.text(buttonText);
        } else {
        alert(response.message);
        }
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
    });
});
});
</script> 


<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php")?>     
