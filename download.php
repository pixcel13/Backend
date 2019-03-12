<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Dashboard Template · Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <!-- Custom styles for this template -->
  <link href="css/estilos.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="#">Sign out</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="usuarios.php">
                <span data-feather="home"></span>
                Usuarios <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="download.php">
                <span data-feather="file"></span>
                Download
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="footer.php">
                <span data-feather="shopping-cart"></span>
                Footer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers"></span>
                Integrations
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Year-end sale
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-danger cancelar">Cancelar</button>
              <button type="button" class="btn btn-sm btn-outline-success" id="nuevo_registro">Nuevo</button>
            </div>
          </div>
        </div>
        <h2>Download</h2>
        <div class="table-responsive view" id="show_data">
          <table class="table table-striped table-sm" id="list-download">
            <thead>
              <tr>
                <th>Título</th>
                <th>Sub-título</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div id="insert_data" class="view">
          <form action="#" id="form_data">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nombre">Título</label>
                  <input type="text" id="titulo_download" name="titulo" class="form-control">
                </div>
                <div class="form-group">
                  <label for="correo">Sub-título</label>
                  <input type="text" id="subtitulo_download" name="subtitulo" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-success" id="guardar_datos">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <script>
    function change_view(vista = 'show_data'){
      $("#main").find(".view").each(function(){
        // $(this).addClass("d-none");
        $(this).slideUp('fast');
        let id = $(this).attr("id");
        if(vista == id){
          $(this).slideDown(300);
          // $(this).removeClass("d-none");
        }
      });
    }
    function consultar(){
      let obj = {
        "accion" : "consultar_download"
      };
      $.post("includes/_funciones.php", obj, function(respuesta){
        let template = ``;
        $.each(respuesta,function(i,e){
          template += `
          <tr>
          <td>${e.titulo_download}</td>
          <td>${e.subtitulo_download}</td>
          <td>
          <a href="#" data-id="${e.id_download}" class="editar_download">Editar</a>
          <a href="#" data-id="${e.id_download}" class="eliminar_download">Eliminar</a>
          </td>
          </tr>
          `;
        });
        $("#list-download tbody").html(template);
      },"JSON");
    }
    $(document).ready(function(){
      consultar();
      change_view();
    });
    $("#nuevo_registro").click(function(){
      change_view('insert_data');
    });
    $("#guardar_datos").click(function(){
      let titulo_download = $("#titulo_download").val();
      let subtitulo_download = $("#subtitulo_download").val();
      let obj ={
        "accion" : "insertar_download",
        "titulo_download" : titulo_download,
        "subtitulo_download" : subtitulo_download
      }
      $("#form_data").find("input").each(function(){
        $(this).removeClass("has-error");
        if($(this).val() != ""){
          obj[$(this).prop("name")] =  $(this).val();
        }else{
          $(this).addClass("has-error").focus();
          return false;
        }
      });

      if($(this).data("editar") == 1){
        obj["accion"] = "editar_download";
        obj["registro"] = $(this).data("id");
        $(this).text("Guardar").data("editar",0);
        $("#form_data")[0].reset();
      }
      $.post("includes/_funciones.php", obj, function(respuesta){
        alert(respuesta);
        change_view();
        consultar();
        $("#form_data")[0].reset();
      });
    });

     $("#list-download").on("click", ".eliminar_download", function(e){

      e.preventDefault();
      let confirmacion = confirm("Neta quieres borrarlo?");
      if (confirmacion){
      let id = $(this).data('id'),
          obj = {
            "accion" : "eliminar_download",
            "registro" : id
          };
      $.post("includes/_funciones.php", obj, function(respuesta){
        alert(respuesta);
        consultar();
      });

      }else{
        alert("No se elimino we");
      }
    });

         $('#list-download').on("click",".editar_download", function(e){
        e.preventDefault();
        let id = $(this).data('id'),
            obj = {
              "accion" : "consultar_registro_download",
              "registro" : id
            };
        $("#form_data")[0].reset();
        change_view('insert_data');
        $("#guardar_datos").text("Editar").data("editar",1).data("id",id);
        $.post("includes/_funciones.php", obj, function(r){
          $("#titulo_download").val(r.titulo_download);
          $("#subtitulo_download").val(r.subtitulo_download);
        }, "JSON");
            
      });

    $("#main").find(".cancelar").click(function(){
      change_view();
      $("#form_data")[0].reset();
    });
  </script>
</body>
</html>