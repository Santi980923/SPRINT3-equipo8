<table class='table table-striped table-hover table-bordered'>
    <tr>
        <th> Fecha</th>
        <th> Hora</th>
        <th> Destinario</th>
        <th> Asunto</th>
        <th> Mensaje</th>
    </tr>
    {% for m in data %}
    <tr>
        <td> {{ m['fecha']}}</td>
        <td> {{ m['hora']}}</td>
        <td> {{ m['nombreusuario']}}</td>
        <td> {{ m['asunto']}}</td>
        <td> {{ m['mensaje']}}</td>
    </tr>
    
    {% endfor%}
    

</table>