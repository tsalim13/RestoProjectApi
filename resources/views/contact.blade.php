<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Contactez nous</title>
  </head>
  <body>
    <div class="container mt-5 container-contact-form">
      <div class="card">
        <div class="card-header">
          Contactez nous
        </div>
        <div class="card-block">
          <div class="col-sm-12 mt-1">
            @if (count($errors) > 0)
              <div class="alert alert-danger" role="alert">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            @if(session()->has('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif
          </div>
          <form action="{{ route('contact') }}" method="POST" role="form">
            {{ csrf_field() }}
            <div class="form-group col-lg-4">
              <label class="form-control-label" for="name">Nom</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group col-lg-4">
              <label class="form-control-label" for="subject">Sujet</label>
              <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
            </div>
            <div class="form-group col-lg-4">
              <label class="form-control-label" for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group col-lg-12">
              <label class="form-control-label" for="message">Message</label>
              <textarea class="form-control" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
            </div>
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
