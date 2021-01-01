@extends('passcon::layout.master')
@section('content')
<div class="container">
    <div class="box">
        <div class="description" style="text-align:center;">
            Please indicate a new password for your account.
        </div>
        <form id="form">
            <label for="email">Email</label>
            <input id="email" type="text" name="email">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" autocomplete="false">
            <label for="password_confirmation">Password Confirmation</label>
            <input id="password_confirmation" type="password" name="password_confirmation"  autocomplete="false">
            <input type="hidden" name="token" value="" id="token">
            @csrf
            <button id="send" class="button">Change Password</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('email').value = decodeURIComponent(location.search.split('=')[1])
    document.getElementById('token').value = decodeURIComponent(location.pathname.split('/')[2])
    let form = document.getElementById('form')
    document.getElementById('send').addEventListener('click',function(e){
        e.preventDefault()
        if(document.getElementById('email').value.length > 3) {
            let email = document.getElementById('email').value
            let password = document.getElementById('password').value
            let password_confirmation = document.getElementById('password_confirmation').value
            let token = document.getElementById('token').value
            axios.post('/password-update',{ email,password,password_confirmation,token })
            .then(function(response) {
                alert('Şifreniz Başarıyla değiştirildi')
                location.replace('/')
            }).catch(function(error) {
                alert('bir sorun oluştu :'+error)
            })
        }
    })
</script>
@endsection
