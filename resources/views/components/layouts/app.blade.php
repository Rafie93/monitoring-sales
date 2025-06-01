<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PT Berlian Motor|| Monitoring Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
    @stack('styles')
  </head>
  <body class="sb-nav-fixed">
    @include('components.layouts.header')
    @include('components.layouts.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
               
                @if($errors->any())
                  <div class="alert alert-danger">
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </div>
                @endif
                @if(session()->has('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                  </div>
                @endif
               {{$slot}}
            </div>
        </main>         
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script>
      $(document).ready(function() {
          $('.select2').select2();
      });
       window.addEventListener('alert', event => {
            // console.log(event.detail[0]['type']);
            toastr[event.detail[0]['type']](event.detail[0]['message'],
                event.detail[0]['title'] ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
      </script>
    <livewire:scripts />
    
    @stack('scripts')
  </body>
</html>
