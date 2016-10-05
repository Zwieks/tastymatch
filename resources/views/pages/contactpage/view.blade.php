<!-- {{$debugpath}} -->
hjh
<div>
    @foreach ($users as $user)
        <p>This is user {{ $user->name }}</p>
    @endforeach
</div>