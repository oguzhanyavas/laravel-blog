@extends('front.layouts.master')
@section('title','İletişim')
@section('bg', asset('/front/img/contact-bg.jpg'))
@section('content')
<div class="col-md-8">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="post" action="{{ route('contact.post') }}">
            @csrf
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Ad Soyad</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Ad Soyad" name="name">
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Email Adresi</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" placeholder="E-Mail Adresi" name="email">
                </div>
            </div>
            <div class="control-group">
                <div class="form-group col-xs-12  controls">
                    <label>Konu</label>

                    <select class="form-control" name='topic'>
                        <option @if (old('topic') == 'Bilgi') selected @endif>Bilgi</option>
                            <option @if (old('topic') == 'Genel') selected @endif>Genel</option>
                                <option @if (old('topic') == 'Destek') selected @endif>Destek</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group  controls">
                    <label>Mesajınız</label>
                    <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message">{{ old('message') }}</textarea>
                </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
            </div>
        </form>
</div>
<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</div>
@endsection