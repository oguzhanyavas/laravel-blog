@isset($categories)
<div class="col-md-3">

    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @foreach ($categories as $category)

            <li class="list-group-item @if (Request::segment(2)==$category->slug) active @endif">
                <a @if (Request::segment(2)!=$category->slug) href="{{ route('category',$category->slug) }}"
                    @endif >{{ $category->name }}</a>
                <span class="badge bg-danger float-right text-white">{{ $category->articleCount() }}</span>
            </li>
            @endforeach
        </div>
    </div>
    @if (Auth::check())
    <article class="card-body">
        <h4 class="card-title text-center mb-4 mt-1">Hoşgeldiniz
            @if (Auth::check())
            {{ auth()->user()->name }}
            @endif
        </h4>
        <hr>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <span style="font-size:15px">{{ $error }}</span>
            @endforeach

        </div>
        @endif
        @csrf

        <div class="form-group">
            <a class="btn btn-primary btn-block" href="{{ route('users.index') }}" role="button"> Uye Paneli </a>
            @if (Auth::check())
            @if (auth()->user()->status == "1")
            <a class="btn btn-primary btn-block" href="{{ route('admin.dashboard') }}" role="button"> Admin Paneli </a>
            @endif
            @endif

            <p class="text-center"><a href="{{ route('users.logout') }}" class="btn">Çıkış Yap</a></p>
        </div> <!-- form-group// -->
    </article>
    @else
    <article class="card-body">
        <h4 class="card-title text-center mb-4 mt-1">Giriş</h4>
        <hr>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <span style="font-size:15px">{{ $error }}</span>
            @endforeach

        </div>
        @endif
        <form action='{{ route('users.login.post') }}' method="post">
            @csrf
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email or login" type="email">
                </div> <!-- input-group.// -->
            </div> <!-- form-group// -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="password" class="form-control" placeholder="******" type="password">
                </div> <!-- input-group.// -->
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Giriş Yap </button>
                <button type="submit" class="btn btn-primary btn-block"> Üye Ol </button>
                <p class="text-center"><a href='#' class='icerik_degistir' class="btn">Şifrenimi Unuttun?</a></p>
            </div> <!-- form-group// -->


        </form>
    </article>
    @endif

    @endisset
