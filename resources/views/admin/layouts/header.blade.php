<!DOCTYPE html>
<html lang="en">
   <head>
      <title>3G Content</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="" />
      <meta name="keywords" content="">
      <meta name="author" content="Phoenixcoded" />
      <!-- Favicon icon -->
      <script src="{{ asset('public/assets/js/pcoded.min.js')}}"></script>
      <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
      <script src="{{ asset('public/assets/js/common.js')}}"></script>
      <script src="{{ asset('public/assets/js/Crypto.js')}}"></script>
      <script src="{{ asset('public/assets/js/Encryption.js')}}"></script>
      <script>
         var base_url = "{{url('/')}}";
         var _accessToken = "{{csrf_token()}}";
      </script>

      <link rel="icon" href="{{ asset('public/assets/images/favicon.ico')}}" type="image/x-icon">
      <!-- prism css -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/plugins/prism-coy.css')}}">
      <!-- vendor css -->
      <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
   </head>
