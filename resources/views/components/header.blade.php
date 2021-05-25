<div class="row">
    <a class="col-2" href="{{route('home')}}">
        <img src="/images/minilogo.svg" width="160" height="80">
    </a>
    <h5 class="col-4 my-auto mx-auto">{{$name}}</h5>
    <div class="col-4 my-auto mx-auto">
        <div class="row">
            <input type="text" id="data" class="form-control rounded-0 col-10" style="background-color: #cfcece7a; color: black;
                      outline: none;box-shadow: none;border-color: transparent;" value="{{$search}}">
            <button class="form-control rounded-0 col-2" onclick="search()" style="background-color: #FEFF77;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></button>
        </div>
    </div>
    @isset($isAdmin)
    @if ($isAdmin === 1)
    <a class="col-1 my-auto mx-auto text-center" href="{{route('admin')}}">
        <i style="color:#FEFF77;" class="fas fa-user-shield fa-2x"></i>
    </a>
    @endif
    @endisset
    <a class="col-1 my-auto mx-auto text-center" style="color: white; font-size: larger;" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        Выход
    </a>
    <div id="login" hidden></div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<script>
    function search() {
        String.prototype.isEmpty = function() {
            return (this.length === 0 || !this.trim());
        };
        let data = $("#data").val();
        if (!data.isEmpty())
            window.location = `{{ url('/search') }}?data=${data}`;
    }
</script>