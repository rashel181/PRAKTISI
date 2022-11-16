@extends('_layouts.app')

@section('content')
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="card bg-light border-primary" style="border-radius: 20px">
                        <div class="card-body">
                            {{-- Alert Success & Error --}}
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-warning">
                                    {{ Session::get('error') }}
                                    @php
                                        Session::forget('error');
                                    @endphp
                                </div>
                            @endif

                            {{-- Menampilkan Error Form Validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <b>Terjadi kesalahan saat input data</b><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <p>Check email kamu untuk process Verfikasi, <br>
                                Apabila kamu belum menerima emailnya silahkan <a
                                    href="{{ url("/email/verification/$userID") }}"> Kirim Ulang Verifikasi</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
