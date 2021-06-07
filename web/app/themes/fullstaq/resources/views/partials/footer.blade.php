<footer class="footer text-center text-sm-left">
  @if(!empty($footer_columns))
  <div class="footer__top d-flex">
    @include('partials.common.footer-top')
  </div>
  @endif
  <div class="footer__bottom">
    @include('partials.common.footer-nav')
  </div>
</footer>
