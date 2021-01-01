@extends('passcon::layout.master')
@section('content')
<div class="container">
    <div class="box">
        <div class="description">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <form>
            <label for="email">Email</label>
            <input id="email" type="text" name="email">
            <small class="waiting hiding" id="waiting">Lütfen bekleyiniz</small>
            <button id="send"  class="button">Email Password Reset Link</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var button = document.getElementById('send')
    var isButtonDisabled = true
    var formBusy = false;
    button.addEventListener('click',function(e){
        e.preventDefault()
        if(document.getElementById('email').value.length > 3  ) {
            formBusy = true;
            document.getElementById('waiting').classList.remove('hiding')
            document.getElementById('send').classList.add('disabled')
            let email = document.getElementById('email').value
            axios.post('/forgot-password',{ email })
            .then(function(response) {
                alert('talebiniz başarıyla iletildi')
                location.replace('/')
            }).catch(function(error) {
                alert('bir sorun oluştu '+error)
            }).finally(function(el){
                document.getElementById('waiting').classList.add('hiding')
            });
        }
    })
</script>
@endsection
