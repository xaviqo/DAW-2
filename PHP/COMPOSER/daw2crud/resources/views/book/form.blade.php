<h1> {{ $mode }} book </h1>
<label for="name">Name</label>
<input type="text" value="{{ isset($book->name)?$book->name:'' }}" name="name" id="name">
<br>
<label for="author">Author</label>
<input type="text" value="{{ isset($book->name)?$book->author:'' }}" name="author" id="author">
<br>
<label for="price">Price</label>
<input type="number" value="{{ isset($book->name)?$book->price:'' }}" name="price" id="price">
<br>
<label for="category">Category</label>
<input type="number" value="{{ isset($book->name)?$book->category:'' }}" name="category" id="category">
<br>
@if(isset($book->image))
{{ $book->image }}
<br>
@endif
<label for="image">Image</label>
<input type="file"  name="image" id="image">
<br>
<input type="submit" value="{{ $mode }}" id="send">

<a href="{{ url('book') }}">Return</a>
