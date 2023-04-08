    @foreach (array_unique($errors->all()) as $error)
        <li class="font-weight-bold mx-2">{{ $error }}</li>
    @endforeach
