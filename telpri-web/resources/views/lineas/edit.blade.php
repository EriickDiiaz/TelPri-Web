@extends('layouts.app')
@section('title', 'CallCenters | Editar Linea')
@section('content')

<div class="container">
        <h2>Edición de Lineas.</h2>

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>¡Uy!</strong> Revisa los siguientes errores antes de continuar.
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('lineas/' .$linea->id) }}" method="post">
            @method("PUT")
            @csrf

            <div class="mb-3 row">
                <label for="linea" class="col-sm-2 col-form-label">Linea:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="linea" id="linea" value="{{ $linea->linea }}" required>
                </div>
            </div>

            <div class="mb-3 row">
            <label for="vip" class="col-sm-2 col-form-label">¿Vip?</label>
            <div class="col-sm-5">
                <select name="vip" id="vip" class="form-select">
                    <option value="{{ $linea->vip }}">{{ $linea->vip }}</option>
                    <option value="" selected>No</option>
                    <option value="Presidente">Presidente</option>
                    <option value="Vice Presidente">Vice Presidente</option>
                    <option value="Gerente General">Gerente General</option>
                    <option value="Asesor">Asesor</option>
                    <option value="Asistente">Asistente</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inventario" class="col-sm-2 col-form-label">Inventario:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="inventario" id="inventario" value="{{ $linea->inventario }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="serial" class="col-sm-2 col-form-label">Serial:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="serial" id="serial" value="{{ $linea->serial }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="mac" class="col-sm-2 col-form-label">Mac/Campo/Li3:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="mac" id="mac" value="{{ $linea->mac }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="plataforma" class="col-sm-2 col-form-label">Plataforma:</label>
            <div class="col-sm-5">
                <select name="plataforma" id="plataforma" class="form-select">
                    <option value="{{ $linea->plataforma }}">{{ $linea->plataforma }}</option>
                    <option value="">Seleccione</option>
                    <option value="Axe">Axe</option>
                    <option value="Cisco">Cisco</option>
                    <option value="Ericsson">Ericsson</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="titular" class="col-sm-2 col-form-label">Titular:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="titular" id="titular" value="{{ $linea->titular }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="estado" class="col-sm-2 col-form-label">Estado:</label>
            <div class="col-sm-5">
                <select name="estado" id="estado" class="form-select">
                    <option value="{{ $linea->estado }}">{{ $linea->estado }}</option>
                    <option value="">Seleccione</option>
                    <option value="Disponible">Disponible</option>
                    <option value="Asignada">Asignada</option>
                    <option value="Bloqueada">Bloqueada</option>
                    <option value="Por Verificar">Por Verificar</option>
                    <option value="Por Eliminar">Por Eliminar</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="localidad" class="col-sm-2 col-form-label">Localidad:</label>
            <div class="col-sm-5">
                <select name="localidad" id="localidad" class="form-select">
                    <option value="{{ $linea->localidad }}">{{ $linea->localidad }}</option>
                    <option value="">Seleccione</option>
                    <option value="Centro Logistico La Yaguara">Centro Logistico La Yaguara</option>
                    <option value="Central Los Palos Grandes">Central Los Palos Grandes</option>
                    <option value="Centro Logistico La Yaguara, Almacen Central">Centro Logistico La Yaguara, Almacen Central</option>
                    <option value="Centro Logistico La Yaguara, Reparaciones Suministro">Centro Logistico La Yaguara, Reparaciones Suministro</option>
                    <option value="Cet-Arvelo">Cet-Arvelo</option>
                    <option value="Cet-Jan Decketh">Cet-Jan Decketh</option>
                    <option value="Data Center El Hatillo">Data Center El Hatillo</option>
                    <option value="Datacenter Equipos II">Datacenter Equipos II</option>
                    <option value="Datacenter Los Palos Grandes">Datacenter Los Palos Grandes</option>
                    <option value="Edif. El Nea">Edif. El Nea</option>
                    <option value="Edif. Equipos I">Edif. Equipos I</option>
                    <option value="Edif. Equipos II">Edif. Equipos II</option>
                    <option value="Edif. Los Cortijos I">Edif. Los Cortijos I</option>
                    <option value="Edif. Los Cortijos II">Edif. Los Cortijos II</option>
                    <option value="Galpon 9 De Diciembre">Galpon 9 De Diciembre</option>
                    <option value="Galpon Santa Ana. Operaciones Y Mantenimiento">Galpon Santa Ana. Operaciones Y Mantenimiento</option>
                    <option value="Linea Smt Idea Sartenejas">Linea Smt Idea Sartenejas</option>
                    <option value="Oac Nea">Oac Nea</option>
                    <option value="Oep Los Cortijos">Oep Los Cortijos</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="piso" class="col-sm-2 col-form-label">Piso:</label>
            <div class="col-sm-5">
                <select name="piso" id="piso" class="form-select">
                    <option value="{{ $linea->piso }}">{{ $linea->piso }}</option>
                    <option value="">Seleccione</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="SS">SS</option>
                    <option value="PB">PB</option>
                    <option value="MZZ">MZZ</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="observacion" class="col-sm-2 col-form-label">Observaciones:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="observacion" id="observacion" value="{{ $linea->observacion }}">
            </div>
        </div>

            <a href="{{ url('lineas') }}" class="btn btn-danger btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>  
            </svg>
                Regresar
            </a>

            <button type="submit" class="btn btn-success btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                    <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5"></path>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"></path>
                </svg>
                Actualizar
            </button>
                        
        </form>

</div>

@endsection