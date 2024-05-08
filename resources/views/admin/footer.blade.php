<footer class="main-footer">
    <strong>Copyright &copy; @php
        echo date('Y')
    @endphp <a href="{{URL::to('/')}}"> {{config('app.name')}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {{config('app.version')}}
    </div>
  </footer>

