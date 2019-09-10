
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>KVM X OMIE</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">


  <!-- Custom styles for this template -->
  <link href="css/freelancer.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <script src="vendor/jquery/jquery.min.js"></script>




  <script language="JavaScript">
    
    $(document).ready(function(){

    
 //-----------------------------------------
       

      $("#consultar").click(function(){

// - PEGANDO OS VALORES DOS INPUTS
          var dataI = $("#datainicio").val();
          var dataF = $("#datafim").val();
          var status = $("#statusconta").val();


// - SOMENTE INSERINDO VALOR DE CARREGANDO NA FRENTE DO NOME DAS EMPRESAS


          $("#receberresultadoinfo").text("Carregando");
           $("#receberresultadocom").text("Carregando...");
           $("#receberresultadoserv").text("Carregando...");

          $("#resultadoinfo").text("Carregando...");
          $("#resultadocom").text("Carregando...");
          $("#resultadoserv").text("Carregando...");


          // LISTANDO CONTAS A RECEBER
//--------------------------------------------------------------------    
            $.get("receberinfo.php",{data:dataI,dataFim:dataF,stat:status},function(data){

                 $("#receberresultadoinfo").html(data);



                 });


//-------------------------------------------------------------------- 

              $.get("recebercom.php",{data:dataI,dataFim:dataF,stat:status},function(data){
                       $("#receberresultadocom").html(data);


                  });



    
//-------------------------------------------------------------------- 
                 $.get("receberserv.php",{data:dataI,dataFim:dataF,stat:status},function(data){
                       $("#receberresultadoserv").html(data);


                  });

 


 // LISTANDO CONTAS A PAGAR

                  $.get("info.php",{data:dataI,dataFim:dataF,stat:status},function(data){
                        $("#resultadoinfo").html(data);
                     

                  });


  //------------------------------------------------------------


                   $.get("com.php",{data:dataI,dataFim:dataF,stat:status},function(data){
                             $("#resultadocom").html(data);


                        });


//-------------------------------------------------------------------- 

                  
                     $.get("serv.php",{data:dataI,dataFim:dataF,stat:status},function(data){
                           $("#resultadoserv").html(data);


                      });



//-------------------------------------------------------------------

 });
 
           

//---LISTAR DETALHES-----------------------------------
    
    

    $("#buttonreceberresultadoinfo").click(function(){
      $("#tituloempresa").text(" RECEBER - KVM INFORMATICA");
       var dataIglobal = $("#datainicio").val();
       var dataFglobal = $("#datafim").val();
       var statusglobal = $("#statusconta").val();
       
       $("#detalhes").text("Carregando...");
     $.get("Recebertabelainfo.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                            
                           $("#detalhes").html(data);


                      });

    });


    $("#buttonreceberresultadocom").click(function(){
      $("#tituloempresa").text(" RECEBER - KVM COMERCIAL");
      var dataIglobal = $("#datainicio").val();
       var dataFglobal = $("#datafim").val();
         var statusglobal = $("#statusconta").val();
       $("#detalhes").text("Carregando...");
     $.get("Recebertabelacom.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                            
                           $("#detalhes").html(data);


                      });


    });


    $("#buttonreceberresultadoserv").click(function(){
     $("#tituloempresa").text(" RECEBER - KVM SERVIÇOS");
            var dataIglobal = $("#datainicio").val();
            var dataFglobal = $("#datafim").val();
            var statusglobal = $("#statusconta").val();
            $("#detalhes").text("Carregando...");
            $.get("Recebertabelaserv.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                 $("#detalhes").html(data);


                      });



    });



     $("#buttonresultadoinfo").click(function(){
      $("#tituloempresa").text(" PAGAR - KVM INFORMATICA");
      var dataIglobal = $("#datainicio").val();
      var dataFglobal = $("#datafim").val();
      var statusglobal = $("#statusconta").val();
      $("#detalhes").text("Carregando...");
      $.get("Pagarinfotabela.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                          
       $("#detalhes").html(data);
          });

    });


      $("#buttonresultadocom").click(function(){
      $("#tituloempresa").text(" PAGAR - KVM COMERCIAL");
      var dataIglobal = $("#datainicio").val();
      var dataFglobal = $("#datafim").val();
      var statusglobal = $("#statusconta").val();
      $("#detalhes").text("Carregando...");
      $.get("Pagarcomtabela.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                          
       $("#detalhes").html(data);
          });



    });


       $("#buttonresultadoserv").click(function(){
      $("#tituloempresa").text(" PAGAR - KVM SERVIÇOS");
      var dataIglobal = $("#datainicio").val();
      var dataFglobal = $("#datafim").val();
      var statusglobal = $("#statusconta").val();
      $("#detalhes").text("Carregando...");
      $.get("Pagarservtabela.php",{data:dataIglobal,dataFim:dataFglobal,statglobal:statusglobal},function(data){
                          
       $("#detalhes").html(data);
          });




      });


