<form action="{{ url('/book') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('book.form',['mode'=>'Create']);
</form>
