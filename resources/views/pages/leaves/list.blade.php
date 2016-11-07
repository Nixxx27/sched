
@foreach( $leaves as $l)

{{ $l->id}} <br>
{{ $l->emp_id}} <br>
{{ $l->date}} <br>


data from emplyee
{{ $l->id_of_emp->name}} <br>
{{ $l->id_of_emp->name}} <br>


@endforeach