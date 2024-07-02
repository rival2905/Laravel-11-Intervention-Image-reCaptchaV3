<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <script src="https://www.google.com/recaptcha/enterprise.js?render={{ env('RECAPTCHAV3_SITE_KEY') }}"></script> --}}
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHAV3_SITE_KEY') }}"></script>
</head>

<body>
    <main class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->has('g-recaptcha-response'))
            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <form action="/kirim" method="POST" enctype="multipart/form-data" id="imageForm">
                    @csrf
                    {{-- <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control shadow" id="nama" name="nama">
                        @error('nama')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control shadow" id="email" name="email"
                            aria-describedby="emailHelp">
                        @error('email')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">No Telpon</label>
                        <input type="text" class="form-control shadow" id="telp" name="telp">
                        @error('telp')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control shadow" id="alamat" name="alamat">
                        @error('alamat')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Pilih Gambar 1   </label>
                        <input type="file" class="form-control shadow" id="gambar" name="gambar">
                        <small class="form-text text-muted">File harus berupa gambar (jpeg, png, jpg, gif) dan tidak
                            lebih dari 2MB.</small> <br>
                        @error('gambar')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <div class="captcha">
                            <span>{!! captcha_img('math') !!}</span>
                            <button class="btn btn-danger reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control shadow" placeholder="Enter Captcha" name="captcha">
                        @error('captcha')
                            <label class="text-danger">{{ $message }}</label>
                        @enderror
                    </div> --}}
                  

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Replace the variables below. -->
    
    <script type="text/javascript">
    $('#imageForm').submit(function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ env('RECAPTCHAV3_SITE_KEY') }}", {action: 'subscribe_newsletter'}).then(function(token) {
                $('#imageForm').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                $('#imageForm').unbind('submit').submit();
            });;
        });
    });
    </script>

</body>

</html>
