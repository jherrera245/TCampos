<form action="/clientes" method="get">
    <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{$searchText}}">

        <div class="input-group-append">
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>