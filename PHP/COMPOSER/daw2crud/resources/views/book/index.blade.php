@if(Session::has('message'))
{{ Session::get('message') }}
@endif

<a href="{{ url('book/create') }}">Add new book</a>

<table>
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Author
            </th>
            <th>
                Price
            </th>
            <th>
                Category
            </th>
            <th>
                Image
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
            <tr>
                <td>
                    {{ $book->id }}
                </td>
                <td>
                    {{ $book->name }}
                </td>
                <td>
                    {{ $book->author }}
                </td>
                <td>
                    {{ $book->price }}
                </td>
                <td>
                    {{ $book->category }}
                </td>
                <td>
                    <img src="{{ asset('storage').'/'.$book->image }}" alt="" width="100px" height="100px">
                </td>
                <td>
                    <a href="{{ url('/book/'.$book->id.'/edit') }}">
                        Edit
                    </a>
                     |
                    <form action="{{ url('/book/'.$book->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('Do you want to delete this book?')" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
