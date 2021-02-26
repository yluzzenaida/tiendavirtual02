<h1> {{ $modo }} articulo </h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
<ul>
    @foreach( $errors->all() as $error)

    <li> {{ $error }} </li>

@endforeach
</ul>
</div>



@endif


<div class="form-group">
<label for="Nombre"> Nombre </label>
<input  type="text" class="form-control" name="Nombre" value="{{ isset($articulo->nombre)?$articulo->nombre: old('Nombre')}}" id="Nombre">
</div>

<div class="form-group">
<label for="Descripcion"> Descripcion </label>
<input  type="text" class="form-control" name="Descripcion" value="{{ isset($articulo->descripcion)?$articulo->descripcion: old('Descripcion')}}" id="Descripcion"> 
</div>

<div class="form-group">
<label for="Precio"> Precio </label>
<input  type="number" class="form-control" name="Precio" value="{{ isset($articulo->precio)?$articulo->precio: old('Precio')}}" id="precio">
</div>

<div class="form-group">
<label for="CodMarca"> CodMarca </label>
<input  type="text" class="form-control" name="CodMarca" value="{{ isset($articulo->codMarca)?$articulo->codMarca: old('CodMarca')}}" id="CodMarca">
</div>

<div class="form-group">
<label for="CodCategoria"> CodCategoria </label>
<input  type="text" class="form-control" name="CodCategoria" value="{{ isset($articulo->codCategoria)?$articulo->codCategoria: old('CodCategoria')}}" id="CodCategoria">
</div>

<div class="form-group">
<label for="Stock"> Stock </label>
<input  type="number" class="form-control" name="Stock" value="{{ isset($articulo->stock)?$articulo->stock: old('Stock')}}" id="Stock">
</div>

<div class="form-group">
<label for="Foto"> </label>
@if(isset($articulo->foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$articulo->foto }}" width="100" alt="" >
@endif
<input  type="file" class="form-control" name="Foto" value="" id="Foto">
</div>


<input class="btn btn-success" type="submit" value="{{$modo}} datos">
<a class="btn btn-primary"   href="{{url('articulo/')}}"> Regresar </a>
<br>