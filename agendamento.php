<?php

ob_start();
session_start();

if($_SESSION['cliente']==''){
    header("Location: ./login.html"); 

};

$retorno = $_GET['retorno'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Agendamento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php include('menu.php');?>
<br>
<div class="container mt-3">
  <h3>Upload Agendamento</h3>
  <p></p>
  
  <form method="POST" action="./agen/processa.php" enctype="multipart/form-data">
    <p class="text-left">
  <a href="./agenadd/agenpredio.php">Novo Agendamento</a>
 </p>
    <hr>
    <div class="custom-file mb-3">
      <input type="file" class="custom-file-input" id="customFile" name="arquivo" accept=".csv">
      <label class="custom-file-label" for="customFile">Escolher arquivo</label>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
    
       
  </form>
  <br>
    <?php echo '<div class="text-center">'.$retorno.'</div>' ?>
  
</div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                            <form>
                                <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Local</label>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01" name="local">
                                                <option selected>Escolher...</option>
                                                <option value="1">Um</option>
                                                <option value="2">Dois</option>
                                                <option value="3">Três</option>
                                            </select>
                                </div>
                                

                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Andar</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Andar" name="andar">
                                </div>
                        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
