@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ session()->get('success') }}</strong> 
    </div>
@endif
{{-- @if(isset($errors))
    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong></strong> {{$error}}
            </div>
        @endforeach
    @endif
@endif --}}

