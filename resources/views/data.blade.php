<table>
    <thead>
    <tr>
        @foreach($header as $h)
         <th>{{$h}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            @foreach($header as $hr)
              <td>{{ $d[$hr] }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
