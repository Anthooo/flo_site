<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<body class="page">
<div class="container">
<h2>Contact</h2>
<div class="row contact">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate">
          <label for="first_name">Prénom</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Nom</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email" data-error="Cet email n'est pas valide">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea"></textarea>
          <label for="textarea1">Votre message</label>
        </div>
      </div>
    </form>
    <div class="row center">
    <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
    <i class="material-icons right">send</i>
  </button>
  </div>
  </div>
 </div>


<?php include('includes/footer.php');?>