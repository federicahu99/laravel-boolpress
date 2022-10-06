@if(session('message'))
<div class="container">
    <div class="alert alert-success mt-3"> {{ session('message') }} </div>
</div>
@endif