// ESTE ESPAÇO É PARA REQUISIÇÃO DE CLIENTES POR CODIGO

// RECEBERTABELAINFO
      $(document).on('click', '.Recebertabelainfocodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthinfo.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });
//------------------------------------------------------------------------------------------------------------

  // RECEBERTABELACOM


  $(document).on('click', '.Recebertabelacomcodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthcom.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });

//------------------------------------------------------------------------------------------------------------

  // RECEBERTABELASERV
      $(document).on('click', '.Recebertabelaservcodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthser.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });



//------------------------------------------------------------------------------------------------------------

// PAGARTABELAINFO

$(document).on('click', '.Pagartabelainfocodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthinfo.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });

//------------------------------------------------------------------------------------------------------------

// PAGARTABELACOM

$(document).on('click', '.Pagartabelacomcodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthcom.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });



//------------------------------------------------------------------------------------------------------------

// PAGARTABELASERV

$(document).on('click', '.Pagartabelaservcodcliente', function(){
        var idclienteomie = $(this).text();
        var autentica = "OmieAppAuthser.php";
        $(".modal-body").empty();

             
              $.get("consultacliente.php",{idcli:idclienteomie,empresa:autentica},function(data){
                            
                $(".modal-body").empty();
                $(".modal-body").html(data);
                 
                 
                  });
                   
         });



//--------------------------------------------------------------------------------------------------------------


    });




  </script>

  

  



</head>

<body id="page-top">

  <!-- Navigation -->
  
<div class="container">
 
           
  <nav class="navbar navbar-dark bg-primary">
 <a class="navbar-brand" href="#">Filtros por Data de Vencimento</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <form class="form-inline">

                Data Inicio :&nbsp &nbsp<input type="date" class="form-control mb-2 mr-sm-2" id="datainicio">
                Data Fim :&nbsp &nbsp <input type="date" class="form-control mb-2 mr-sm-2" id="datafim">
                Status  :&nbsp &nbsp<select class="form-control" id="statusconta">
                  <option value="CANCELADO">CANCELADO</option>
                  <option value="PAGO">PAGO</option>
                  <option value="LIQUIDADO">LIQUIDADO</option>
                  <option value="EMABERTO">EM ABERTO</option>
                  <option value="PAGTO_PARCIAL">PAGTO PARCIAL</option>
                  <option value="VENCEHOJE">VENCE HOJE</option>
                  <option value="AVENCER">A VENCER</option>
                  <option value="ATRASADO">ATRASADO</option>
                </select>
                          
                 <button type="button" class="btn btn-primary mb-2" id="consultar">Consultar</button>
</form>
 </div>
  </nav>


 
 <br/>
 <br/>
   

    <div class="container">
       <div class="row">
  <div class="col-sm-6">
    <div class="card border-primary mb-3">
      <div class="card-body">

        <h5 class="card-title">Contas a Receber</h5>
        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonreceberresultadoinfo" >KVM INFORMÁTICA
        <span class="badge badge-light" id="receberresultadoinfo"></span>
        </button></a><p></p>
        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonreceberresultadocom">KVM COMERCIAL
        <span class="badge badge-light" id="receberresultadocom"></span>
        </button></a><p></p>

        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonreceberresultadoserv">KVM SERVIÇOS
        <span class="badge badge-light" id="receberresultadoserv"></span>
        </button></a><p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card border-danger mb-3">
      <div class="card-body">
        <h5 class="card-title">Contas a Pagar</h5>
        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonresultadoinfo">KVM INFORMÁTICA
        <span class="badge badge-light" id="resultadoinfo"></span>
        </button></a><p></p>

        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonresultadocom">KVM COMERCIAL
        <span class="badge badge-light" id="resultadocom"></span>
        </button></a><p></p>

        <a href="#informacoes"><button type="button" class="btn btn-primary" id="buttonresultadoserv">KVM SERVIÇOS
        <span class="badge badge-light" id="resultadoserv"></span>
        </button></a><p></p>
       
      </div>
    </div>
  </div>
</div>
</div>


  

<section id="informacoes">

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading" id="tituloempresa">Empresa</h4>
  <p id="detalhes">Click na empresa para obter detalhes</p>
  <p id="clienteload"></p>
  <hr>
  <p class="mb-0">Existe um limitaçao de 50 registro pelo OMIE</p>
</div>

</section>

  
     
  </div>






  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.min.js"></script>

<!-- INICIO DA JANELA MODAL -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fornecedor ou Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



</body>

</html>
