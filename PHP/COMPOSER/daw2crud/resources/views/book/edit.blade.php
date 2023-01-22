<form action="{{ url('/book/'.$book->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('book.form',['mode'=>'Edit']);
</form>
