<section class="content-header">
        @if(!empty(\Request::route()))
        <h1>
          {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </h1>
        @endif
</section>