
listado de usuarios
<table>
<thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$loop -> iteration}}</td>

                    <td>{{$user -> name}}</td>
                    <td>{{$user -> email}}</td>
                    <!-- //obtiene el valor de las uniones de las dos tablas -->
                    <td>{{ implode(', ', $user -> roles() -> get() -> pluck('name')->toArray()) }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{  url('user/'.$user -> id.'/edit')  }}">Edit</a>
                    | 
                        <button type="submit" class="btn btn-danger" >Borrar</button>
                    </td>
                </tr>
            @endforeach

        </tbody>

</table>