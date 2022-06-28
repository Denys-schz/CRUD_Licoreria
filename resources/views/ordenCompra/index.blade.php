<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD Ordenes de Compra</title>
  </head>
  <body>
   
    <div class="container mt-3">
    <h2>Crear Orden  de compra</h2>
<form class="row g-3" id="FormAgregarOrdenCompra">
    @csrf
    <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Folio</label>
    <input type="text" name="folio" class="form-control" >
  </div>
  <div class="col-md-4">
    <label for="inputEmail4" class="form-label">Fecha en que se genero la orden</label>
    <input type="date" name="fecha" class="form-control" id="inputDate">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Proveedor</label>
    <select id="proveedor" name="proveedor" class="form-select" required onChange="buscarProductos(this)" >
      <option selected>Elige un Proveedor</option>
        @foreach ($proveedores as $provedor)
            <option value={{$provedor->id}} >{{$provedor->nombre_empresa}}</option>
        @endforeach
    </select>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Comentarios</label>
    <textarea class="form-control" id="inputAddress" name="comentarios"></textarea>
  </div>
  

  <table class="table table-bordered table-striped" id="tablaProductosByProvedor">
    <thead>
    <tr>
        <th colspan="4" style="text-align:center;">Productos Disponibles </th>
       
      </tr>
      <tr>
        <th>-</th>
        <th>Descripcion</th>
        <th>Cantidad</th>
        <th>Precio</th>
      </tr>
    </thead>
    <tbody id="TbodyTablaProductosByProvedor">
    @foreach ($productos as $producto)
            <tr value={{$producto->id}} >{{$provedor->descripcion}}</tr>
        @endforeach
    </tbody>
  </table>

  <div class="col-12">
    <button type="submit"  class="btn btn-primary" onCick="agregarOrdenCompra();">Crear Orden</button>
  </div>
</form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
    function buscarProductos(e){
      let id= e.value;
      console.log(id)
      
    fetch("{{ route('ordenCompra.busquedaByProveedor') }}?id="+id, )
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
              console.log(data)
              if(data!=''){
                document.getElementById('TbodyTablaProductosByProvedor').innerHTML = data;
              }else{
                document.getElementById('TbodyTablaProductosByProvedor').innerHTML = "<td colspan='4'>No hay productos disponibles";
              }
              
            })
            .catch(error => {
                console.log(error);
                
            });
        
    }
    document.querySelector('#FormAgregarOrdenCompra').addEventListener('submit', (e) => {
  e.preventDefault();
      
      var checkboxes =document.getElementsByClassName("checkProd");
      var productos = ''; 
      let arraySeleccionados=[];
      for (var x=0; x < checkboxes.length; x++) {
        if (checkboxes[x].checked) {
          arraySeleccionados.push({
            SKU:checkboxes[x].value,
            cantidad:  document.getElementById("cantidadProd"+checkboxes[x].value).value,
            precio:  document.getElementById("precioProd"+checkboxes[x].value).value,
            
          });
        }
      }
      
      var dataProductos = JSON.stringify(arraySeleccionados);
      
      let data = new FormData(document.getElementById("FormAgregarOrdenCompra"));
      data.append('productos',dataProductos);
      fetch("{{ route('ordenCompra.store') }}", {
            method: 'POST',
            body: data,
        })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
              window.location.href = "{{ route('ordenCompra.index') }}";
              
            })
            .catch(error => {
                alert(error);
                
            });
    
    });
</script>
  </body>
</html>