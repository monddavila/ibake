<h1>Confirmation Page</h1>

<p>Thank you for submitting the following data:</p>

<ul>
    @foreach ($data as $key => $value)
        <li>{{ $key }}: {{ $value }}</li>
    @endforeach
</ul>
