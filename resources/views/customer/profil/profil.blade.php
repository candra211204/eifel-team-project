@extends('customer.layouts.layout')

@section('main')
            {{-- Book --}}
            <div class="container">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="container mb-5 mt-5" id="profile">
                            {{-- Logo Settings --}}
                            <div class="mb-3">
                                <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>settings</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(304.000000, 151.000000)">
                                                    <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                    </polygon>
                                                    <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                                    <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="ms-1">Edit Profile</span>
                            </div>
                            {{-- Logo Settings End --}}
                
                            {{-- Edit Profile --}}
                            <div class="row">
                                {{-- Form --}}
                                <div class="col-md-8">
                                    <form action="{{ url('user/profil/update') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control w-90 @error('name') is-invalid @enderror" name="name" id="name" required value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control w-90 @error('email') is-invalid @enderror" name="email" id="email" required value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control w-90 @error('password') is-invalid @enderror" name="password" id="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Provinsi</label>
                                            <select class="form-control w-90" id="provinces" name="provinces" onchange="daerah(id, value)">
                                                <option>Pilih Provinsi</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kabupaten/Kota</label>
                                            <select class="form-control w-90" id="regencies" name="regencies" onchange="daerah(id, value)">
                                                <option>Pilih Kabupaten</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kecamatan</label>
                                            <select class="form-control w-90" id="districts" name="districts" onchange="daerah(id, value)">
                                                <option>Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kelurahan</label>
                                            <select class="form-control w-90" id="villages" name="villages">
                                                <option>Pilih Kecamatan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Detail Alamat</label>
                                            <input type="text" class="form-control w-90" name="detail" id="detail">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                                {{-- Form End --}}
                
                                {{-- Biodata --}}
                                <div class="card w-30 col-md-3">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-md-8 d-flex align-items-center">
                                                <h6 class="mb-0">Profile Information</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <p class="text-sm">
                                            Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                                        </p>
                                        <hr class="horizontal gray-light my-4">
                                        <ul class="list-group mb-8">
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama :</strong> &nbsp; {{ auth()->user()->name }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email :</strong> &nbsp; {{ auth()->user()->email }}</li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat :</strong> &nbsp; {{ auth()->user()->prov .', '. auth()->user()->kab. ', '. auth()->user()->kec .', '. auth()->user()->des .', '. auth()->user()->detail }}</li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- Biodata End --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Book End --}}
@endsection