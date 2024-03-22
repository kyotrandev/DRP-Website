<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php"); ?>

<style>
  .footer {
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>
<div class="form" style="width: 30%; margin-left: 50px; margin-top: 20px;">
  <form method="get" id="frmFINDBYNAME" action="/recipe/find-result">
    <fieldset>
      <legend>Find ingredient by name</legend>
      <div class="row">
        <label for="name">Name:</label>
        <span class="error">*</span>
        <input name="id" id="id" type="text" placeholder="Enter id of ingredient you find for.">
      </div>
      <div class="row">
        <input type="submit" value="Find" placeholder="Enter id of recipe." />
      </div>
    </fieldset>
  </form>
</div>

<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>