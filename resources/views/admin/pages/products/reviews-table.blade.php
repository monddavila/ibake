@foreach($reviews as $review)
<tr>
    <td>{{ $review->product->name }}</td>
    <td>{{ $review->user->firstname }} {{ $review->user->lastname }}</td>
    <td>
        <textarea class="form-control" rows="3" name="editedComment">{{ $review->comment }}</textarea>
    </td>
    <td>{{ $review->rating }}</td>
    <td>{{ $review->created_at }}</td>
    <td>{{ $review->updated_at }}</td>
</tr>
@endforeach
