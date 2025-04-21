@extends('layouts.main')

@php
    $title = 'Profil Saya'
@endphp

@section('content-header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Profil Saya</h1>
    </div>
  </div>
</div>
@endsection

@section('content')

@include('layouts.inc.alert')

<div class="container-fluid" id="emoji-container">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-primary card-outline">
        <div class="card-body box-profile text-center">
          <img class="profile-user-img img-fluid img-circle"  
          src="{{ $user->photo ? asset('storage/' . $user->photo) : '/admin/dist/img/user4-128x128.jpg' }}"
          alt="User profile picture">     
          <h3 class="profile-username">{{ $user->name }}</h3>
          <p class="text-muted">{{ $user->role ?? 'User' }}</p>
          <ul class="list-group list-group-unbordered mb-3 text-left">
            <li class="list-group-item"><b>Email</b> <span class="float-right">{{ $user->email }}</span></li>
            <li class="list-group-item"><b>Status</b> <span class="float-right">{{ $user->status ? 'Aktif' : 'Dibanned' }}</span></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-9">
        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header"><h4>Edit Profile</h4></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Profile</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                          <label>Password</label>
                          <input type="text" class="form-control" placeholder="Masukan password baru...">
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-primary btn-block" type="submit">Ubah Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Ekspresikan Dirimu 😄</h4>
            </div>
            <div class="card-body text-center">
                <div class="emoji-zone">
                    <span class="emoji" onclick="rainEmoji('🎉')">🎉</span>
                    <span class="emoji" onclick="rainEmoji('😂')">😂</span>
                    <span class="emoji" onclick="rainEmoji('🔥')">🔥</span>
                    <span class="emoji" onclick="rainEmoji('💯')">💯</span>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<style>
  .emoji-zone {
    font-size: 2rem;
    gap: 20px;
    display: flex;
    justify-content: center;
    cursor: pointer;
  }

  .rain-emoji {
    position: absolute;
    font-size: 2rem;
    animation: fall 1.5s ease-out forwards;
    pointer-events: none;
    z-index: 9999;
  }

  @keyframes fall {
    0% { transform: translateY(0) rotate(0deg); opacity: 1; }
    100% { transform: translateY(700px) rotate(360deg); opacity: 0; }
  }
</style>

<script>
  function rainEmoji(emoji) {
    const container = document.getElementById('emoji-container');
    const rect = container.getBoundingClientRect();
    const top = rect.top + window.scrollY;
    const left = rect.left;
    const width = container.offsetWidth;

    const audio = new Audio('/sounds/emoji.wav');
    audio.play();

    for (let i = 0; i < 25; i++) {
      const el = document.createElement('div');
      el.classList.add('rain-emoji');
      el.innerText = emoji;

      el.style.left = (left + Math.random() * width) + 'px';
      el.style.top = top + 'px';
      el.style.fontSize = (Math.random() * 2 + 1.2) + 'rem';

      document.body.appendChild(el);

      setTimeout(() => el.remove(), 1500);
    }
  }
</script>
@endsection
