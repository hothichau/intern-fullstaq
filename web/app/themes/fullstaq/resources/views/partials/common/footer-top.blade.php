<div class="container">
  <div class="row">
    <div class="col-12 col-sm-3 footer__top-item">
      @include('partials.common.footer-columns', ['footerColumn' => $footer_columns['column1']])
    </div>
    <div class="col-12 col-sm-3 footer__top-item">
      @include('partials.common.footer-columns', ['footerColumn' => $footer_columns['column2']])
    </div>
    <div class="col-12 col-sm-3 footer__top-item">
      @include('partials.common.footer-columns', ['footerColumn' => $footer_columns['column3']])
    </div>
    <div class="col-12 col-sm-3 footer__top-item">
      @include('partials.common.footer-columns', ['footerColumn' => $footer_columns['column4']])
    </div>
  </div>
</div>
