<div class="wrapper-control-shop">
    <div class="meta-filter-shop"></div>
    <div class="grid-layout wrapper-shop" data-grid="grid-5">

        @foreach ($products as $item)
            @include('components.card_product', ['item' => $item])
        @endforeach

        @if (@isset($products->links))

            {{ $products->links() }}
            
        @endisset
            
        @endif

    </div>
</div>
