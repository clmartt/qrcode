 <!-- Modal -->

 <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>

<div class='modal-dialog' role='document'>

  <div class='modal-content'>

    <div class='modal-header'>

      <h5 class='modal-title' id='exampleModalLabel'>Escolha o Prédio</h5>

      <button type='button' class='close' data-dismiss='modal' aria-label='Close'>

        <span aria-hidden='true'>&times;</span>

      </button>

    </div>

    <div class='modal-body'>

       <form class="form-inline my-2 my-lg-0" action="salaconsulta.php" method="GET">

           

           <div class="input-group mb-3">

          

            <select class="custom-select" id="inputGroupSelect01" name="predios">

              <?php foreach($result as $res){

               echo "<option value=". urlencode($res['PREDIO']).">".$res['PREDIO']."</option> ";

                                                                     

               } ?>

            </select>

            <input type="text" name="andar" class="form-control">



            <button class="btn btn-outline-secondary" type="submit">Buscar</button>

          </div>

      

  

      </form>

    </div>

    <div class='modal-footer'>

      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>

     </div>

  </div>

</div>

</div>
