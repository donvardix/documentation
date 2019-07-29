@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Привет {{ Auth::user()->name }}, это твой личный кабинет.</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Твои данные:</h2>
                    <p>Имя: {{ Auth::user()->name }}</p>
                    <p>Фамилия: {{ Auth::user()->surname }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Пол: {{ Auth::user()->gender }}</p>
                    <p>День рождения: @if (Auth::user()->birthday=='1900-01-01')Не указана@else{{ Auth::user()->birthday }}@endif</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
